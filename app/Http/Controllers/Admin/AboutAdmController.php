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
                    'current_img' => $this->getDefaultImage($key)
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
        ]);
        
        $section = AboutSection::where('section_name', $request->section)->first();
        
        if ($request->title) $section->title = $request->title;
        if ($request->content) $section->content = $request->content;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $request->section . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pages'), $fileName);
            $section->addNewImage('storage/pages/' . $fileName);
        } else {
            $section->save();
        }
        
        return redirect()->route('admin.about.edit')->with('success', 'About section updated successfully!');
    }
    
    public function switchImage(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'prev_index' => 'required|integer|min:1|max:4'
        ]);
        
        $section = AboutSection::where('section_name', $request->section)->first();
        $section->switchToPrevious($request->prev_index);
        
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
}