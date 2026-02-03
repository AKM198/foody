<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $sections = AboutSection::whereIn('section_name', ['header', 'tasty_food', 'visi', 'misi'])->get()->keyBy('section_name');
        return view('about-us.index', compact('sections'));
    }
}