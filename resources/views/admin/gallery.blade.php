@extends('layouts.admin')

@section('title', 'Kelola Galeri - Admin TASTY FOOD')
@section('page-title', 'Kelola Galeri')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 style="font-family: Arial, sans-serif; color: #000; margin: 0;">Daftar Galeri</h4>
            <button class="btn btn-admin">
                <i class="fas fa-plus me-2"></i>Tambah Foto
            </button>
        </div>
        
        <div class="row">
            @forelse($galleries as $gallery)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card admin-gallery-card">
                    <img src="{{ asset($gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ Str::limit($gallery->title, 30) }}</h6>
                        <p class="card-text">
                            {{ Str::limit($gallery->description, 60) }}
                        </p>
                        <div class="btn-group w-100" role="group">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <p class="text-muted">Belum ada foto dalam galeri</p>
            </div>
            @endforelse
        </div>
        
        @if($galleries->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $galleries->links() }}
        </div>
        @endif
    </div>
</div>
@endsection