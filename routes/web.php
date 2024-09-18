<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/dashboard', '/admin/product')->name('dashboard');
});

// Guest Routes: Accessible to all users
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Admin Product Routes: Requires authentication and admin access
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/product', [ProductController::class, 'adminIndex'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/{id}', [ProductController::class, 'adminShow'])->name('product.show');
});

// Admin Category Routes: Requires authentication and admin access
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/category', [CategoryController::class, 'adminIndex'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{id}', [CategoryController::class, 'adminShow'])->name('category.show');
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




// Cart routes
Route::resource('carts', CartController::class);

// CartItem routes
Route::resource('cart_items', CartItemController::class);

// Order routes
Route::resource('orders', OrderController::class);

// OrderItem routes
Route::resource('order_items', OrderItemController::class);

//Route::get('/dashboard', [DashboardController::class, 'index'])
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
