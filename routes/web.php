<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ReviewController;

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Routes for logged-in users
Route::middleware('auth')->group(function () {

    Route::get('/home', [PageController::class, 'home'])->name('home');

    // Food Experiences
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Reviews
    Route::get('/reviews', [ReviewController::class, 'index'])
        ->name('reviews.index');

    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

    // Documentation
    Route::get('/docs', [DocumentationController::class, 'index'])->name('docs.index');

    // Contact
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::post('/contact', [ContactController::class, 'store'])
        ->name('contact.store');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin only routes
Route::middleware(['auth', 'admin'])->group(function () {

    // Food Experiences CRUD
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Vendor CRUD
    Route::resource('vendors', VendorController::class)->except(['show']);
});