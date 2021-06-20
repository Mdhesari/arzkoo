<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::prefix('/')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('home');
    Route::get('/{post}', [BlogController::class, 'show'])->name('show');
});

// Route::prefix('exchanges')->name('exchanges.')->group(function () {
//     Route::get('/exchanges', [ExchangeController::class, 'index'])->name('home');
// });
