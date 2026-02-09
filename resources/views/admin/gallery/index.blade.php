@extends('layouts.admin')

@section('title', 'Kelola Galeri')

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
                <th style="width: 35%;">Deskripsi</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 18%; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galleries as $index => $item)
            <tr data-gallery-id="{{ $item->id }}">
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
                <td class="gallery-title">{{ Str::limit($item->name, 30) }}</td>
                <td class="gallery-desc" style="display:none;">{{ $item->description }}</td>
                <td>{{ Str::limit($item->description, 50) }}</td>
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
                <td colspan="6" class="text-center" style="padding: 40px;">Tidak ada galeri</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $galleries->links('pagination::bootstrap-4') }}

<script src="{{ asset('assets/admin/js/crud-modal.js') }}"></script>
@endsection