<?php

namespace App\View\Components;

use App\Models\Currencies\Crypto;
use Illuminate\View\Component;

class Searchly extends Component
{

    public $showMetaData;

    public $className;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($showMetaData = true, $className = "searchly")
    {
        $this->showMetaData = $showMetaData;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.searchly', [
            'cryptos' => Crypto::paginate(),
            'totalCryptos' => Crypto::count(),
        ]);
    }
}
