<?php

namespace App\Providers;

use App\Services\Exchange\Didex;
use App\Services\Exchange\Nobitex;
use App\Services\Exchange\Ramzinex;
use Illuminate\Support\ServiceProvider;

class ExchangeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('nobitex', Nobitex::class);
        $this->app->bind('didex', Didex::class);
        $this->app->bind('ramzinex', Ramzinex::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
