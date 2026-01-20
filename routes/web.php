<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// API Routes
Route::get('/api/search', function(\Illuminate\Http\Request $request) {
    $query = $request->get('q');
    
    if (empty($query)) {
        return response()->json([]);
    }
    
    // Search products by name containing the query
    $products = \App\Models\Product::where('name', 'LIKE', '%' . $query . '%')
        ->limit(10)
        ->get(['id', 'name', 'price', 'image_path']);
    
    return response()->json($products);
});

// Admin Routes (Simple - no authentication for demo)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::resource('news', NewsController::class)->except(['index', 'show']);
});
