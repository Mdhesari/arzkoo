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
        SEOMeta::setDescription('اگر قصد خرید یک ارز دیجیتال رو داشته باشید، ما ارزون ترین قیمت در صرافی هارو براتون پیدا میکنیم و اگر قصد فروش داشته باشید ما بالاترین خریدار رو از بین صرافی ها براتون پیدا میکنیم.');

        return view('home.index', [
            'exchanges' => Exchange::published()->inRandomOrder()->get(),
        ]);
    }
}
