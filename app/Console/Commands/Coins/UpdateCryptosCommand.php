<?php

namespace App\Console\Commands\Exchange\Content\Coins;

use App\Jobs\UpdateCryptosLogo;
use Illuminate\Console\Command;

class UpdateCryptosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:update-cryptos';

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
        dispatch(new UpdateCryptosLogo);

        return 0;
    }
}
