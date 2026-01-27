<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(6);
        return view('news.index', compact('news'));
    }
    
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
    
    public function create()
    {
        return view('news.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255'
        ]);
        
        News::create($request->all());
        
        return redirect()->route('admin.news.index')->with('success', 'News created successfully!');
    }
    
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }
    
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255'
        ]);
        
        $news->update($request->all());
        
        return redirect()->route('admin.news.index')->with('success', 'News updated successfully!');
    }
    
    public function destroy(News $news)
    {
        $news->delete();
        
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully!');
    }
}