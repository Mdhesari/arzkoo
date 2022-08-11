<?php

namespace App\Console\Commands\Coins;

use App\Console\BaseScrapper;
use App\Models\Currencies\Crypto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CryptoDetailsScrapper extends BaseScrapper
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:cryptos-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap crypto details.';

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

        $data = [];

        $bar = $this->output->createProgressBar(Crypto::count());

        $bar->start();

        foreach (Crypto::cursor() as $crypto) {
            $response = $this->cli->request('GET', 'https://arzdigital.com/coins/'.$crypto->name);

            $data['fa_name'] = $response->filter('.arz-coin-page-tab__title')->first()->text();

            $data['description'] = $response->filter('.arz-coin-details__explanation-text')->first()->text();

            if ( $data['fa_name'] ) {
                $crypto->update($data);
            }

            $bar->advance();

        }

        $bar->finish();

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = ".$execution_time." sec");

        return 0;
    }
}
