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
];
