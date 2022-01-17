<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $news = News::query()->exceptAlreadySharedToTelegram()->orderBy('likes', 'DESC');

        if ($request->has('favourite')) {
            $news = $news->favourite();
        }

        return api()->success(null, [
            'items' => $news->paginate(),
        ]);
    }

    /**
     * @param $post_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function shareToTelegram($post_id): \Illuminate\Http\JsonResponse
    {
        $news = News::whereJsonContains('meta->post_id', $post_id)->firstOrFail();

        $news->shareToTelegram();

        return api()->success();
    }
}
