<?php

namespace App\Http\Livewire;

use App\Models\Exchanges\Exchange;
use DB;
use Livewire\Component;

class ExchangeRating extends Component
{
    public $data;

    public function mount(Exchange $exchange)
    {
        $this->data = $exchange->only([
            'ease_of_use_avg', 'support_avg', 'value_for_money_avg', 'verification_avg'
        ]);
    }

    public function render()
    {
        return view('livewire.exchange-rating');
    }
}
