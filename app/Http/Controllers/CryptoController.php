<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function livePrices()
    {
        return view('crypto.index');
    }
}
