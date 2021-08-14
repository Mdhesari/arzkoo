<?php

namespace App\Console\Commands;

use App\Console\BaseScrapper;
use App\Models\Exchanges\Exchange;
use Illuminate\Console\Command;
use Str;
use Symfony\Component\DomCrawler\Crawler;

class UpdateExchangeScrapper extends BaseScrapper
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:exchanges-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start_time = microtime(true);

        $exchanges = Exchange::cursor();

        $bar = $this->output->createProgressBar(Exchange::count());

        $bar->start();

        foreach ($exchanges as $exchange) {
            $exchanges_update = [];

            $response = $this->cli->request('GET', 'https://tokenbaz.com/exchange/' . $exchange->name);

            $response->filter('.col-lg-12.pt-10')->each(function ($node) use (&$exchanges_update) {
                $text = $node->text();
                if (!empty($text)) {
                    $exchanges_update = [
                        'description' => $text,
                    ];
                }
            });

            $response->filter('.info-wrap.pt-20 .postal-data')->each(function ($node) use (&$exchanges_update) {
                $text = $node->text();
                $siblingClass = $node->siblings()->first()->attr('class');

                if ($siblingClass) {
                    if (Str::contains($siblingClass, ['fa-phone'])) {
                        $exchanges_update['contacts']['mobiles'] = explode(',', $text);
                    } else if (Str::contains($siblingClass, 'fa-envelope')) {
                        $exchanges_update['contacts']['emails'] = explode(',', $text);
                    } else if (Str::contains($siblingClass, 'fa-map-marker-alt')) {
                        $exchanges_update['physcial_address'] = $text;
                    }
                }
            });

            $response->filter('.col-lg-12.pt-10 > a')->each(function ($node) use (&$exchanges_update) {
                $text = $node->attr('href');
                $childClass = Str::of($node->children()->first()->attr('class'));

                if ($childClass->contains('instagram')) {
                    $exchanges_update['contacts']['socials']['instagram'] = $text;
                } else if ($childClass->contains('twitter')) {
                    $exchanges_update['contacts']['socials']['twitter'] = $text;
                } else if ($childClass->contains('telegram')) {
                    $exchanges_update['contacts']['socials']['telegram'] = $text;
                }
            });

            $exchange->update($exchanges_update);

            $bar->advance();
        }

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = " . $execution_time . " sec");
    }
}
