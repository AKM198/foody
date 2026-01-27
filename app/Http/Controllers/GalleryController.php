<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Product::where('category', 'gallery')->latest()->get();
        return view('gallery.gallery', compact('galleries'));
    }
}