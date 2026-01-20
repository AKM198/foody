<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use App\Models\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(5)->get();
        $galleries = Gallery::latest()->take(6)->get();
        return view('welcome', compact('news', 'galleries'));
    }
}