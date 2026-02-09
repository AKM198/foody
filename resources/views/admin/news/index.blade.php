@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin TASTY FOOD')

@push('styles')
<link href="{{ asset('assets/admin/css/crud-modal.css') }}" rel="stylesheet">
@endpush

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
    <button id="crudTambahBtn" class="crud-btn-tambah">
        <i class="fas fa-plus"></i> Tambah Data
    </button>
</div>

<div class="table-responsive">
    <table class="table admin-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 10%;">Gambar</th>
                <th style="width: 20%;">Judul</th>
                <th style="width: 35%;">Konten</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 18%; text-align: center;">
                    Aksi
            
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($news as $index => $item)
            <tr data-gallery-id="{{ $item->id }}">
                <td>{{ $news->firstItem() + $index }}</td>
                <td>
                    @if($item->image_path)
                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" style="width: 60px; height: 40px; object-fit: cover;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td class="gallery-title">{{ Str::limit($item->title, 30) }}</td>
                <td class="gallery-desc" style="display:none;">{{ strip_tags($item->content) }}</td>
                <td>{{ Str::limit(strip_tags($item->content), 50) }}</td>
                <td class="gallery-date">{{ $item->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="crud-action-buttons">
                        <button class="crud-btn-action crud-btn-view" data-id="{{ $item->id }}" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="crud-btn-action crud-btn-edit" data-id="{{ $item->id }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="crud-btn-action crud-btn-delete" data-id="{{ $item->id }}" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 40px;">Tidak ada berita</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $news->links('pagination::bootstrap-4') }}

<script src="{{ asset('assets/admin/js/crud-modal.js') }}"></script>
@endsection