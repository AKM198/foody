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
                'image' => 'required|image|max:2048'
            ], [
                'name.required' => 'Nama galeri wajib diisi.',
                'name.max' => 'Nama galeri maksimal 255 karakter.',
                'name.unique' => 'Nama galeri sudah ada di database.',
                'image.required' => 'Gambar wajib diupload.',
                'image.image' => 'File harus berupa gambar.',
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.'
            ]);
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                
                if (!$file->isValid()) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar tidak valid atau corrupt.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar tidak valid atau corrupt.'])->withInput();
                }
                
                $imageName = time() . '_' . $file->getClientOriginalName();
                
                if (file_exists(public_path('storage/gallery/' . $imageName))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar dengan nama yang sama sudah ada. Silakan rename file atau coba lagi.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada. Silakan rename file atau coba lagi.'])->withInput();
                }
                
                if (!is_dir(public_path('storage/gallery'))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Folder storage/gallery tidak ditemukan. Hubungi administrator.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'Folder storage/gallery tidak ditemukan. Hubungi administrator.'])->withInput();
                }
                
                $moved = $file->move(public_path('storage/gallery'), $imageName);
                
                if (!$moved) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Gagal menyimpan gambar. Periksa permission folder.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'Gagal menyimpan gambar. Periksa permission folder.'])->withInput();
                }
                
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
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Validasi gagal: ' . implode(' ', $e->validator->errors()->all())]);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Tambah data gagal: ' . $e->getMessage()]);
            }
            return redirect()->back()->withErrors(['error' => 'Tambah data gagal: ' . $e->getMessage()])->withInput();
        }
        
        if ($request->ajax()) {
            return response()->json(['success' => false, 'message' => 'Gagal mengupload gambar. File tidak ditemukan.']);
        }
        return redirect()->back()->withErrors(['image' => 'Gagal mengupload gambar. File tidak ditemukan.'])->withInput();
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
                'image' => 'nullable|image|max:2048'
            ], [
                'name.required' => 'Nama galeri wajib diisi.',
                'name.max' => 'Nama galeri maksimal 255 karakter.',
                'name.unique' => 'Nama galeri sudah ada di database.',
                'image.image' => 'File harus berupa gambar.',
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.'
            ]);
            
            $data = [
                'name' => $request->name,
                'description' => $request->description
            ];
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                
                if (!$file->isValid()) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar tidak valid atau corrupt.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar tidak valid atau corrupt.'])->withInput();
                }
                
                $imageName = time() . '_' . $file->getClientOriginalName();
                
                if (file_exists(public_path('storage/gallery/' . $imageName))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar dengan nama yang sama sudah ada. Silakan rename file atau coba lagi.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada. Silakan rename file atau coba lagi.'])->withInput();
                }
                
                if (!is_dir(public_path('storage/gallery'))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Folder storage/gallery tidak ditemukan. Hubungi administrator.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'Folder storage/gallery tidak ditemukan. Hubungi administrator.'])->withInput();
                }
                
                $moved = $file->move(public_path('storage/gallery'), $imageName);
                
                if (!$moved) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'Gagal menyimpan gambar. Periksa permission folder.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'Gagal menyimpan gambar. Periksa permission folder.'])->withInput();
                }
                
                $data['image_path'] = 'storage/gallery/' . $imageName;
            }
            
            $gallery->update($data);
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Galeri berhasil diupdate!']);
            }
            return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil diupdate!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Validasi gagal: ' . implode(' ', $e->validator->errors()->all())]);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Update gagal: ' . $e->getMessage()]);
            }
            return redirect()->back()->withErrors(['error' => 'Update gagal: ' . $e->getMessage()])->withInput();
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