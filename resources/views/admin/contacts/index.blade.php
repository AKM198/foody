@extends('layouts.admin')

@section('title', 'Kelola Kontak')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" id="successAlert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="mb-3">
    <h4>Dashbord</h4>
</div>

<div class="table-responsive">
    <table class="table admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Pesan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ Str::limit($contact->subject, 30) }}</td>
                <td>{{ Str::limit($contact->message, 50) }}</td>
                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <button class="btn btn-sm btn-dark me-1" data-bs-toggle="modal" data-bs-target="#viewModal{{ $contact->id }}" style="background: #000; border: none; padding: 8px 16px; border-radius: 5px; font-weight: 500;">
                        <i class="fas fa-eye me-1"></i>View
                    </button>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" style="padding: 8px 12px; border-radius: 5px;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada pesan kontak</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $contacts->links() }}

<!-- Contact Info Management Form -->
<div class="card mt-5">
    <div class="card-header">
        <h5>Kelola Informasi Kontak</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contacts.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea class="form-control" name="address" rows="3">{{ $contactInfo['address'] ?? 'Jl. Babakan Jeruk II No.9, Pasteur\nKec. Sukajadi, Kota Bandung\nJawa Barat 40161' }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label>Telepon</label>
                        <input type="text" class="form-control" name="phone" value="{{ $contactInfo['phone'] ?? '+62 822-1234-5678' }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $contactInfo['email'] ?? 'info@foody.com' }}">
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label>Google Maps URL</label>
                <input type="url" class="form-control" name="map_url" value="{{ $mapUrl->content_value ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<!-- View Modals -->
@foreach($contacts as $contact)
<div class="modal fade" id="viewModal{{ $contact->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 15px; overflow: hidden;">
            <div class="modal-header" style="background: #000; color: #fff; border: none; padding: 25px 30px;">
                <h5 class="modal-title" style="color: #fff; font-weight: 600; font-size: 1.2rem; margin: 0;">Detail Kontak</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" style="font-size: 1.2rem;"></button>
            </div>
            <div class="modal-body" style="padding: 30px; background: #fff;">
                <div class="contact-detail-grid">
                    <div class="detail-item">
                        <div class="detail-label">Nama</div>
                        <div class="detail-value">{{ $contact->name }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Email</div>
                        <div class="detail-value">{{ $contact->email }}</div>
                    </div>
                    
                    <div class="detail-item full-width">
                        <div class="detail-label">Subject</div>
                        <div class="detail-value">{{ $contact->subject }}</div>
                    </div>
                    
                    <div class="detail-item full-width">
                        <div class="detail-label">Pesan</div>
                        <div class="detail-message">{{ $contact->message }}</div>
                    </div>
                    
                    <div class="detail-item full-width">
                        <div class="detail-label">Tanggal</div>
                        <div class="detail-date">{{ $contact->created_at->format('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #f8f9fa; border: none; padding: 20px 30px; justify-content: center;">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.info-item {
    margin-bottom: 1rem;
}

.message-content {
    line-height: 1.6;
    word-wrap: break-word;
}

.modal-header {
    border-bottom: none;
}

.modal-footer.bg-light {
    border-top: 1px solid #dee2e6;
}

.btn:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.contact-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    font-family: 'Arial', sans-serif;
}

.detail-item {
    display: flex;
    flex-direction: column;
}

.detail-item.full-width {
    grid-column: 1 / -1;
}

.detail-label {
    font-size: 0.85rem;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.detail-value {
    font-size: 1rem;
    font-weight: 500;
    color: #000;
    line-height: 1.4;
}

.detail-message {
    font-size: 0.95rem;
    color: #333;
    line-height: 1.6;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #000;
}

.detail-date {
    font-size: 0.9rem;
    color: #666;
    font-style: italic;
}

.btn-close-modal {
    background: #000;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-close-modal:hover {
    background: #333;
    transform: translateY(-1px);
}

@media (max-width: 768px) {
    .contact-detail-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .modal-body {
        padding: 20px !important;
    }
    
    .modal-header {
        padding: 20px !important;
    }
}
</style>
@endsection