<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use SEOMeta;
use TCG\Voyager\Models\Page;

class FallbackController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $slug = trim(urldecode($request->getPathInfo()), '/');
        $page = Page::active()->whereSlug($slug)->latest()->firstOrFail();

        SEOMeta::setTitle($page->title);
        SEOMeta::setDescription($page->excerpt);

        SEOTools::opengraph()->setUrl($request->getUri());

        return view('page.index', compact('page'));
    }
}
