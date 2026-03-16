@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <label for="title">Judul Berita</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $news->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    @include('admin.partials.image-picker', [
        'label' => 'Gambar',
        'category' => 'news',
        'inputName' => 'image',
        'inputId' => 'image',
        'hiddenName' => 'selected_image_id',
        'hiddenId' => 'selected_image_id',
        'currentImage' => $news->image_url,
        'required' => false
    ])
    
    <div class="form-group mb-3">
        <label for="content">Konten</label>
        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $news->content) }}</textarea>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection