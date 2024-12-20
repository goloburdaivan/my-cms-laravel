<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::controller(HomeController::class)->group(function () {
   Route::get('/', 'index')
       ->name('home');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{slug}', 'index')
        ->name('products.show');
});


Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'addToCart']);
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::controller(AuthController::class)->group(function () {
   Route::get('/login', 'indexLogin')
       ->name('login');
   Route::post('/login', 'login')
       ->name('login.post');
   Route::get('/logout', 'logout')
       ->name('logout');
   Route::get('/register', 'indexRegister')
       ->name('register');
   Route::post('/register', 'register')
       ->name('register.post');
});
