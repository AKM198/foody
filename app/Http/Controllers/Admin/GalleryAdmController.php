<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class GalleryAdmController extends Controller
{
    public function index()
    {
        $galleries = Product::where('category', 'gallery')->latest()->paginate(5);
        return view('admin.gallery.index', compact('galleries'));
    }
    
    public function create()
    {
        return view('admin.gallery.create');
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255|unique:products,name',
                'description' => 'nullable',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'name.unique' => 'Nama galeri sudah ada di database.',
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'image.required' => 'Gambar wajib diupload.'
            ]);
            
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                
                // Check if file already exists
                if (file_exists(public_path('storage/gallery/' . $imageName))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar dengan nama yang sama sudah ada.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada.'])->withInput();
                }
                
                $request->file('image')->move(public_path('storage/gallery'), $imageName);
                
                Product::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => 0,
                    'image_path' => 'storage/gallery/' . $imageName,
                    'category' => 'gallery'
                ]);
                
                if ($request->ajax()) {
                    return response()->json(['success' => true, 'message' => 'Galeri berhasil ditambahkan!']);
                }
                return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil ditambahkan!');
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
        
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Gagal mengupload gambar.']);
        }
        return redirect()->back()->withErrors(['image' => 'Gagal mengupload gambar.'])->withInput();
    }
    
    public function edit(Product $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }
    
    public function update(Request $request, Product $gallery)
    {
        try {
            $request->validate([
                'name' => 'required|max:255|unique:products,name,' . $gallery->id,
                'description' => 'nullable',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'name.unique' => 'Nama galeri sudah ada di database.',
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.'
            ]);
            
            $data = [
                'name' => $request->name,
                'description' => $request->description
            ];
            
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                
                // Check if file already exists
                if (file_exists(public_path('storage/gallery/' . $imageName))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar dengan nama yang sama sudah ada.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada.'])->withInput();
                }
                
                $request->file('image')->move(public_path('storage/gallery'), $imageName);
                $data['image_path'] = 'storage/gallery/' . $imageName;
            }
            
            $gallery->update($data);
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Galeri berhasil diupdate!']);
            }
            return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil diupdate!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }
    
    public function destroy(Product $gallery)
    {
        $gallery->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Galeri berhasil dihapus!']);
        }
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery deleted successfully!');
    }
}