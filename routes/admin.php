<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', function () {
        return "Test";
    })
        ->name('home');
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

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')
        ->name('products.index');
    Route::get('/products/create', 'create')
        ->name('products.create');
    Route::post('/products', 'store')
        ->name('products.store');
    Route::get('/products/{product}', 'show')
        ->name('products.show');
    Route::get('/products/{product}/edit', 'edit')
        ->name('products.edit');
    Route::put('/products/{product}', 'update')
        ->name('products.update');
    Route::delete('/products/{product}', 'destroy')
        ->name('products.destroy');
});
