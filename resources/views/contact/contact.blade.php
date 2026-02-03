@extends('layouts.foody')

@section('title', 'Contact Us - Foody')

@section('content')
<!-- Header Section with Banner2 Background -->
<section class="about-header">
    <div class="container-fluid">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <div class="about-header-content">
                    <h1 class="about-header-title">KONTAK KAMI</h1>
                </div>
            </div>
        </div>
    </div>
</section>

@if($showSettings ?? false)
<!-- Contact Settings Form -->
<section class="contact-form-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="contact-form-container">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    <h2 class="contact-form-title mb-4">PENGATURAN KONTAK</h2>
                    
                    <form action="{{ route('contact.settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Address</label>
                                    <textarea class="form-control contact-form-textarea" name="address" required>{{ $contactInfo['address'] ?? 'Jl. Babakan Jeruk II No.9, Pasteur\nKec. Sukajadi, Kota Bandung\nJawa Barat 40161' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="text" class="form-control contact-form-input" name="phone" value="{{ $contactInfo['phone'] ?? '+62 822-1234-5678' }}" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control contact-form-input" name="email" value="{{ $contactInfo['email'] ?? 'info@foody.com' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Map URL</label>
                                    <textarea class="form-control contact-form-textarea" name="map_url" required>{{ $mapUrl->content_value ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d300.72595531967187!2d107.66393355737362!3d-6.943197775870065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7c381e3c323%3A0x5f5160f6c9796e4b!2sCYBERLABS%20-%20Jasa%20Digital%20Marketing%20%7C%20Jasa%20Pembuatan%20Website%20%7C%20Jasa%20Pembuatan%20Aplikasi!5e0!3m2!1sid!2sid!4v1768879182825!5m2!1sid!2sid' }}</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn contact-form-submit">UPDATE SETTINGS</button>
                                <a href="{{ route('contact.index') }}" class="btn btn-secondary ms-2">BACK TO CONTACT</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="contact-form-container">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="contact-form-title mb-0">KONTAK KAMI</h2>
                        <a href="{{ route('contact.index', ['settings' => 1]) }}" class="btn btn-info">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                    </div>
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="text" class="form-control contact-form-input @error('subject') is-invalid @enderror" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control contact-form-input @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control contact-form-input @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <textarea class="form-control contact-form-textarea @error('message') is-invalid @enderror" name="message" placeholder="Message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn contact-form-submit">KIRIM</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Contact Info Section -->
<section class="contact-info-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 class="contact-info-title">ADDRESS</h4>
                    <p class="contact-info-text">{{ $contactInfo['address'] ?? 'Jl. Babakan Jeruk II No.9, Pasteur\nKec. Sukajadi, Kota Bandung\nJawa Barat 40161' }}</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h4 class="contact-info-title">PHONE</h4>
                    <p class="contact-info-text">{{ $contactInfo['phone'] ?? '+62 822-1234-5678' }}</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="text-center">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 class="contact-info-title">EMAIL</h4>
                    <p class="contact-info-text">{{ $contactInfo['email'] ?? 'info@foody.com' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-0">
    <div class="container-fluid px-0">
        <iframe src="{{ $mapUrl->content_value ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d300.72595531967187!2d107.66393355737362!3d-6.943197775870065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7c381e3c323%3A0x5f5160f6c9796e4b!2sCYBERLABS%20-%20Jasa%20Digital%20Marketing%20%7C%20Jasa%20Pembuatan%20Website%20%7C%20Jasa%20Pembuatan%20Aplikasi!5e0!3m2!1sid!2sid!4v1768879182825!5m2!1sid!2sid' }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
@endsection