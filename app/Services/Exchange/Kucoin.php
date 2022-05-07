<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;
use GuzzleHttp\Client;

class Kucoin extends BaseExchange implements ExchangeAdapter
{
    protected string $base = 'https://api.kucoin.com';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $exchangeMarkets = $this->getCollectionResponse(
            $this->client()->get($this->url('api/v1/market/allTickers'))
        )->recursive()->get('data')->get('ticker');

        $markets = [];

        foreach ($exchangeMarkets as $exchangeMarket) {
            $symbol = $this->getBaseSymbol(\Str::replace('-', '', $exchangeMarket['symbol']), 'USDT');

            if ( $symbol ) {
                $market = $this->getMarketString($symbol, 'rls');

                $bestBuy = $exchangeMarket->get('buy');
                $bestSell = $exchangeMarket->get('sell');

                $markets[$market] = [
                    'bestBuy'          => $this->getIranianRial($this->getUSDTToIRR($bestBuy)),
                    'bestSell'         => $this->getIranianRial($this->getUSDTToIRR($bestSell)),
                    'bestBuyQuantity'  => null,
                    'bestSellQuantity' => null,
                ];

                dd($markets);
            }
        }
        return collect($markets);
    }

    public function getSupported()
    {
        return \Cache::rememberForever('kucoin-symbols', function () {
            $symbols = $this->getcollectionResponse($this->client()->get($this->url('api/v1/symbols')))->recursive()->get('data');

            $symbols = $symbols->map(function ($symbol) {
                if ( $symbol['enableTrading'] && $symbol['quoteCurrency'] === 'USDT' ) {
                    return strtolower($symbol['baseCurrency']);
                }
            })->filter(fn($symbol) => ! is_null($symbol))->unique();

            return $symbols->values()->toArray();
        });
    }
}
