<?php

namespace App\Console\Commands\Arzkoo;

use App\Models\Exchanges\Exchange;
use Illuminate\Console\Command;

class ConfigExchangesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:config-exchanges';

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
        $this->call('optimize:clear');

        $this->call('scrap:new-exchanges');
        $this->call('arzkoo:update-exchanges-supported');
        $this->call('arzkoo:update-exchanges');

        $this->call('optimize');

        return 0;
    }
}
