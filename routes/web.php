<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Guest routes: allow guests to view product listings and details
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Admin routes: require authentication and admin access
Route::middleware(['auth', 'verified', 'admin'])->group(function() {
    Route::resource('product', ProductController::class)->except(['index', 'show']);
});

Route::get('/about', function () {
    return view('about.index');
})->name('about');

Route::get('/service', function () {
    return view('service.index');
})->name('service');

Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');
Route::post('/contact', function () {
    return view('contact.index');
})->name('contact.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
