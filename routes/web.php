<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardAdmController;
use App\Http\Controllers\Admin\NewsAdmController;
use App\Http\Controllers\Admin\GalleryAdmController;
use App\Http\Controllers\Admin\ContactsAdmController;
use App\Http\Controllers\Admin\HomeAdmController;
use App\Http\Controllers\Admin\AboutAdmController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
Route::resource('news', NewsController::class)->only(['index', 'show']);
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
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
    Route::get('/', [DashboardAdmController::class, 'index'])->name('index');
    Route::get('/dashboard', [DashboardAdmController::class, 'index'])->name('dashboard');
    
    // News CRUD
    Route::get('/news', [NewsAdmController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsAdmController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsAdmController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsAdmController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news}', [NewsAdmController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsAdmController::class, 'destroy'])->name('news.destroy');
    
    // Gallery CRUD
    Route::get('/gallery', [GalleryAdmController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryAdmController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryAdmController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}/edit', [GalleryAdmController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{gallery}', [GalleryAdmController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{gallery}', [GalleryAdmController::class, 'destroy'])->name('gallery.destroy');
    
    // Contacts
    Route::get('/contacts', [ContactsAdmController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{contact}', [ContactsAdmController::class, 'destroy'])->name('contacts.destroy');
    
    // Page Management Routes
    Route::get('/home', [HomeAdmController::class, 'edit'])->name('home.edit');
    Route::put('/home', [HomeAdmController::class, 'update'])->name('home.update');
    Route::get('/about', [AboutAdmController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutAdmController::class, 'update'])->name('about.update');
});
