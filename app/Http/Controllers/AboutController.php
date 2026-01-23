<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\PageContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $pageContents = PageContent::where('page_name', 'about')->get()->keyBy('section_name');
        return view('about-us.index', compact('pageContents'));
    }
}