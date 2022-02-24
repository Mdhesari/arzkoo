<?php

namespace App\Services\Exchange;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class Exir extends BaseExchange implements ExchangeAdapter
{
    protected string $base = 'https://api.exir.io/v1';

    /**
     * Get supported symbols
     *
     * @return mixed
     */
    public function getSupported()
    {
        return \Cache::rememberForever('exir-symbols', function () {
            $coins = $this->getCollectionResponse($this->client()->get($this->url('constant')))->recursive()->get('coins');
            $coins = $coins->filter(fn($coin) => $coin['active'] && strtolower($coin['type']) === 'blockchain');

            return array_keys($coins->toArray());
        });
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $exchangeMarkets = $this->getCollectionResponse(
            $this->client()->get($this->url('orderbooks'))
        )->recursive();

        $markets = [];

        foreach ($exchangeMarkets as $market => $orderBook) {
            $symbol = $this->getBaseSymbol(\Str::replace('-', '', $market), 'IRT');

            if ($symbol) {
                $market = $this->getMarketString($symbol, 'rls');

                $bestBuy = $this->getBestBuy($orderBook->get('bids'));
                $bestSell = $this->getBestSell($orderBook->get('asks'));

                $markets[$market] = [
                    'bestBuy' => $this->getIranianRial($bestBuy->first()),
                    'bestSell' => $this->getIranianRial($bestSell->first()),
                    'bestBuyQuantity' => $bestBuy->last(),
                    'bestSellQuantity' => $bestSell->last(),
                ];
            }
        }
        return collect($markets);
    }

    private function getBestBuy(Collection $bids)
    {
        return $bids->first();
    }

    private function getBestSell(Collection $asks)
    {
        return $asks->first();
    }
}
