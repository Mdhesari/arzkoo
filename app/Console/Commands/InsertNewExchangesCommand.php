<?php

namespace App\Console\Commands;

use App\Console\BaseScrapper;
use App\Models\Exchanges\Exchange;
use Illuminate\Console\Command;
use Str;

class InsertNewExchangesCommand extends BaseScrapper
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:new-exchanges';

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
        $start_time = microtime(true);

        $response = $this->cli->request('GET', 'https://tokenbaz.com');

        $bar = $this->output->createProgressBar(intval($response->filter('.heading-title.weight-normal.mt-20 .weight-bold.c-primary')->last()->text()));

        $bar->start();

        $response->filter('#exchange-prices td.text-right a.simple-link')->each(function ($node) use ($bar) {
            $url = $node->attr('href');

            $exchange = explode('/', $url);

            if (!Exchange::whereName($exchange = $exchange[count($exchange) - 1])->exists()) {
                $exchangeResponse = $this->cli->request('GET', $url);

                $data = [];

                $data['name'] = $exchange;
                $data['title'] = mb_substr($exchangeResponse->filter('.exchange-h1')->first()->text(), 0, 64, 'utf-8');
                $data['logo'] = Exchange::storeAndGetExchangeLogoPath($exchangeResponse->filter('.img-responsive.exchange-logo')->first()->attr('src'));
                $data['site'] = 'https://' . optional(parse_url($exchangeResponse->filter('.btn.btn--medium.btn--primary.btn--transparent.btn--with-icon.btn--icon-right.mt-10.mb-20')->first()->attr('href')))['host'];
                $data['status'] = Exchange::STATUS_PENDING;

                $data['description'] = Str::replace('توضیحات صرافی: ', '', $exchangeResponse->filter('.col-lg-11.main-bg .row .col-lg-12.pt-10 .text-justify')->first()->text());

                $exchangeResponse->filter('.info-wrap.pt-20 .postal-data')->each(function ($node) use (&$data) {
                    $text = $node->text();
                    $siblingClass = $node->siblings()->first()->attr('class');

                    if ($siblingClass) {
                        if (Str::contains($siblingClass, ['fa-phone'])) {
                            $data['contacts']['mobiles'] = explode(',', $text);
                        } else if (Str::contains($siblingClass, 'fa-envelope')) {
                            $data['contacts']['emails'] = explode(',', $text);
                        } else if (Str::contains($siblingClass, 'fa-map-marker-alt')) {
                            $data['physcial_address'] = $text;
                        }
                    }
                });

                $exchangeResponse->filter('.row .col-lg-12 > a')->each(function ($node) use (&$data) {
                    $text = $node->attr('href');
                    if ($node->children()->count()) {
                        $childClass = Str::of($node->children()->first()->attr('class'));
                        if ($childClass->contains('instagram')) {
                            $data['contacts']['socials']['instagram'] = $text;
                        } else if ($childClass->contains('twitter')) {
                            $data['contacts']['socials']['twitter'] = $text;
                        } else if ($childClass->contains('telegram')) {
                            $data['contacts']['socials']['telegram'] = $text;
                        }
                    }
                });

                Exchange::create($data);
            }

            $bar->advance();

        });

        $bar->finish();

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = " . $execution_time . " sec");

        return 0;
    }
}
