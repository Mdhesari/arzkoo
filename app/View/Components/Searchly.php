<?php

namespace App\View\Components;

use App\Models\Currencies\Crypto;
use Illuminate\View\Component;

class Searchly extends Component
{

    public $showMetaData;

    public $crypto;

    public $className;

    public $isBuy;

    public $favCryptos;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showMetaData = true, $className = "searchly", $crypto = null, $isBuy = true)
    {
        $this->showMetaData = $showMetaData;
        $this->className = $className;
        $this->isBuy = $isBuy;
        $this->crypto = $crypto;
        $this->favCryptos = Crypto::with([
            'bestBuyExchange' => function ($query) {
                return $query->published();
            }
        ])->whereIn('symbol', get_top_cryptos())->limit(10)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $query = Crypto::query();

        if ($this->crypto) {
            $query->offset($this->crypto->id);
        }

        return view('components.searchly', [
            'cryptos' => $query->paginate(),
            'totalCryptos' => $query->count(),
        ]);
    }
}
