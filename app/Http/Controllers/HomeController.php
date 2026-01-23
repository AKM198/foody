<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use App\Models\Gallery;
use App\Models\PageContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(5)->get();
        $galleries = Gallery::latest()->take(6)->get();
        $pageContents = PageContent::where('page_name', 'home')->get()->keyBy('section_name');
        
        return view('welcome', compact('news', 'galleries', 'pageContents'));
    }
}