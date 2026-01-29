<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\PageImage;
use Illuminate\Support\Facades\Storage;

class HomeAdmController extends Controller
{
    public function edit()
    {
        $contents = PageContent::where('page_name', 'home')->get()->keyBy('section_name');
        $images = PageImage::where('page_name', 'home')->get()->keyBy('section_name');
        
        // Initialize default images if not exist
        $this->initializeDefaultImages();
        
        return view('admin.pages.home', compact('contents', 'images'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'hero_title' => 'nullable|string',
            'hero_description' => 'nullable|string',
            'tentang_description' => 'nullable|string',
            'menu_card_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_card_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_card_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'menu_card_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $sections = ['hero_title', 'hero_description', 'tentang_description'];
        
        foreach ($sections as $section) {
            if ($request->has($section)) {
                PageContent::updateOrCreate(
                    ['page_name' => 'home', 'section_name' => $section, 'content_type' => 'text'],
                    ['content_value' => $request->input($section)]
                );
            }
        }
        
        // Handle image uploads
        $imageFields = ['menu_card_1', 'menu_card_2', 'menu_card_3', 'menu_card_4'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                
                // Store in public/storage/pages directory
                $file->move(public_path('storage/pages'), $fileName);
                
                PageImage::updateOrCreate(
                    ['page_name' => 'home', 'section_name' => $field],
                    [
                        'image_path' => 'storage/pages/' . $fileName,
                        'alt_text' => $request->input($field . '_alt', $field)
                    ]
                );
            }
        }
        
        return redirect()->route('admin.home.edit')->with('success', 'Home page updated successfully!');
    }
    
    private function initializeDefaultImages()
    {
        $defaultImages = [
            'menu_card_1' => 'assets/images/healthy1.png',
            'menu_card_2' => 'assets/images/healthy2.png', 
            'menu_card_3' => 'assets/images/healthy3.png',
            'menu_card_4' => 'assets/images/street3.png'
        ];
        
        foreach ($defaultImages as $section => $imagePath) {
            PageImage::firstOrCreate(
                ['page_name' => 'home', 'section_name' => $section],
                [
                    'image_path' => $imagePath,
                    'alt_text' => ucfirst(str_replace('_', ' ', $section))
                ]
            );
        }
    }
}