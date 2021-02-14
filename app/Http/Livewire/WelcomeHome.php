<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WelcomeHome extends Component
{

    public $title = "Arzkoo";

    public function render()
    {
        return view('livewire.welcome-home');
    }
}
