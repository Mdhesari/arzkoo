<?php

namespace App\Console\Commands;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class UpdateExchangesSupportedSymbols extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:update-exchanges-supported';

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

        $query = Exchange::query()->published();

        $bar = $this->output->createProgressBar($query->count());

        $bar->start();

        foreach ($query->cursor() as $exchange) {

            if (!in_array($exchange->name, config('exchange.supported_exchanges'))) {
                $exchange->updateStatusToPending();
                continue;
            }

            try {
                $exchangeAdapter = app($exchange->name);
            } catch (\Exception $e) {
                $exchangeAdapter = app('nobitex');
            }

            $this->updateExchangesSupported($exchangeAdapter, $exchange);

            $bar->advance();
        }

        $bar->finish();

        $end_time = microtime(true);

        $execution_time = ($end_time - $start_time);

        $this->info("\nExecution time of script = " . $execution_time . " sec");
    }

    private function updateExchangesSupported(mixed $exchangeAdapter, mixed $exchange)
    {
        $symbols = collect($exchangeAdapter->getSupported());

        $exchange_crypto = [];

        $symbols->map(function ($symbol) use (&$exchange_crypto) {
            if (!$crypto = Crypto::whereSymbol($symbol)->first()) {
                $symbolData = $this->coinMarketCap()->getSymbolMetaData([
                    'symbol' => $symbol,
                ])->recursive();

                if ($symbolData->has('data')) {

                    $symbolData = $symbolData->get('data')->get(strtoupper($symbol))->toArray();

                    $crypto = Crypto::create([
                        'name' => $symbolData['name'],
                        'symbol' => $symbolData['symbol'],
                        'logo' => $symbolData['logo'],
                        'price' => 1,
                        'volume' => 1,
                        'market_cap' => 1,
                    ]);
                }
            }

            if ($crypto) {
                $exchange_crypto[$crypto->id] = [
                    'buy_price' => 1,
                    'sell_price' => 1,
                    'currency' => 'irt',
                ];
            }
        });

        $exchange->cryptos()->sync($exchange_crypto);
    }

    private function coinMarketCap()
    {
        return app('coinmarketcap');
    }
}
