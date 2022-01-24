<?php

namespace App\Services\Exchange;

use GuzzleHttp\Client;

class Saraf extends BaseExchange implements ExchangeAdapter
{
    protected string $base = 'https://api.saraf.io';

    /**
     * Get supported symbols
     *
     * @return mixed
     */
    public function getSupported()
    {
        return \Cache::rememberForever('saraf-symbols', function () {
            $markets = $this->getCollectionResponse($this->client()->get($this->url('exchanger/market/summery')));

            $symbols = $markets->map(function ($market) {
                if ($symbol = $this->getBaseSymbol($market->symbol, 'IRR')) {
                    return strtolower($symbol);
                }
            })->filter(fn($symbol) => !is_null($symbol))->unique();

            return $symbols->toArray();
        });
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $exchangeMarkets = $this->getCollectionResponse($this->client()->get($this->url('exchanger/market/summery')))->toArray();

        $markets = [];

        foreach ($exchangeMarkets as $market) {
            $symbol = $this->getBaseSymbol($market->symbol, 'IRR');

            if ($symbol && in_array(strtolower($symbol), $srcCurrency)) {
                $marketName = $this->getMarketString(strtolower($symbol), 'rls');

                $markets[$marketName] = [
                    'bestBuy' => $market->bestBidPrice,
                    'bestSell' => $market->bestAskPrice,
                    'bestBuyQuantity' => $market->bestAskVolume,
                    'bestSellQuantity' => $market->bestBidVolume,
                ];
            }
        }
        return collect($markets);
    }
}
