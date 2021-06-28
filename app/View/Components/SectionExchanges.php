<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SectionExchanges extends Component
{
    public $exchanges;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($exchanges)
    {
        $this->exchanges = $exchanges;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section-exchanges');
    }
}
