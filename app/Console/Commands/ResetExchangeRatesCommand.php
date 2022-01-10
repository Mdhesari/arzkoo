<?php

namespace App\Console\Commands;

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
        Exchange::all()->map(function ($exchange) {
            $exchange->ratings()->delete();
            $exchange->calcAverageRate();
        });

        return 0;
    }
}
