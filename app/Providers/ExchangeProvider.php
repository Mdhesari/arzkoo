<?php

namespace App\Providers;

use App\Services\Exchange\Arzpaya;
use App\Services\Exchange\Bittestan;
use App\Services\Exchange\Didex;
use App\Services\Exchange\Exir;
use App\Services\Exchange\Kucoin;
use App\Services\Exchange\Nobitex;
use App\Services\Exchange\Ramzinex;
use App\Services\Exchange\Saraf;
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
        foreach (config('exchange.adapters') as $adapter) {
            $this->app->bind($adapter);
        }
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
