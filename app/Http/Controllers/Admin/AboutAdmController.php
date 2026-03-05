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
        try {
            $request->validate([
                'section' => 'required|string',
                'title' => 'nullable|string',
                'content' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'image_2.max' => 'Ukuran gambar 2 terlalu besar. Maksimal 2MB.',
                'image_2.mimes' => 'Format gambar 2 harus jpeg, png, jpg, atau gif.'
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
                
                if (file_exists(public_path('storage/pages/' . $fileName))) {
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada. Silakan coba lagi.'])->withInput();
                }
                
                $file->move(public_path('storage/pages'), $fileName);
                $section->addNewImage('storage/pages/' . $fileName, 1);
            }
            
            if ($request->hasFile('image_2') && in_array($request->section, ['visi', 'tasty_food'])) {
                $file = $request->file('image_2');
                $fileName = time() . '_' . $request->section . '_2.' . $file->getClientOriginalExtension();
                
                if (file_exists(public_path('storage/pages/' . $fileName))) {
                    return redirect()->back()->withErrors(['image_2' => 'File gambar 2 dengan nama yang sama sudah ada. Silakan coba lagi.'])->withInput();
                }
                
                $file->move(public_path('storage/pages'), $fileName);
                $section->addNewImage('storage/pages/' . $fileName, 2);
            }
            
            if (!$request->hasFile('image') && !$request->hasFile('image_2')) {
                $section->save();
            }
            
            return redirect()->route('admin.about.edit')->with('success', 'About section updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
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