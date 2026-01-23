<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\About;
use App\Models\PageContent;

class AdminController extends Controller
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
    
    public function news()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news', compact('news'));
    }
    
    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.gallery', compact('galleries'));
    }
    
    public function contacts()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }
    
    public function editHome()
    {
        $contents = PageContent::where('page_name', 'home')->get()->keyBy('section_name');
        return view('admin.home', compact('contents'));
    }
    
    public function updateHome(Request $request)
    {
        $sections = ['hero_title', 'hero_description', 'tentang_description'];
        
        foreach ($sections as $section) {
            if ($request->has($section)) {
                PageContent::updateOrCreate(
                    ['page_name' => 'home', 'section_name' => $section],
                    ['content_value' => $request->input($section)]
                );
            }
        }
        
        return redirect()->route('admin.home')->with('success', 'Home page updated successfully!');
    }
    
    public function editAbout()
    {
        $contents = PageContent::where('page_name', 'about')->get()->keyBy('section_name');
        return view('admin.about', compact('contents'));
    }
    
    public function updateAbout(Request $request)
    {
        $sections = ['header_title', 'tasty_food_content', 'visi_content', 'misi_content'];
        
        foreach ($sections as $section) {
            if ($request->has($section)) {
                PageContent::updateOrCreate(
                    ['page_name' => 'about', 'section_name' => $section],
                    ['content_value' => $request->input($section)]
                );
            }
        }
        
        return redirect()->route('admin.about')->with('success', 'About page updated successfully!');
    }
}