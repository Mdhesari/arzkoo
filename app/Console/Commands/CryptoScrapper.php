<?php

namespace App\Console\Commands;

use App\Console\BaseScrapper;
use App\Models\Currencies\Crypto;
use DB;
use Exception;
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
        $start_time = microtime(true);

        $response = Http::withHeaders([
            'x-messari-api-key' => 'f90a730a-eca7-4015-8179-dee4b0ddb13c'
        ])->get('https://data.messari.io/api/v2/assets');

        $data = $response->json()['data'];

        $bar = $this->output->createProgressBar(count($data));

        $bar->start();

        try {
            DB::beginTransaction();

            foreach ($data as $item) {

                $crypto = Crypto::whereSymbol($item['symbol'])->first();

                if (is_null($crypto))
                    $crypto = Crypto::create([
                        'symbol' => $item['symbol'],
                        'name' => $item['name'],
                        'price' => $item['metrics']['market_data']['price_usd'],
                        'volume' => $item['metrics']['market_data']['volume_last_24_hours'],
                        'market_cap' => $item['metrics']['marketcap']['current_marketcap_usd'],
                    ]);

                $bar->advance();
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
            DB::rollBack();
        }

        $bar->finish();

        DB::commit();

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = " . $execution_time . " sec");
    }
}
