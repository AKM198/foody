<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $products = Product::where('is_available', true)->latest()->get();
        return view('gallery.gallery', compact('products'));
    }
}