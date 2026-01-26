@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="form-group mb-3">
        <label for="title">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="form-group mb-3">
        <label for="description">Deskripsi</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
    </div>
    
    <div class="form-group mb-3">
        <label for="image">Gambar</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection