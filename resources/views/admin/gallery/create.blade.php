@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group mb-3">
        <label for="name">Judul</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mb-3">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
    </div>
    
    @include('admin.partials.image-picker', [
        'label' => 'Gambar',
        'category' => 'gallery',
        'inputName' => 'image',
        'inputId' => 'image',
        'hiddenName' => 'selected_image_id',
        'hiddenId' => 'selected_image_id',
        'required' => true
    ])
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection