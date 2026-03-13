<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Admin\AuthController;
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
Route::put('/contact/settings', [ContactController::class, 'updateSettings'])->name('contact.settings.update');

// Login route alias (for backward compatibility)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Admin Login Routes (public)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
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
    Route::get('/contacts/all', [ContactsAdmController::class, 'all'])->name('contacts.all');
    Route::delete('/contacts/{contact}', [ContactsAdmController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/contacts/settings', [ContactsAdmController::class, 'contactSettings'])->name('contacts.settings');
    Route::put('/contacts/settings', [ContactsAdmController::class, 'updateContactSettings'])->name('contacts.settings.update');
    
    // Page Management Routes
    Route::get('/home', [HomeAdmController::class, 'edit'])->name('home.edit');
    Route::put('/home', [HomeAdmController::class, 'update'])->name('home.update');
    Route::post('/home/switch-image', [HomeAdmController::class, 'switchImage'])->name('home.switch-image');
    Route::get('/about', [AboutAdmController::class, 'edit'])->name('about.edit');
    Route::put('/about', [AboutAdmController::class, 'update'])->name('about.update');
    Route::post('/about/switch-image', [AboutAdmController::class, 'switchImage'])->name('about.switch-image');
});
