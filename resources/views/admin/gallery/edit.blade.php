@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <label for="name">Judul</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $gallery->name) }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mb-3">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
    </div>
    
    @include('admin.partials.image-picker', [
        'label' => 'Gambar',
        'category' => 'gallery',
        'inputName' => 'image',
        'inputId' => 'image',
        'hiddenName' => 'selected_image_id',
        'hiddenId' => 'selected_image_id',
        'currentImage' => $gallery->image_url,
        'required' => false
    ])
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection