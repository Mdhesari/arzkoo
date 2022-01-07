<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupDev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dev';

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
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->info('start setting up admin panel...');
        Artisan::call('voyager:install --with-dummy');
        $this->info('start scrap cryptos...');
        $this->call('scrap:cryptos');
        $this->info('start scrap exchanges...');
        $this->call('scrap:exchanges');
        $this->info('start exchanges update...');
        $this->call('scrap:exchanges-update');
        $this->info('done...');
    }
}
