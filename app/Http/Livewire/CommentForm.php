<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CommentForm extends Component
{
    public $body;
    public $post;

    protected $rules = [
        'body' => ['required', 'min:3'],
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.comment-form');
    }

    public function submit()
    {
        if ( ! \Gate::check('comment', $this->post) ) {
            return $this->emit('unauthorized');
        }

        $this->validate();

        $this->post->commentAsUser(\Auth::user(), $this->body);

        $this->emit('new-comment');

        $this->fill([
            'body' => '',
        ]);
    }
}
