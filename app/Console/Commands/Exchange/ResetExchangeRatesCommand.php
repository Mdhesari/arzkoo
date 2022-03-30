<?php

namespace App\Console\Commands\Content\Exchange\Exchange\Arzkoo\Arzkoo\Mail\Content\Exchange;

use App\Models\Exchanges\Exchange;
use Illuminate\Console\Command;

class ResetExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:reset-exchange-rates';

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
        Exchange::published()->get()->map(function ($exchange) {
            $exchange->ratings()->delete();
            $exchange->calcAverageRate();
            $exchange->updateRatingsAvg();
        });

        return 0;
    }
}
