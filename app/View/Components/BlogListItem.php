<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class BlogListItem extends Component
{

    public $post;
    public $isFull;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post = null, $isFull = false)
    {
        $this->post = $post ?: new Post;
        $this->isFull = $isFull;

        if ($isFull) {
            $this->class = "col-lg-12 col-md-12";
        } else {
            $this->class = "col-lg-6 col-md-6";
        }

        $this->class .= " col-sm-12 col-xs-12 blog";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog-list-item');
    }
}
