<?php

return [
    'coinmarketcap' => [
        'api_key' => env('COINMARKETCAP_API_KEY'),
        'unsupported' => array_replace(
            explode(',', env('COINMARKETCAP_UNSUPPORTED')),
            ['XDCE', 'NANO', 'PAX']
        )
    ]
];
