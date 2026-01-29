@extends('layouts.admin')

@section('title', 'Semua Data Kontak')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
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
                    <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#viewModal{{ $contact->id }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                <td colspan="7" class="text-center">Tidak ada pesan kontak</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $contacts->links() }}

<!-- View Modals -->
@foreach($contacts as $contact)
<div class="modal fade" id="viewModal{{ $contact->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kontak - {{ $contact->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Nama:</strong><br>
                        {{ $contact->name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong><br>
                        {{ $contact->email }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <strong>Subject:</strong><br>
                        {{ $contact->subject }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <strong>Pesan:</strong><br>
                        {{ $contact->message }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <strong>Tanggal:</strong><br>
                        {{ $contact->created_at->format('d F Y, H:i:s') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection