@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin TASTY FOOD')
@section('page-title', 'Kelola Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 style="font-family: Arial, sans-serif; color: #000; margin: 0;">Daftar Berita</h4>
            <button class="btn btn-admin">
                <i class="fas fa-plus me-2"></i>Tambah Berita
            </button>
        </div>
        
        <div class="admin-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            <div style="max-width: 300px;">
                                <strong>{{ Str::limit($article->title, 50) }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit(strip_tags($article->content), 80) }}</small>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $article->category ?? 'Umum' }}</span>
                        </td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-success">Aktif</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
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
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada berita yang tersedia</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($news->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>
@endsection