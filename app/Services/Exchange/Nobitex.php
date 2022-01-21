<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;
use GuzzleHttp\Client;

class Nobitex extends BaseAPI implements ExchangeAdapter
{
    protected string $base = 'https://api.nobitex.ir';

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

        return $this->getCollectionResponse($response)->get('stats');
    }

    public function getSupported()
    {
        return \Cache::rememberForever('nobitex-symbols', function () {
            $response = $this->client()->post($this->url('v2/options'));
            return collect($this->getcollectionResponse($response)->get('coins'))->skip(0)->filter(function ($coin) {
                $coin = (array)$coin;
                $network = $coin['defaultNetwork'];

                if ($network == 'FIAT_MONEY') return false;

                $network = $coin['networkList']->$network;

                return $network->withdrawEnable && $network->depositEnable;
            })->pluck('coin')->toArray();
        });
    }
}
