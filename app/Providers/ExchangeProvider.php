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
        $this->app->bind('nobitex', Nobitex::class);
        $this->app->bind('didex', Didex::class);
        $this->app->bind('ramzinex', Ramzinex::class);
        $this->app->bind('saraf', Saraf::class);
        $this->app->bind('exir', Exir::class);
        $this->app->bind('arzpaya', Arzpaya::class);
        $this->app->bind('bittestan', Bittestan::class);
        $this->app->bind('kucoin', Kucoin::class);
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
