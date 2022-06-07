<?php

namespace App\Console\Commands\Content;

use App\Models\Exchanges\Exchange;
use App\Models\Post;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;
use TCG\Voyager\Models\Page;

class SitemapGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('Generating sitemap...');

        $generator = SitemapGenerator::create(config('app.url'))->getSitemap();

        foreach (Page::active()->cursor() as $page) {
            $generator->add(
                Url::create(url($page->slug))
                    ->setLastModificationDate($page->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        foreach (Post::cursor() as $post) {
            $generator->add(
                Url::create(url($post->slug))
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        foreach (Exchange::published()->cursor() as $exchange) {
            $generator->add(
                Url::create(route('exchanges.show', $exchange))
                    ->setLastModificationDate($exchange->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        $generator->writeToFile(public_path('sitemap.xml'));

        $this->info('End Generating sitemap...');
    }
}
