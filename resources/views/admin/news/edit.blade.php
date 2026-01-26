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
    
    <div class="form-group mb-3">
        <label for="image">Gambar</label>
        @if($news->image_path)
            <div class="mb-2">
                <img src="{{ asset($news->image_path) }}" alt="Current" style="max-width: 200px; height: auto;">
            </div>
        @endif
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
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