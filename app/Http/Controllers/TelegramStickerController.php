<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TelegramStickerController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        require_once(base_path('tools/libs/jdf.php'));

        $img = Image::make(public_path('assets/stickers/sticker.png'))->resize(512,512);
        $text = jjdate('j F Y');

        $text = Persian_image($text);

        $img->text($text, $img->getWidth() / 2, $img->getHeight() / 3, function ($font) {
            $font->file(public_path('assets/fonts/Shabnam.ttf'));
            $font->size(80);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('center');
        });

        $text = date('j F Y');

        $img->text($text, $img->getWidth() / 2, $img->getHeight() / 1.9, function ($font) {
            $font->file(public_path('assets/fonts/Shabnam.ttf'));
            $font->size(35);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('center');
        });

        $text = jjdate('l');

        $text = Persian_image($text);

        $text = date('l') . " | " . $text;

        $img->text($text, $img->getWidth() / 2, $img->getHeight() / 1.4, function ($font) {
            $font->file(public_path('assets/fonts/Shabnam.ttf'));
            $font->size(45);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('center');
        });

        $imgPath = 'assets/stickers/today/';

        if(file_exists(public_path($imgPath))) {
            exec('rm -rf ' . public_path($imgPath));
            mkdir($imgPath);
        } else {
            mkdir($imgPath);
        }

        $imgPath .= 'today-' . time() .'.png';

        $img->save(public_path($imgPath));

        return response()->json([
            'url'   =>  url($imgPath),
        ]);
    }
}
