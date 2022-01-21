<?php

namespace App\Services\Exchange;

use App\Services\BaseAPI;

abstract class BaseExchange extends BaseAPI
{
    /**
     * @var array
     */
    protected array $supported = [];

    public function __construct()
    {
        $this->supported = $this->getSupported();
    }
}
