<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;
use GuzzleHttp\Client;

class Didex extends BaseAPI implements ExchangeAdapter
{
    protected string $base = 'https://api.didex.com/api';

    protected $supported = null;

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
//        $srcCurrency = strtolower(collect($srcCurrency)->flip()->only($this->supported)->flip()->join(','));
//
//        $dstCurrency = strtolower(join(',', $dstCurrency));

        $orderBooks = $this->getCollectionResponse($this->client()->get($this->url('Public/OrderBook')))->recursive();

        $markets = [];

        foreach ($orderBooks as $market => $orderBook) {
            if (strpos(strtoupper($market), 'IRT')) {
                $symbol = substr($market, 0, strpos($market, 'IRT'));
                $market = $this->getMarketString(strtolower($symbol), 'rls');

                $bestBuy = $this->getBestBuy($orderBook->get('asks'));
                $bestSell = $this->getBestSell($orderBook->get('bids'));

                $markets[$market] = [
                    'bestBuy' => $this->getIranianRial($bestBuy->get('price')),
                    'bestSell' => $this->getIranianRial($bestSell->get('price')),
                    'bestBuyQuantity' => $bestBuy->get('quantity'),
                    'sellBuyQuantity' => $bestSell->get('quantity'),
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
