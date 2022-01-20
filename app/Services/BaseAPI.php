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

    protected function headers(): array
    {
        return [
            'accept' => 'application/json',
        ];
    }

    protected function url(string $string): string
    {
        return $this->base . '/' . $string;
    }

    protected function getCollectionResponse(\Psr\Http\Message\ResponseInterface $response): \Illuminate\Support\Collection
    {
        return collect(json_decode($response->getBody()->getContents()));
    }

    public function getMarketString(string $symbol, string $dstSymbol): string
    {
        return strtolower($symbol . '-' . $dstSymbol);
    }

    protected function getIranianRial($getBestBuyPrice): float|int
    {
        return $getBestBuyPrice * 10;
    }
}
