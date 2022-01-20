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
                'X-CMC_PRO_API_KEY' => $this->getApiKey(),
            ]
        ]);

        return $this->getCollectionResponse($response);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSymbolMetaData($data = ['symbol' => 'btc']): \Illuminate\Support\Collection
    {
        if (empty($data)) {
            throw new \Exception('Enter at least on argument. {["symbol"=>"btc"]}');
        }

        $response = $this->client()->get($this->url('v1/cryptocurrency/info'), [
            'headers' => [
                'X-CMC_PRO_API_KEY' => $this->getApiKey(),
            ],
            'query' => $data,
        ]);

        return $this->getCollectionResponse($response);
    }

    public function getApiKey()
    {
        return config('crypto.coinmarketcap.api_key');
    }
}
