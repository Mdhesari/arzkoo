<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEOMeta;

class CryptoController extends Controller
{
    public function __construct()
    {
        SEOMeta::setTitle('قیمت لحظه ای رمز ارزها');
        SEOMeta::setCanonical(route('live-price'));
    }

    public function livePrices()
    {
        return view('crypto.index');
    }
}
