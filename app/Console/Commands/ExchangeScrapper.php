<?php

namespace App\Console\Commands;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Http;
use Illuminate\Console\Command;

class ExchangeScrapper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:exchanges';

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

        $url = "tokenbaz.com/get/prices?coin=btc&sort=buy_price";
        $query = [
            'sort' => 'buy_price'
        ];

        $bar = $this->output->createProgressBar(Crypto::count());

        $bar->start();

        foreach (Crypto::cursor() as $crypto) {
            $query['coin'] = strtolower($crypto->symbol);

            $data = $this->getExchanges($url, $query);

            $crypto->storeExchanges($data);

            $bar->advance();
        }

        $bar->finish();

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = " . $execution_time . " sec");
    }

    private function getExchanges(string $url, array $query)
    {
        $response = Http::get($url, $query);

        return $response->json();
    }
}
