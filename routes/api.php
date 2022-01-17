<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('currencies', [CurrencyController::class, 'getCurrencies'])->name('currencies');

Route::middleware('limitIP')->get('telegram/sticker', [\App\Http\Controllers\TelegramStickerController::class, 'store'])->name('telegram.sticker');

Route::get('coins/topSearch', [\App\Http\Controllers\Api\CoinController::class, 'getHotCoins']);

Route::post('news/telegram/{post_id}', [NewsController::class, 'shareToTelegram']);

Route::get('news', [NewsController::class, 'index']);

