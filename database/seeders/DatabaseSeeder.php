<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Database\Seeders\AdminDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(
            AdminDatabaseSeeder::class,
        );
    }
}
