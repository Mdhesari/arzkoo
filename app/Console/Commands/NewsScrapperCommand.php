<?php

namespace App\Console\Commands;

use App\Console\BaseScrapper;
use App\Models\News;
use Cache;
use Illuminate\Console\Command;

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

        $response->filter('.arz-breaking-news__list')->children()->each(function ($node) use (&$news_arr) {
            $nodeLink = $node->children('.arz-breaking-news__item-link.arz-ignore-link')->first();
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
            ];

            if (!News::whereJsonContains('meta->post_id', $nodeLink->attr('data-post-id'))->exists())
                $news_arr[] = $data;

        });

        return News::insert($news_arr);
    }
}
