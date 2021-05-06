<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'posts' => Post::published()->latest()->paginate(),
        ]);
    }

    public function show(Post $post)
    {
        return $post;
    }
}
