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
        $this->data = $exchange->ratings()->select(
            DB::raw('SUM(ease_of_use_range) / count(ease_of_use_range) AS ease_of_use_range'),
            DB::raw('SUM(support_range) / count(support_range) AS support_range'),
            DB::raw('SUM(value_for_money_range) / count(value_for_money_range) AS value_for_money_range'),
            DB::raw('SUM(verification_range) / count(verification_range) AS verification_range'),
        )->first()->toArray();
    }

    public function render()
    {
        return view('livewire.exchange-rating');
    }
}
