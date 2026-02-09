<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsAdmController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(5);
        return view('admin.news.index', compact('news'));
    }
    
    public function create()
    {
        return view('admin.news.create');
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255|unique:news,title',
                'content' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'title.unique' => 'Judul berita sudah ada di database.',
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'image.required' => 'Gambar wajib diupload.'
            ]);
            
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                
                if (file_exists(public_path('storage/news/' . $imageName))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar dengan nama yang sama sudah ada.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada.'])->withInput();
                }
                
                $request->file('image')->move(public_path('storage/news'), $imageName);
                
                News::create([
                    'title' => $request->title,
                    'content' => $request->content,
                    'image_path' => 'storage/news/' . $imageName
                ]);
                
                if ($request->ajax()) {
                    return response()->json(['success' => true, 'message' => 'Berita berhasil ditambahkan!']);
                }
                return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
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
    
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }
    
    public function update(Request $request, News $news)
    {
        try {
            $request->validate([
                'title' => 'required|max:255|unique:news,title,' . $news->id,
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ], [
                'title.unique' => 'Judul berita sudah ada di database.',
                'image.max' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.'
            ]);
            
            $data = [
                'title' => $request->title,
                'content' => $request->content
            ];
            
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
                
                if (file_exists(public_path('storage/news/' . $imageName))) {
                    if ($request->ajax()) {
                        return response()->json(['success' => false, 'message' => 'File gambar dengan nama yang sama sudah ada.']);
                    }
                    return redirect()->back()->withErrors(['image' => 'File gambar dengan nama yang sama sudah ada.'])->withInput();
                }
                
                $request->file('image')->move(public_path('storage/news'), $imageName);
                $data['image_path'] = 'storage/news/' . $imageName;
            }
            
            $news->update($data);
            
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Berita berhasil diupdate!']);
            }
            return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diupdate!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }
    
    public function destroy(News $news)
    {
        $news->delete();
        
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Berita berhasil dihapus!']);
        }
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}