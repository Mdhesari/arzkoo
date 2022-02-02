<?php

namespace App\View\Components;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Illuminate\View\Component;

class ExchangeBox extends Component
{
    public $exchange;

    public $crypto;

    public $isBuy;

    public $bestExchange;

    public $isBestToBuy;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Exchange $exchange, Crypto $crypto, $isBuy = true, $isBest = false)
    {
        $this->exchange = $exchange;
        $this->crypto = $crypto;
        $this->isBuy = $isBuy;
        $this->isBestToBuy = $isBest;
        $this->bestExchange = ($isBuy ? $crypto->bestBuyExchange() : $crypto->bestSellExchange())->select('buy_price', 'sell_price')->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.exchange-box', [
            'isFeatured' => $this->exchange->isFeatured(),
        ]);
    }
}
