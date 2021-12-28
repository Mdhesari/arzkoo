<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    /**
     * @return \Illuminate\Http\Client\Response
     */
    public function getHotCoins(): \Illuminate\Http\Client\Response
    {
        return \Http::get('https://api.coinmarketcap.com/data-api/v3/topsearch/rank');
    }
}
