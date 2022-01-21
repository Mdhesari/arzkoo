<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;
use GuzzleHttp\Client;

class Didex extends BaseExchange implements ExchangeAdapter
{
    protected string $base = 'https://api.didex.com/api';

    /**
     * Get supported symbols
     *
     * @return mixed
     */
    public function getSupported()
    {
        return \Cache::rememberForever('didex-symbols', function () {
            $symbols = $this->getCollectionResponse($this->client()->get($this->url('Public/Symbol')));

            $symbols = $symbols->map(function ($symbol) {
                return strtolower($symbol->baseCurrencyShortName);
            });

            return $symbols->unique()->toArray();
        });
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $orderBooks = $this->getCollectionResponse($this->client()->get($this->url('Public/OrderBook')))->recursive();

        $markets = [];

        foreach ($orderBooks as $market => $orderBook) {
            $symbol = $this->getBaseSymbol($market, 'IRT');
            if ($symbol) {
                $market = $this->getMarketString($symbol, 'rls');

                $bestBuy = $this->getBestBuy($orderBook->get('asks'));
                $bestSell = $this->getBestSell($orderBook->get('bids'));

                $markets[$market] = [
                    'bestBuy' => $this->getIranianRial($bestBuy->get('price')),
                    'bestSell' => $this->getIranianRial($bestSell->get('price')),
                    'bestBuyQuantity' => $bestBuy->get('quantity'),
                    'bestSellQuantity' => $bestSell->get('quantity'),
                ];
            }
        }

        return collect($markets);
    }

    private function getBestBuy($bids)
    {
        return $bids->sortByDesc('price')->first();
    }

    private function getBestSell($asks)
    {
        return $asks->sortByDesc('price')->first();
    }
}
