<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use SEOMeta;

class BlogController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('مقاله ها');

        return view('blog.index', [
            'posts' => Post::published()->latest()->paginate(),
        ]);
    }

    public function show(Post $post)
    {
        SEOMeta::setTitle($post->title);

        return view('blog.show', [
            'post' => $post,
        ]);
    }
}
