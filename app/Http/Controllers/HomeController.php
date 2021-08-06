<?php

namespace App\Http\Controllers;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'exchanges' => Exchange::published()->get(),
        ]);
    }
}
