<?php

namespace App\Services\Exchange;

interface ExchangeAdapter
{
    /**
     * @param array $srcCurrency
     * @param array $dstCurrency
     * @return mixed
     */
    public function getMarketStats(array $srcCurrency, array $dstCurrency);

    /**
     * @param string $symbol
     * @param string $dstSymbol
     * @return mixed
     */
    public function getMarketString(string $symbol, string $dstSymbol);

    /**
     * @return mixed
     */
    public function getSupported();
}
