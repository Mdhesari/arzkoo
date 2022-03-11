<?php

namespace App\Services\Exchange;

class Bittestan extends BaseExchange implements ExchangeAdapter
{
    protected string $base = "https://api.bittestan.com";

    /**
     * @return array
     */
    public function getSupported(): array
    {
        return \Cache::rememberForever('bittestan-symbols', function () {
            $coins = $this->getCollectionResponse($this->client()->get($this->url('prices?format=mihanblockchain')));

            return $coins->map(fn($coin) => $coin->symbol)->toArray();
        });
    }

    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $exchangeMarkets = $this->getCollectionResponse($this->client()->get($this->url('prices?format=mihanblockchain')))->recursive();

        $markets = [];

        foreach ($exchangeMarkets as $market) {
            $symbol = $market->get('symbol');

            $marketName = $this->getMarketString(strtolower($symbol), 'rls');

            $markets[$marketName] = [
                'bestBuy'          => $this->getIranianRial($market->get('data')['buy']),
                'bestSell'         => $this->getIranianRial($market->get('data')['sell']),
                'bestBuyQuantity'  => null,
                'bestSellQuantity' => null,
            ];
        }

        return collect($markets);
    }
}
