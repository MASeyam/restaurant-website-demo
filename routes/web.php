<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/about', 'about')->name('about');
    Route::get('/reservations', 'reservations')->name('reservations');
    Route::get('/gallery', 'gallery')->name('gallery');
    Route::get('/contact', 'contact')->name('contact');
});

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/items', [CartController::class, 'add'])->name('cart.items.add');
Route::patch('cart/items/{itemKey}', [CartController::class, 'update'])->name('cart.items.update');
Route::delete('cart/items/{itemKey}', [CartController::class, 'remove'])->name('cart.items.remove');
Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('cart/checkout', [OrderController::class, 'storeFromCart'])->name('cart.checkout');
});

require __DIR__.'/settings.php';
