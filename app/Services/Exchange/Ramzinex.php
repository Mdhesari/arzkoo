<?php

namespace App\Services\Exchange;

use GuzzleHttp\Client;

class Ramzinex extends BaseExchange implements ExchangeAdapter
{
    protected string $base = 'https://publicapi.ramzinex.com/exchange/api';

    /**
     * Get supported symbols
     *
     * @return mixed
     */
    public function getSupported()
    {
        return \Cache::rememberForever('ramzinex-symbols', function () {
            $currencies = $this->getCollectionResponse($this->client()->get($this->url('v1.0/exchange/currencies')))->recursive()->get('data');
            $symbols = $currencies->map(function ($currency) {
                return strtolower($currency->get('symbol'));
            })->filter(fn($item) => !in_array($item, ['irr', 'usdt_omni']));

            return $symbols->toArray();
        });
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $exchangeMarkets = $this->getCollectionResponse($this->client()->get($this->url('v1.0/exchange/pairs')))->recursive()->get('data');

        $markets = [];

        foreach ($exchangeMarkets as $market) {
            $symbol = $market->get('base_currency_symbol')->get('en');
            $quoteSymbol = $market->get('quote_currency_symbol')->get('en');

            if ($symbol && in_array(strtolower($symbol), $srcCurrency) && $quoteSymbol == 'irr') {
                $marketName = $this->getMarketString(strtolower($symbol), 'rls');
                $markets[$marketName] = [
                    'bestBuy' => $market->get('buy'),
                    'bestSell' => $market->get('sell'),
                    'bestBuyQuantity' => null,
                    'bestSellQuantity' => null,
                ];
            }
        }
        return collect($markets);
    }
}
