@extends('layouts.admin')

@section('title', 'Pengaturan Kontak')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5>Pengaturan Informasi Kontak & Peta</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.contacts.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required>{{ $contactInfo['address'] ?? '' }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $contactInfo['phone'] ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $contactInfo['email'] ?? '' }}" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="map_url" class="form-label">URL Peta (Google Maps Embed)</label>
                <input type="url" class="form-control" id="map_url" name="map_url" value="{{ $mapUrl->content_value ?? '' }}" required>
                <div class="form-text">Masukkan URL embed dari Google Maps</div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection