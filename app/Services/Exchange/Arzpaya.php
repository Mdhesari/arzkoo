<?php

namespace App\Services\Exchange;

class Arzpaya extends BaseExchange implements ExchangeAdapter
{
    protected string $base = "https://api.arzpaya.com";

    /**
     * @return array
     */
    public function getSupported(): array
    {
        $symbols = $this->getCollectionResponse($this->client()->get($this->url('Public/GetPrice/irt')));

        return $symbols->keys()->map(fn($symbol) => substr($symbol, 0, strpos($symbol, 'IR')))->toArray();
    }

    public function getMarketStats(array $srcCurrency, array $dstCurrency)
    {
        $exchangeMarkets = $this->getCollectionResponse($this->client()->get($this->url('Public/GetPrice/irt')));

        $markets = [];

        foreach ($exchangeMarkets as $market => $data) {
            $symbol = $this->getBaseSymbol($market, 'IR');

            if ($symbol && in_array(strtolower($symbol), $srcCurrency)) {
                $marketName = $this->getMarketString(strtolower($symbol), 'rls');

                $markets[$marketName] = [
                    'bestBuy' => $data->BuyPrice,
                    'bestSell' => $data->SellPrice,
                    'bestBuyQuantity' => null,
                    'bestSellQuantity' => null,
                ];
            }
        }

        return collect($markets);
    }
}
