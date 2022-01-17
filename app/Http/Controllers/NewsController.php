<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $news = News::query();

        if ($request->has('favourite')) {
            $news = $news->favourite();
        }

        return api()->success(null, [
            'items' => $news->paginate(),
        ]);
    }
}
