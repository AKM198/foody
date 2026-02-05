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
                    'content' => $this->getDefaultContent($key),
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
        
        if (!$section) {
            return redirect()->route('admin.about.edit')->with('error', 'Section not found!');
        }
        
        // Update title
        if ($request->filled('title')) {
            $section->title = $request->title;
        }
        
        // Update content for all sections except header
        if ($request->filled('content') && $request->section !== 'header') {
            $section->content = $request->content;
        }
        
        $hasFileUpload = false;
        
        // Handle first image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $request->section . '_1.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('storage/pages');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $fileName);
            $section->addNewImage('storage/pages/' . $fileName, 1);
            $hasFileUpload = true;
        }
        
        // Handle second image upload for specific sections
        if ($request->hasFile('image_2') && in_array($request->section, ['visi', 'tasty_food'])) {
            $file = $request->file('image_2');
            $fileName = time() . '_' . $request->section . '_2.' . $file->getClientOriginalExtension();
            
            $uploadPath = public_path('storage/pages');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $fileName);
            $section->addNewImage('storage/pages/' . $fileName, 2);
            $hasFileUpload = true;
        }
        
        // Save changes if no file uploads
        if (!$hasFileUpload) {
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
        
        if (!$section) {
            return response()->json(['success' => false, 'message' => 'Section not found']);
        }
        
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
            'header' => null,
            'tasty_food' => 'assets/images/homemade4.jpg',
            'visi' => 'assets/images/homemade5.jpg',
            'misi' => null
        ];
        return $defaults[$section] ?? null;
    }
    
    private function getDefaultContent($section)
    {
        $defaults = [
            'header' => null,
            'tasty_food' => 'Foody hadir sebagai solusi terpercaya untuk kebutuhan makanan sehat dan bergizi keluarga Indonesia. Dengan komitmen menggunakan bahan-bahan segar berkualitas tinggi, kami menghadirkan berbagai pilihan hidangan lezat yang tidak hanya memanjakan lidah tetapi juga memberikan nutrisi terbaik untuk kesehatan optimal.',
            'visi' => 'Menjadi pelopor revolusi makanan sehat di Indonesia dengan menciptakan generasi yang lebih sadar akan pentingnya nutrisi berkualitas tinggi dan gaya hidup sehat melalui inovasi kuliner yang berkelanjutan.',
            'misi' => 'Menyediakan solusi makanan sehat yang terjangkau dan mudah diakses untuk seluruh masyarakat Indonesia, sambil mendukung petani lokal dan mempromosikan praktik pertanian berkelanjutan untuk masa depan yang lebih baik.'
        ];
        return $defaults[$section] ?? null;
    }
}