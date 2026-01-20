<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class GalleryController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('gallery.gallery', compact('products'));
    }
}