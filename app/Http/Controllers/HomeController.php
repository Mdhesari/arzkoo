<?php

namespace App\Http\Controllers;

use App\Models\Exchanges\Exchange;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'exchanges' => Exchange::published()->get()
        ]);
    }
}
