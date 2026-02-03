@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')

@section('content')
<style>
.admin-content {
    background-color: #f5f5f5 !important;
}

.gallery-admin-container {
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
}

.gallery-admin-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.gallery-admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.gallery-admin-title {
    font-family: Arial, sans-serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #000;
    margin: 0;
}

.gallery-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
}

.gallery-stat-item {
    background: linear-gradient(135deg, #000 0%, #333 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 10px;
    text-align: center;
    min-width: 120px;
}

.gallery-stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.gallery-stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
}
</style>

<div class="gallery-admin-container">
    <div class="gallery-admin-card">
        <div class="gallery-admin-header">
            <h2 class="gallery-admin-title">Manajemen Galeri</h2>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-admin">
                <i class="fas fa-plus me-2"></i>Tambah Galeri Baru
            </a>
        </div>
        
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="successAlert" style="border-radius: 10px; border: none;">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" id="errorAlert" style="border-radius: 10px; border: none;">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

        <div class="table-responsive" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <table class="table admin-table" style="margin: 0;">
                <thead>
                    <tr>
                        <th style="background: #000; color: #fff; padding: 20px 15px;">No</th>
                        <th style="background: #000; color: #fff; padding: 20px 15px;">Gambar</th>
                        <th style="background: #000; color: #fff; padding: 20px 15px;">Judul</th>
                        <th style="background: #000; color: #fff; padding: 20px 15px;">Deskripsi</th>
                        <th style="background: #000; color: #fff; padding: 20px 15px;">Tanggal</th>
                        <th style="background: #000; color: #fff; padding: 20px 15px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleries as $index => $item)
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td style="padding: 20px 15px; font-weight: 600;">{{ $galleries->firstItem() + $index }}</td>
                        <td style="padding: 20px 15px;">
                            @if($item->image_path)
                                @if(Str::startsWith($item->image_path, 'http'))
                                    <img src="{{ $item->image_path }}" alt="{{ $item->name }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                @else
                                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                @endif
                            @else
                                <div style="width: 80px; height: 60px; background: #f5f5f5; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #999;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 20px 15px; font-weight: 600; color: #000;">{{ Str::limit($item->name, 30) }}</td>
                        <td style="padding: 20px 15px; color: #666;">{{ Str::limit($item->description, 50) }}</td>
                        <td style="padding: 20px 15px; color: #666;">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td style="padding: 20px 15px;">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-admin" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color: #999;">
                            <i class="fas fa-images fa-3x mb-3" style="opacity: 0.3;"></i>
                            <div>Belum ada galeri yang ditambahkan</div>
                            <a href="{{ route('admin.gallery.create') }}" class="btn btn-admin mt-3">
                                <i class="fas fa-plus me-2"></i>Tambah Galeri Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($galleries->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $galleries->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
</div>
@endsection