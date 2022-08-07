<?php

namespace App\Http\Controllers;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Illuminate\Http\Request;
use SEOMeta;

class ExchangeController extends Controller
{
    public function __construct()
    {
        SEOMeta::setTitle('لیست صرافی ها و کارگزاران ارزهای پایه');
        SEOMeta::setDescription('لیست صرافی ها و کارگزاران ارز های پایه را مشاهده کنید و از بین این صرافی ها، بهترین صرافی ها را پیدا کرده و خرید و فروش خود را انجام دهید.');
        SEOMeta::setCanonical(route('exchanges.home'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('exchange.index', [
            'exchanges' => Exchange::published()->cursor()
        ]);
    }


    public function buyList(Request $request, Crypto $crypto)
    {
        $isBuy = true;

        return view('exchange.list', compact('crypto', 'isBuy'));
    }

    public function sellList(Request $request, Crypto $crypto)
    {
        $isBuy = false;

        return view('exchange.list', compact('crypto', 'isBuy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Exchange $exchange)
    {
        SEOMeta::setTitle(
            ' نقد و بررسی صرافی '.$exchange->persian_title.' ('.$exchange->title.') '
        );
        SEOMeta::setDescription($exchange->description);
        SEOMeta::setCanonical(route('exchanges.home'));

        $cryptos = $exchange->cryptos()->paginate();

        return view('exchange.show', compact('exchange', 'cryptos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
