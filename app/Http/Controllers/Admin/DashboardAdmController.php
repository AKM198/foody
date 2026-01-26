<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\About;

class DashboardAdmController extends Controller
{
    public function index()
    {
        $stats = [
            'news_count' => News::count(),
            'gallery_count' => Gallery::count(),
            'contact_count' => Contact::count(),
            'about_count' => About::count(),
        ];
        
        return view('admin.index', compact('stats'));
    }
}