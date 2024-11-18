<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    })
        ->name('dashboard');

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
        Route::post('/products/{product}/attributes', 'updateAttributes')
            ->name('products.updateAttributes');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')
            ->name('categories.index');
        Route::get('/categories/create', 'create')
            ->name('categories.create');
        Route::post('/categories', 'store')
            ->name('categories.store');
        Route::get('/categories/{category}', 'show')
            ->name('categories.show');
        Route::get('/categories/{category}/edit', 'edit')
            ->name('categories.edit');
        Route::put('/categories/{category}', 'update')
            ->name('categories.update');
        Route::delete('/categories/{category}', 'destroy')
            ->name('categories.destroy');
    });

    Route::controller(AttributeController::class)->group(function () {
        Route::get('/attributes', 'index')
            ->name('attributes.index');
        Route::get('/attributes/create', 'create')
            ->name('attributes.create');
        Route::post('/attributes', 'store')
            ->name('attributes.store');
        Route::get('/attributes/{attribute}', 'show')
            ->name('attributes.show');
        Route::get('/attributes/{attribute}/edit', 'edit')
            ->name('attributes.edit');
        Route::put('/attributes/{attribute}', 'update')
            ->name('attributes.update');
        Route::delete('/attributes/{attribute}', 'destroy')
            ->name('attributes.destroy');
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
