<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateTopCryptosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:update-top-cryptos';

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
        cache()->forget('topCrypto');

        get_top_cryptos();

        return 0;
    }
}
