<?php

namespace App\Http\Controllers;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use SEOMeta;

class HomeController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('مرجع خرید و فروش و بررسی صرافی و رمز ارزها');

        return view('home.index', [
            'exchanges' => Exchange::published()->get(),
        ]);
    }
}
