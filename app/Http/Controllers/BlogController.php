<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index', [
            'posts' => Post::published()->latest()->paginate(1),
        ]);
    }

    public function show(Post $post)
    {
        return view('blog.show', [
            'post' => $post,
        ]);
    }
}
