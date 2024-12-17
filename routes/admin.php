<?php

use App\Http\Controllers\Admin\Ajax\ImageUploaderController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainPageBuilderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    })
        ->name('dashboard');


    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    Route::controller(ProductController::class)->group(function () {
        Route::post('/products/{product}/attributes', 'updateAttributes')
            ->name('products.updateAttributes');
    });

    Route::resource('categories', CategoryController::class);
    Route::resource('attributes', AttributeController::class);

    Route::controller(ImageUploaderController::class)->group(function () {
        Route::post('/uploadImage', 'upload')
            ->name('images.upload')
            ->withoutMiddleware(VerifyCsrfToken::class);
    });

    Route::controller(MainPageBuilderController::class)->group(function () {
        Route::get('/builders/main-page', 'index')
            ->name('builders.main-page');
        Route::post('/builders/main-page', 'store')
            ->name('builders.main-page.store');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'indexLogin')
        ->name('login');
    Route::post('/login', 'login')
        ->name('login.post');
    Route::post('/logout', 'logout')
        ->name('logout');
    Route::get('/register', 'indexRegister')
        ->name('register');
    Route::post('/register', 'register')
        ->name('register.post');
});
