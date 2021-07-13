<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Auth\Events\Login;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [LoginController::class, 'show'])->name('login');
        Route::post('login', [LoginController::class, 'store']);
        Route::put('login', [LoginController::class, 'verify']);
    });
});

Route::middleware('auth')->group(function () {
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/{post}', [BlogController::class, 'show'])->name('show');
});

// Route::prefix('exchanges')->name('exchanges.')->group(function () {
//     Route::get('/exchanges', [ExchangeController::class, 'index'])->name('home');
// });
