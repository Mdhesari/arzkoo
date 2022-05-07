<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class BaseAPI
{
    /**
     * @var string
     */
    protected string $base = '';

    /**
     * @return \GuzzleHttp\Client
     */
    protected function client(): \GuzzleHttp\Client
    {
        return app(Client::class);
    }

    /**
     * @return string[]
     */
    protected function headers(): array
    {
        return [
            'accept' => 'application/json',
        ];
    }

    /**
     * @param string $string
     * @return string
     */
    protected function url(string $string): string
    {
        return $this->base.'/'.$string;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \Illuminate\Support\Collection
     */
    protected function getCollectionResponse(\Psr\Http\Message\ResponseInterface $response): \Illuminate\Support\Collection
    {
        return collect(json_decode($response->getBody()->getContents()));
    }

    /**
     * @param string $symbol
     * @param string $dstSymbol
     * @return string
     */
    public function getMarketString(string $symbol, string $dstSymbol): string
    {
        return strtolower($symbol.'-'.$dstSymbol);
    }

    /**
     * @param $irtAmount
     * @return float|int
     */
    protected function getIranianRial($irtAmount): float|int
    {
        return $irtAmount * 10;
    }

    /**
     * @param $market
     * @param $quoteSymbol
     * @return bool|string
     */
    protected function getBaseSymbol($market, $quoteSymbol): bool|string
    {
        if ( strpos($market = strtoupper($market), $quoteSymbol = strtoupper($quoteSymbol)) ) {
            return substr($market, 0, strpos($market, $quoteSymbol));
        }

        return false;
    }

    protected function getUSDTToIRR($quantity): float|int
    {
        return $quantity * get_usdt_to_irr();
    }
}
