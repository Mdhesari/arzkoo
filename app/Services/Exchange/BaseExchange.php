<?php

namespace App\Services\Exchange;

use GuzzleHttp\Client;

abstract class BaseExchange
{
    /**
     * @var string
     */
    protected $base = '';

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
}