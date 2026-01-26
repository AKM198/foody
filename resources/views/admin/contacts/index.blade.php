@extends('layouts.admin')

@section('title', 'Kelola Kontak')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
@endsection