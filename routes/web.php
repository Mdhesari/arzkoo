<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\FallbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\LoginController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Gd\Commands\RotateCommand;

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

Route::get('/live-prices', [CryptoController::class, 'livePrices'])->name('live-price');

Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');

Route::prefix('exchanges')->group(function () {
    Route::get('/', [ExchangeController::class, 'index'])->name('exchanges.home');
    Route::get('/buy-{crypto?}', [ExchangeController::class, 'buyList'])->name('exchanges.buy-list');
    Route::get('/sell-{crypto?}', [ExchangeController::class, 'sellList'])->name('exchanges.sell-list');
    Route::get('/show/{exchange}', [ExchangeController::class, 'show'])->name('exchanges.show');
});

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [LoginController::class, 'show'])->name('login');
        Route::post('login', [LoginController::class, 'store']);
        Route::put('login', [LoginController::class, 'verify']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.home');
        Route::get('delete-account', [DashboardController::class, 'deleteAccountView']);
        Route::delete('delete-account', [DashboardController::class, 'deleteAccount'])->name('dashboard.delete-account');
        Route::get('confirm-mobile', [DashboardController::class, 'updateMobileConfirmView'])->name('dashboard.confirm-mobile');
        Route::post('confirm-mobile', [DashboardController::class, 'updateMobileConfirm'])->name('dashboard.confirm-mobile-form');
        Route::put('update-picture', [DashboardController::class, 'updatePicture'])->name('.update-picture');
        Route::put('update-name', [DashboardController::class, 'updateName'])->name('.update-name');
        Route::put('update-mobile', [DashboardController::class, 'updateMobile'])->name('.update-mobile');
        Route::put('update-password', [DashboardController::class, 'updatePassword'])->name('.update-password');
    });
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('exchanges/ratings/{exchange}', [RatingController::class, 'store'])->name('exchanges.rating');
});

Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/{post}', [BlogController::class, 'show'])->name('show');
});

Route::fallback(FallbackController::class);
