@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="successAlert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" id="errorAlert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-responsive">
    <table class="table admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($galleries as $index => $item)
            <tr>
                <td>{{ $galleries->firstItem() + $index }}</td>
                <td>
                    @if($item->image_path)
                        @if(Str::startsWith($item->image_path, 'http'))
                            <img src="{{ $item->image_path }}" alt="{{ $item->name }}" style="width: 60px; height: 40px; object-fit: cover;">
                        @else
                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" style="width: 60px; height: 40px; object-fit: cover;">
                        @endif
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ Str::limit($item->name, 30) }}</td>
                <td>{{ Str::limit($item->description, 50) }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                <td class="text-center">
                    <a href="#" class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#galleryModal{{ $item->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-warning btn-sm me-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm me-1">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('admin.gallery.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada galeri</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Gallery Modals -->
@foreach($galleries as $item)
<div class="modal fade" id="galleryModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-body p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.9); border-radius: 50%; padding: 8px;"></button>
                
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="position-relative">
                            @if($item->image_path)
                                @if(Str::startsWith($item->image_path, 'http'))
                                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 320px; border-radius: 12px 0 0 12px;">
                                @else
                                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 320px; border-radius: 12px 0 0 12px;">
                                @endif
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">Gallery</span>
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="min-height: 320px; border-radius: 12px 0 0 12px;">
                                    <div class="text-center">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted mb-0">No Image Available</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 h-100 d-flex flex-column">
                            <div class="mb-3">
                                <small class="text-muted text-uppercase fw-medium d-flex align-items-center" style="font-size: 11px; letter-spacing: 0.5px;">
                                    <i class="fas fa-calendar me-2"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </small>
                            </div>
                            
                            <h4 class="fw-bold mb-3 lh-sm" style="color: #2c3e50;">{{ $item->name }}</h4>
                            
                            <div class="flex-grow-1">
                                <p class="text-muted lh-base mb-0" style="font-size: 14px;">
                                    {{ $item->description ?: 'Koleksi foto makanan sehat dan lezat yang menggugah selera dengan kualitas premium dan penyajian yang menarik.' }}
                                </p>
                            </div>
                            
                            <div class="mt-4">
                                <a href="#" class="text-decoration-none fw-medium d-flex align-items-center" style="color: #3498db; font-size: 14px;">
                                    View Full Gallery
                                    <i class="fas fa-arrow-right ms-2" style="font-size: 12px;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

{{ $galleries->links('pagination::bootstrap-4') }}
@endsection
<style>
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
    min-width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style>