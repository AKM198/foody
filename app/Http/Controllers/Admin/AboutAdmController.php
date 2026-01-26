<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\PageImage;

class AboutAdmController extends Controller
{
    public function edit()
    {
        $contents = PageContent::where('page_name', 'about')->get()->keyBy('section_name');
        $images = PageImage::where('page_name', 'about')->get()->keyBy('section_name');
        return view('admin.pages.about', compact('contents', 'images'));
    }
    
    public function update(Request $request)
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
        
        // Handle image uploads
        $imageFields = ['header_image', 'tasty_food_image_1', 'tasty_food_image_2', 'visi_image_1', 'visi_image_2', 'misi_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imagePath = $request->file($field)->store('pages/about', 'public');
                PageImage::updateOrCreate(
                    ['page_name' => 'about', 'section_name' => $field],
                    ['image_path' => 'storage/' . $imagePath, 'alt_text' => $request->input($field . '_alt')]
                );
            }
        }
        
        return redirect()->route('admin.about.edit')->with('success', 'About page updated successfully!');
    }
}