<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Models\Currencies\Crypto;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function getCurrencies(Request $request)
    {
        $search = $request->search;

        return CurrencyResource::collection(
            Crypto::where('name', 'Like', '%' . $search . '%')->paginate()
        );
    }
}
