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

<div class="mb-3">
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Galeri
    </a>
</div>

<div class="table-responsive">
    <table class="table admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
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
                <td>
                    <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-admin me-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
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

{{ $galleries->links('pagination::bootstrap-4') }}
@endsection