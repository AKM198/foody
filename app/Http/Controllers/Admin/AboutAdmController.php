<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutSection;

class AboutAdmController extends Controller
{
    public function edit()
    {
        $sections = [
            'header' => 'Header',
            'tasty_food' => 'Tasty Food',
            'visi' => 'Visi',
            'misi' => 'Misi'
        ];
        
        $aboutSections = [];
        foreach ($sections as $key => $name) {
            $aboutSections[$key] = AboutSection::firstOrCreate(
                ['section_name' => $key],
                [
                    'title' => $name,
                    'content' => 'Content for ' . $name,
                    'current_img' => $this->getDefaultImage($key),
                    'current_img_2' => $this->getDefaultImage2($key)
                ]
            );
        }
        
        return view('admin.pages.about', compact('aboutSections'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $section = AboutSection::where('section_name', $request->section)->first();
        
        if ($request->title) $section->title = $request->title;
        
        // Only update content for sections other than header and misi
        if ($request->content && !in_array($request->section, ['header', 'misi'])) {
            $section->content = $request->content;
        }
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $request->section . '_1.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pages'), $fileName);
            $section->addNewImage('storage/pages/' . $fileName, 1);
        }
        
        if ($request->hasFile('image_2') && in_array($request->section, ['visi', 'tasty_food'])) {
            $file = $request->file('image_2');
            $fileName = time() . '_' . $request->section . '_2.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pages'), $fileName);
            $section->addNewImage('storage/pages/' . $fileName, 2);
        }
        
        if (!$request->hasFile('image') && !$request->hasFile('image_2')) {
            $section->save();
        }
        
        return redirect()->route('admin.about.edit')->with('success', 'About section updated successfully!');
    }
    
    public function switchImage(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'prev_index' => 'required|integer|min:1|max:4',
            'image_type' => 'required|integer|in:1,2'
        ]);
        
        $section = AboutSection::where('section_name', $request->section)->first();
        $section->switchToPrevious($request->prev_index, $request->image_type);
        
        return response()->json(['success' => true]);
    }
    
    private function getDefaultImage($section)
    {
        $defaults = [
            'header' => 'assets/images/banner2.png',
            'tasty_food' => 'assets/images/homemade3.jpg',
            'visi' => 'assets/images/homemade6.jpg',
            'misi' => 'assets/images/cooking2.jpg'
        ];
        return $defaults[$section] ?? 'assets/images/banner2.png';
    }
    
    private function getDefaultImage2($section)
    {
        $defaults = [
            'header' => 'assets/images/banner2.png',
            'tasty_food' => 'assets/images/homemade4.jpg',
            'visi' => 'assets/images/homemade5.jpg',
            'misi' => 'assets/images/cooking3.jpg'
        ];
        return $defaults[$section] ?? 'assets/images/banner2.png';
    }
}