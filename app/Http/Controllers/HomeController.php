<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\News;
use App\Models\Gallery;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(5)->get();
        $galleries = Gallery::latest()->take(6)->get();
        $sections = HomeSection::whereIn('section_name', ['header', 'tentang', 'menu_card_1', 'menu_card_2', 'menu_card_3', 'menu_card_4'])->get()->keyBy('section_name');
        
        return view('welcome', compact('news', 'galleries', 'sections'));
    }
}