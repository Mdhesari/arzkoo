<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentItem extends Component
{
    public $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
