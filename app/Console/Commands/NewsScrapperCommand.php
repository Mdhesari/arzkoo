<?php

namespace App\Console\Commands;

use App\Console\BaseScrapper;
use App\Models\Exchanges\Exchange;
use App\Models\News;
use Cache;
use Carbon\Carbon;
use Illuminate\Console\Command;
use NumberFormatter;

class NewsScrapperCommand extends BaseScrapper
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap news';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->cli->request('GET', 'https://arzdigital.com/breaking');

        $news_arr = [];

        $bar = $this->output->createProgressBar($response->filter('.arz-breaking-news__list')->children()->count());

        $bar->start();

        $response->filter('.arz-breaking-news__list')->children()->each(function ($node) use (&$news_arr, $bar) {
            $nodeLink = $node->children('.arz-breaking-news__item-link.arz-ignore-link')->first();
            $nodeTime = $node->filter('.arz-breaking-news-post__info-publish-date.arz-breaking-news__publish-time time')->first();

            $created_at = $this->getNodeCarbonTime($nodeTime);

            $data = [
                'title' => $nodeLink->attr('title'),
                'image' => $node->filter('.arz-breaking-news__image-box .arz-breaking-news__image')->first()->attr('data-main-src'),
                'body' => $node->filter('.arz-d-none.arz-breaking-news__content')->first()->text(),
                'likes' => $node->filter('.arz-breaking-news-post__info-rating-pump-number .arz-breaking-news-post__info-rating-value')->first()->text(),
                'dislikes' => $node->filter('.arz-breaking-news-post__info-rating-dump-number .arz-breaking-news-post__info-rating-value')->first()->text(),
                'meta' => json_encode([
                    'shared_telegram' => false,
                    'post_id' => intval($nodeLink->attr('data-post-id')),
                ]),
                'created_at' => $created_at,
                'updated_at' => $created_at,
            ];

            if (!News::whereJsonContains('meta->post_id', $nodeLink->attr('data-post-id'))->exists())
                $news_arr[] = $data;

            $bar->advance();

        });

        News::insert($news_arr);

        $bar->finish();

        return 0;
    }

    private function getNodeCarbonTime($nodeTime): Carbon
    {
        $carbon = Carbon::now()->change($nodeTime->attr('datetime'));
        $fmt = numfmt_create('fa', NumberFormatter::DECIMAL);
        $number = numfmt_parse($fmt, $nodeTime->text());
        if (\Str::contains($nodeTime->text(), 'دقیقه')) {
            $carbon->subMinutes($number);
        } elseif (\Str::contains($nodeTime->text(), 'ساعت')) {
            $carbon->subHours($number);
        } elseif (\Str::contains($nodeTime->text(), 'روز')) {
            $carbon->subDays($number);
        } elseif (\Str::contains($nodeTime->text(), 'ماه')) {
            $carbon->subMonths($number);
        } elseif (\Str::contains($nodeTime->text(), 'سال')) {
            $carbon->subYears($number);
        }

        return $carbon;
    }
}
