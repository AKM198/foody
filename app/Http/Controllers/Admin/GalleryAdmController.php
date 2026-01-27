<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class GalleryAdmController extends Controller
{
    public function index()
    {
        $galleries = Product::where('category', 'gallery')->latest()->paginate(6);
        return view('admin.gallery.index', compact('galleries'));
    }
    
    public function create()
    {
        return view('admin.gallery.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/gallery'), $imageName);
            
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => 0,
                'image_path' => 'storage/gallery/' . $imageName,
                'category' => 'gallery'
            ]);
            
            return redirect()->route('admin.gallery.index')->with('success', 'Gallery created successfully!');
        }
        
        return redirect()->back()->withErrors(['image' => 'The image failed to upload.'])->withInput();
    }
    
    public function edit(Product $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }
    
    public function update(Request $request, Product $gallery)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/gallery'), $imageName);
            $data['image_path'] = 'storage/gallery/' . $imageName;
        }
        
        $gallery->update($data);
        
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated successfully!');
    }
    
    public function destroy(Product $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery deleted successfully!');
    }
}