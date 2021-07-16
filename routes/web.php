<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\HomeController;
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

Route::resource('exchanges', ExchangeController::class);

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [LoginController::class, 'show'])->name('login');
        Route::post('login', [LoginController::class, 'store']);
        Route::put('login', [LoginController::class, 'verify']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->name('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('.home');
        Route::get('delete-account', [DashboardController::class, 'deleteAccountView'])->name('.delete-account');
        Route::delete('delete-account', [DashboardController::class, 'deleteAccount']);
        Route::get('confirm-mobile', [DashboardController::class, 'updateMobileConfirmView'])->name('.confirm-mobile');
        Route::post('confirm-mobile', [DashboardController::class, 'updateMobileConfirm']);
        Route::put('update-picture', [DashboardController::class, 'updatePicture'])->name('.update-picture');
        Route::put('update-name', [DashboardController::class, 'updateName'])->name('.update-name');
        Route::put('update-mobile', [DashboardController::class, 'updateMobile'])->name('.update-mobile');
        Route::put('update-password', [DashboardController::class, 'updatePassword'])->name('.update-password');
    });
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/{post}', [BlogController::class, 'show'])->name('show');
});

// Route::prefix('exchanges')->name('exchanges.')->group(function () {
//     Route::get('/exchanges', [ExchangeController::class, 'index'])->name('home');
// });
