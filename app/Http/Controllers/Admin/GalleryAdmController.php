<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryAdmController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('galleries'));
    }
    
    public function create()
    {
        return view('admin.gallery.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $imagePath = $request->file('image')->store('gallery', 'public');
        
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => 'storage/' . $imagePath
        ]);
        
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery created successfully!');
    }
    
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }
    
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $data['image_path'] = 'storage/' . $imagePath;
        }
        
        $gallery->update($data);
        
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated successfully!');
    }
    
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery deleted successfully!');
    }
}