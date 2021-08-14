<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDataTypes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:data-types';

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
        $this->call('db:seed', [
            'class' => 'ArzkooDataTypesTableSeeder',
        ]);
        $this->call('db:seed', [
            'class' => 'ArzkooDataRowsTableSeeder'
        ]);
        $this->call('db:seed', [
            'class' => 'PermissionsTableSeeder',
        ]);
        $this->call('db:seed', [
            'class' => 'ArzkooMenuItemsTableSeeder',
        ]);
        $this->call('db:seed', [
            'class' => 'PermissionRoleTableSeeder',
        ]);
    }
}
