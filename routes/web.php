<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('orders', OrderController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/items/{item}/images', [ImageController::class, 'store'])->name('item.images.store');
    Route::delete('/items/{item}/images/{image}', [ImageController::class, 'destroy'])->name('item.images.destroy');

    Route::middleware('admin')->group(function () {
        Route::resource('admin', AdminController::class);
    });
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Include authentication routes
require __DIR__.'/auth.php';

// Catch-all route to redirect to login
Route::any('{any}', function () {
    return redirect()->route('login');
})->where('any', '.*');
