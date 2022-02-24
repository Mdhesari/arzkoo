<?php

namespace App\Console\Commands;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use App\Services\Exchange\ExchangeAdapter;
use DB;
use Illuminate\Console\Command;

class UpdateExchanges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:update-exchanges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update exchanges prices.';

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

        $query = Exchange::query()->published();

        $bar = $this->output->createProgressBar($query->count());

        $bar->start();

        foreach ($query->cursor() as $exchange) {

            try {
                $exchangeAdapter = app($exchange->name);
            } catch (\Exception $e) {
                report($e);
                $exchangeAdapter = app('nobitex');
            }

            $this->updateExchangeCoins($exchangeAdapter, $exchange);

            $bar->advance();
        }

        $bar->finish();

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = " . $execution_time . " sec");
    }

    private function updateExchangeCoins(ExchangeAdapter $exchangeAdapter, Exchange $exchange)
    {
        $data = collect($exchangeAdapter->getMarketStats(
            $exchange->cryptos()->pluck('symbol')->toArray(),
            ['rls']
        ));

        foreach ($exchange->cryptos()->cursor() as $crypto) {
            $temp = (array)$data->get(
                $exchangeAdapter->getMarketString($crypto->symbol, 'rls')
            );

            if (!empty($temp)) {
                $crypto->exchanges()->updateExistingPivot($exchange, [
                    'buy_price' => $temp['bestBuy'] / 10,
                    'sell_price' => $temp['bestSell'] / 10,
                    'buy_quantity' => $temp['bestBuyQuantity'] ?? null,
                    'sell_quantity' => $temp['bestSellQuantity'] ?? null,
                    'currency' => 'irt',
                ]);
            }
        }
    }


}
