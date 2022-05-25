<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Supported Exchanges In Arzkoo
    |--------------------------------------------------------------------------
    |
    | Available exchanges api we have
    |
    */

    'supported_exchanges' => explode(',', env('SUPPORTED_EXCHANGE', 'nobitex')),

    'adapters' => [
        'nobitex'   => App\Services\Exchange\Nobitex::class,
        'didex'     => App\Services\Exchange\Didex::class,
        'ramzinex'  => App\Services\Exchange\Ramzinex::class,
        'saraf'     => App\Services\Exchange\Saraf::class,
        'exir'      => App\Services\Exchange\Exir::class,
        'arzpaya'   => App\Services\Exchange\Arzpaya::class,
        'bittestan' => App\Services\Exchange\Bittestan::class,
        'kucoin'    => App\Services\Exchange\Kucoin::class,
    ],
];
