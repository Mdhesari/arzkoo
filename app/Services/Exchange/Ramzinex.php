<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;
use GuzzleHttp\Client;

class Ramzinex extends BaseAPI implements ExchangeAdapter
{
    protected string $base = 'https://api.saraf.io';

    protected array $supported = [];

    public function __construct()
    {
        $this->supported = $this->getSupported();
    }

    /**
     * Get supported symbols
     *
     * @return mixed
     */
    public function getSupported()
    {
        return \Cache::rememberForever('ramzinex-symbols', function () {
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

            if ($symbol && in_array($symbol, $srcCurrency)) {
                $marketName = $this->getMarketString(strtolower($symbol), 'rls');

                $markets[$marketName] = [
                    'bestBuy' => $market->bestAskPrice,
                    'bestSell' => $market->bestBidPrice,
                    'bestBuyQuantity' => $market->bestAskVolume,
                    'bestSellQuantity' => $market->bestBidVolume,
                ];
            }
        }

        return collect($markets);
    }

    protected function getBaseSymbol($market, $quoteSymbol)
    {
        if (strpos(strtoupper($market), strtoupper($quoteSymbol))) {
            return substr($market, 0, strpos($market, $quoteSymbol));
        }

        return false;
    }
}
