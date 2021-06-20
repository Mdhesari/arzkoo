<?php

namespace App\Console\Commands;

use App\Console\BaseScrapper;
use GuzzleHttp\Client;
use Http;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class CryptoScrapper extends BaseScrapper
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:cryptos';

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
       $res = $this->cli->request('GET', 'https://data.messari.io/api/v2/assets', ['verify' => false, 'headers' => [
            'x-messari-api-key' => 'f90a730a-eca7-4015-8179-dee4b0ddb13c'
        ]]);

        $response = Http::withHeaders([
            'x-messari-api-key' => 'f90a730a-eca7-4015-8179-dee4b0ddb13c'
        ])->request();

        dd($response->json());
    }
}
