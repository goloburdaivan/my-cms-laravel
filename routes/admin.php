<?php

use App\Http\Controllers\Admin\Auth\AuthController;
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
