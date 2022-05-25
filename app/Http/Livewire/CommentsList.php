<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CommentsList extends Component
{
    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.comments-list', [
            'comments' => $this->post->comments()->approved()->paginate(10, ['*'], 'commentsPage'),
        ]);
    }
}
