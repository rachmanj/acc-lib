<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\GsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('templates.dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('users/data', [UserController::class, 'data'])->name('users.data');
    Route::put('users/activate/{id}', [UserController::class, 'activate'])->name('users.activate');
    Route::put('users/deactivate/{id}', [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::put('users/roles-update/{id}', [UserController::class, 'roles_user_update'])->name('users.roles_user_update');
    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::get('categories/data', [CategoryController::class, 'data'])->name('categories.index.data');
    Route::resource('categories', CategoryController::class);

    Route::prefix('gs')->name('gs.')->group(function () {
        Route::get('/data', [GsController::class, 'data'])->name('index.data');
        Route::get('/{category_id}/data', [GsController::class, 'gs_detail_data'])->name('detail.data');
        Route::post('/{category_id}/upload', [GsController::class, 'upload'])->name('upload');
        Route::put('/{categoryDetail_id}/update', [GsController::class, 'update'])->name('update');
        Route::get('/', [GsController::class, 'index'])->name('index');
        Route::post('/', [GsController::class, 'store'])->name('store');
        Route::get('/create', [GsController::class, 'create'])->name('create');
        Route::get('/{category_id}', [GsController::class, 'show'])->name('show');
        Route::delete('/{id}', [GsController::class, 'destroy'])->name('detail.destroy');
        Route::get('/{id}/preview', [GsController::class, 'preview'])->name('detail.preview');
    });

    Route::prefix('general')->name('general.')->group(function () {
        Route::get('/data', [GeneralController::class, 'data'])->name('index.data');
        Route::get('/{category_id}/data', [GeneralController::class, 'general_detail_data'])->name('detail.data');
        Route::post('/{category_id}/upload', [GeneralController::class, 'upload'])->name('upload');
        Route::put('/{categoryDetail_id}/update', [GeneralController::class, 'update'])->name('update');
        Route::get('/', [GeneralController::class, 'index'])->name('index');
        Route::post('/', [GeneralController::class, 'store'])->name('store');
        Route::get('/create', [GeneralController::class, 'create'])->name('create');
        Route::get('/{category_id}', [GeneralController::class, 'show'])->name('show');
        Route::delete('/{id}', [GeneralController::class, 'destroy'])->name('detail.destroy');
        Route::get('/{id}/preview', [GeneralController::class, 'preview'])->name('detail.preview');
    });
});
