<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AuthController;
use Modules\Admin\Http\Controllers\HomeController;
use Modules\Admin\Http\Controllers\ActivityLogController;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\AdminSettingController;
use Modules\Admin\Http\Controllers\HelpDeskController;
use Modules\Admin\Http\Controllers\LandingSettingController;
use Modules\Admin\Http\Controllers\RolePermissionController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Main\Http\Controllers\Auth\RegisterController;

Route::name('admin.')->middleware('auth.admin')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::prefix('profile')->group(function () {

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminController::class, 'index'])->name('profile');

        Route::put('/', [AdminController::class, 'update']);
    });

    Route::prefix('/activity-log')->middleware('can:activity-log-management')->name('activity.')->group(function () {

        Route::get('/', [ActivityLogController::class, 'index'])->name('report');
    });

    Route::prefix('role-permissions')->middleware('can:access-management')->name('role-permission.')->group(function () {

        Route::post('/role/create', [RolePermissionController::class, 'store'])->name('create-role');

        Route::get('/{role?}', [RolePermissionController::class, 'index'])->name('index');

        Route::put('/{role}', [RolePermissionController::class, 'update']);

        Route::get('/search', [RolePermissionController::class, 'search'])->name('search');
    });

    Route::prefix('users')->name('users.')->group(function () {

        Route::get('search', [UserController::class, 'search'])->name('search');

        Route::middleware('can:update user')->group(function () {

            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');

            Route::post('/edit/{user}', [UserController::class, 'update']);
        });

        Route::middleware('can:create user')->group(function () {

            Route::get('/add', [UserController::class, 'create'])->name('add');

            Route::post('/add', [UserController::class, 'store']);
        });

        Route::middleware('can:read user')->group(function () {

            Route::get('/', [UserController::class, 'list'])->name('list');

            Route::get('/show/{user}', [UserController::class, 'show'])->name('show');
        });

        Route::middleware('can:delete user')->group(function () {

            Route::get('/delete/{user}', [UserController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/delete/{user}', [UserController::class, 'destroy']);

            Route::delete('/force-delete/{user}', [UserController::class, 'forceDestroy'])->name('force-destroy');

            Route::put('/restore/{user}', [UserController::class, 'restore'])->name('restore');
        });
    });

    Route::prefix('admins')->name('admins.')->group(function () {

        Route::middleware('can:create admin')->group(function () {

            Route::get('/add', [AdminController::class, 'create'])->name('add');

            Route::post('/add', [AdminController::class, 'store']);
        });

        Route::middleware('can:update admin')->group(function () {

            Route::get('/edit/{admin}', [AdminController::class, 'edit'])->name('edit');

            Route::post('/edit/{admin}', [AdminController::class, 'update']);
        });

        Route::middleware('can:delete admin')->group(function () {

            Route::get('/delete/{admin}', [AdminController::class, 'approveDestroy'])->name('destroy');

            Route::delete('/delete/{admin}', [AdminController::class, 'destroy']);

            Route::delete('/force-delete/{admin}', [AdminController::class, 'forceDestroy'])->name('force-destroy');

            Route::put('/restore/{admin}', [AdminController::class, 'restore'])->name('restore');
        });

        Route::middleware('can:read admin')->group(function () {

            Route::get('/', [AdminController::class, 'list'])->name('list');

            Route::get('/show/{admin}', [AdminController::class, 'show'])->name('show');
        });
    });

    Route::prefix('helpdesk')->middleware('can:contact user')->name('helpdesk.')->group(function () {

        Route::get('/', [HelpDeskController::class, 'list'])->name('list');

        Route::get('/show/{helpticket}', [HelpDeskController::class, 'show'])->name('show');

        Route::post('/answer/{helpticket}', [HelpDeskController::class, 'store'])->name('store');
    });

    Route::prefix('setting')->name('setting.')->group(function () {

        Route::get('/', [AdminSettingController::class, 'index'])->name('show');

        Route::post('/save', [AdminSettingController::class, 'update'])->name('update');

        Route::prefix('landing-setting')->name('landing.')->group(function () {

            Route::get('/', [LandingSettingController::class, 'edit'])->name('edit');

            Route::post('/save', [LandingSettingController::class, 'update'])->name('update');
        });
    });
});

Route::name('admin.')->middleware('guest.admin')->group(function () {

    Route::get('login', [AuthController::class, 'loginForm'])->name('login');

    Route::post('login', [AuthController::class, 'login']);

    Route::get('register', [RegisterController::class, 'show'])->name('register');
});
