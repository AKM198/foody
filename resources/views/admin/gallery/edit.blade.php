@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <label for="title">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mb-3">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
    </div>
    
    <div class="form-group mb-3">
        <label for="image">Gambar</label>
        @if($gallery->image_path)
            <div class="mb-2">
                <img src="{{ asset($gallery->image_path) }}" alt="Current" style="max-width: 200px; height: auto;">
            </div>
        @endif
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection