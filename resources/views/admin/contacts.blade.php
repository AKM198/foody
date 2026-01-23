@extends('layouts.admin')

@section('title', 'Kelola Kontak - Admin TASTY FOOD')
@section('page-title', 'Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 style="font-family: Arial, sans-serif; color: #000; margin: 0;">Daftar Pesan Kontak</h4>
            <div class="btn-group" role="group">
                <button class="btn btn-admin">
                    <i class="fas fa-envelope-open me-2"></i>Tandai Dibaca
                </button>
                <button class="btn btn-outline-danger">
                    <i class="fas fa-trash me-2"></i>Hapus Terpilih
                </button>
            </div>
        </div>
        
        <div class="admin-table">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th width="50">
                            <input type="checkbox" class="form-check-input">
                        </th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <strong>{{ $contact->name }}</strong>
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->subject, 30) }}</td>
                        <td>
                            <div style="max-width: 250px;">
                                {{ Str::limit($contact->message, 80) }}
                            </div>
                        </td>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="badge bg-warning">Baru</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contactModal{{ $contact->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-reply"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-envelope fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada pesan kontak</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($contacts->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $contacts->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Contact Detail Modals -->
@foreach($contacts as $contact)
<div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #000; color: #fff;">
                <h5 class="modal-title">Detail Pesan Kontak</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Nama:</strong>
                        <p>{{ $contact->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p>{{ $contact->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Subject:</strong>
                        <p>{{ $contact->subject }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Tanggal:</strong>
                        <p>{{ $contact->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <strong>Pesan:</strong>
                        <div class="border p-3 mt-2" style="background: #f8f9fa;">
                            {{ $contact->message }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-admin">Balas Pesan</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection