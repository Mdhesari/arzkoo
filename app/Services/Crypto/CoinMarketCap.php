<?php

namespace App\Services\Crypto;

use App\Services\BaseAPI;

class CoinMarketCap extends BaseAPI
{

    protected string $base = 'https://pro-api.coinmarketcap.com';

    public function getCryptos($data = null): \Illuminate\Support\Collection
    {
        if (is_null($data)) {
            $data = [
                'limit' => 10,
            ];
        }

        $response = $this->client()->get($this->url('v1/cryptocurrency/listings/latest?' . http_build_query($data)), [
            'headers' => [
                'X-CMC_PRO_API_KEY' => config('crypto.coinmarketcap.api_key'),
            ]
        ]);

        return $this->getCollectionResponse($response);
    }
}
