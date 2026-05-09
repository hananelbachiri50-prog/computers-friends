<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page with search
Route::get('/', [ProductController::class, 'index'])->name('home');

// Product routes
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Favorites routes
Route::post('/favorites/{productId}', [ProductController::class, 'toggleFavorite'])->name('favorites.toggle');
Route::get('/favorites', [ProductController::class, 'favorites'])->name('favorites');

// Cart routes
Route::post('/cart/add/{productId}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/cart/remove/{productId}', [ProductController::class, 'removeFromCart'])->name('cart.remove');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
