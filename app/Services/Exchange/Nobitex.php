<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;
use GuzzleHttp\Client;

class Nobitex extends BaseExchange implements ExchangeAdapter
{
    protected string $base = 'https://api.nobitex.ir';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $srcCurrency = strtolower(collect($srcCurrency)->flip()->only($this->supported)->flip()->join(','));

        $dstCurrency = strtolower(join(',', $dstCurrency));

        $response = $this->client()->get($this->url('market/stats'), [
            'query' => compact('srcCurrency', 'dstCurrency'),
        ]);

        return $this->getCollectionResponse($response)->get('stats');
    }

    public function getSupported()
    {
        return \Cache::rememberForever('nobitex-symbols', function () {
            $orderBooks = $this->getcollectionResponse($this->client()->get($this->url('v2/orderbook/all')));

            $symbols = $orderBooks->map(function ($orderBook, $market) {
                if ($symbol = $this->getBaseSymbol($market, 'IRT')) {
                    return strtolower($symbol);
                }
            })->filter(fn($symbol) => !is_null($symbol))->unique();

            return $symbols->values()->toArray();
        });
    }
}
