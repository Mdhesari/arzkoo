<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ReviewsSection extends Component
{

    public $exchange;

    public $ratings;

    public function mount($exchange)
    {
        $this->exchange = $exchange;
        $this->ratings = $exchange->ratings;
    }

    public function render()
    {
        return view('livewire.reviews-section');
    }
}
