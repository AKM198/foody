<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\PageImage;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'header_title' => 'nullable|string',
            'tasty_food_content' => 'nullable|string',
            'visi_content' => 'nullable|string', 
            'misi_content' => 'nullable|string',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tasty_food_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tasty_food_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'misi_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $sections = ['header_title', 'tasty_food_content', 'visi_content', 'misi_content'];
        
        foreach ($sections as $section) {
            if ($request->has($section)) {
                PageContent::updateOrCreate(
                    ['page_name' => 'about', 'section_name' => $section, 'content_type' => 'text'],
                    ['content_value' => $request->input($section)]
                );
            }
        }
        
        // Handle image uploads
        $imageFields = ['header_image', 'tasty_food_image_1', 'tasty_food_image_2', 'visi_image_1', 'visi_image_2', 'misi_image'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                
                // Store in public/storage/pages directory
                $file->move(public_path('storage/pages'), $fileName);
                
                PageImage::updateOrCreate(
                    ['page_name' => 'about', 'section_name' => $field],
                    [
                        'image_path' => 'storage/pages/' . $fileName,
                        'alt_text' => $request->input($field . '_alt', $field)
                    ]
                );
            }
        }
        
        return redirect()->route('admin.about.edit')->with('success', 'About page updated successfully!');
    }
}