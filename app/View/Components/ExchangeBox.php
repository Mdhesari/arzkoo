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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Exchange $exchange, Crypto $crypto, $isBuy = true)
    {
        $this->exchange = $exchange;
        $this->crypto = $crypto;
        $this->isBuy = $isBuy;
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
