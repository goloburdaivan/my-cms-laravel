<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::controller(HomeController::class)->group(function () {
   Route::get('/', 'index')
       ->name('home');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{slug}', 'index')
        ->name('products.show');
    Route::get('/categories/{category}', 'category')
        ->name('categories.show');
});

Route::get('/pages/{slug}', [PageController::class, 'index'])
    ->name('pages.show');


Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'addToCart']);
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'index')
            ->name('profile.index');
        Route::put('/profile', 'update')
            ->name('profile.update');
    });

    Route::controller(WishlistController::class)->group(function () {
        Route::post('/wishlist/add/{product}', [WishlistController::class, 'addToWishlist'])
            ->name('wishlist.add');
        Route::delete('/wishlist/remove/{wishlist}', [WishlistController::class, 'removeFromWishlist'])
            ->name('wishlist.remove');
    });
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
