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
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/news'), $imageName);
            
            News::create([
                'title' => $request->title,
                'content' => $request->content,
                'image_path' => 'storage/news/' . $imageName
            ]);
            
            return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
        }
        
        return redirect()->back()->withErrors(['image' => 'The image failed to upload.'])->withInput();
    }
    
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }
    
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = [
            'title' => $request->title,
            'content' => $request->content
        ];
        
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/news'), $imageName);
            $data['image_path'] = 'storage/news/' . $imageName;
        }
        
        $news->update($data);
        
        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }
    
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}