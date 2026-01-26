<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\PageImage;

class HomeAdmController extends Controller
{
    public function edit()
    {
        $contents = PageContent::where('page_name', 'home')->get()->keyBy('section_name');
        $images = PageImage::where('page_name', 'home')->get()->keyBy('section_name');
        return view('admin.pages.home', compact('contents', 'images'));
    }
    
    public function update(Request $request)
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
        
        // Handle image uploads
        $imageFields = ['menu_card_1', 'menu_card_2', 'menu_card_3', 'menu_card_4'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imagePath = $request->file($field)->store('pages/home', 'public');
                PageImage::updateOrCreate(
                    ['page_name' => 'home', 'section_name' => $field],
                    ['image_path' => 'storage/' . $imagePath, 'alt_text' => $request->input($field . '_alt')]
                );
            }
        }
        
        return redirect()->route('admin.home.edit')->with('success', 'Home page updated successfully!');
    }
}