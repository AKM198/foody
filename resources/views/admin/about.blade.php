@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.about.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <label for="header_title">Header Title</label>
        <input type="text" class="form-control" id="header_title" name="header_title" 
               value="{{ $contents['header_title']->content_value ?? 'TENTANG KAMI' }}">
    </div>
    
    <div class="form-group mb-3">
        <label for="tasty_food_content">Tasty Food Content</label>
        <textarea class="form-control" id="tasty_food_content" name="tasty_food_content" rows="6">{{ $contents['tasty_food_content']->content_value ?? 'Tasty Food adalah perusahaan yang bergerak di bidang kuliner...' }}</textarea>
    </div>
    
    <div class="form-group mb-3">
        <label for="visi_content">Visi Content</label>
        <textarea class="form-control" id="visi_content" name="visi_content" rows="4">{{ $contents['visi_content']->content_value ?? 'Menjadi perusahaan kuliner terdepan...' }}</textarea>
    </div>
    
    <div class="form-group mb-3">
        <label for="misi_content">Misi Content</label>
        <textarea class="form-control" id="misi_content" name="misi_content" rows="6">{{ $contents['misi_content']->content_value ?? 'Menyediakan makanan berkualitas tinggi...' }}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Update About Page</button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</form>
@endsection