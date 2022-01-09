<?php

namespace App\Services\Exchange;

use GuzzleHttp\Client;

class Nobitex extends BaseExchange implements ExchangeAdapter
{
    protected $base = 'https://api.nobitex.ir';

    protected $supported = [
        'btc',
        'eth',
        'ltc',
        'usdt',
        'xrp',
        'bch',
        'bnb',
        'eos',
        'xlm',
        'etc',
        'trx',
        'pmn',
        'doge',
        'uni',
        'dai',
        'link',
        'dot',
        'aave',
        'ada',
        'shi'
    ];

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

        return $this->getCollectionResponse($response);
    }

    public function getAvailableSymbols()
    {
        $response = $this->client()->post($this->url('v2/options'));

        return \Cache::rememberForever('nobitex-symbols', function () use ($response) {
            return collect($this->getcollectionResponse($response)->get('coins'))->skip(0)->filter(function ($coin) {
                $coin = (array)$coin;
                $network = $coin['defaultNetwork'];

                if ($network == 'FIAT_MONEY') return false;

                $network = $coin['networkList']->$network;

                return $network->withdrawEnable && $network->depositEnable;
            })->pluck('coin');
        });
    }

    public function getMarketString(string $symbol, string $dstSymbol)
    {
        return strtolower($symbol . '-' . $dstSymbol);
    }
}
