@extends('layouts.foody')

@section('title', 'Contact Us - Foody')

@section('content')
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Contact Us</h1>
            <p>Get in touch with us for any questions about our delicious homemade food.</p>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="bg-white rounded shadow-sm p-5">
            <div class="row g-5">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <h3 class="mb-4">Contact Form</h3>
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required style="background-color: #f8f9fa; border: 1px solid #e9ecef;">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Your Message (optional)</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="6" style="resize: none; background-color: #f8f9fa; border: 1px solid #e9ecef;">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn rounded-pill px-4 py-2" style="background-color: #C00000; border: none; color: white;">Send Message</button>
                    </form>
                </div>
                
                <!-- Contact Information -->
                <div class="col-lg-6">
                    <div class="row g-4">
                        <!-- Address -->
                        <div class="col-12">
                            <h5 class="mb-3"><i class="fa fa-map-marker-alt me-2" style="color: #C00000;"></i>Address</h5>
                            <p class="mb-0">Jl. Kuliner Nusantara No. 123, Jakarta Selatan, DKI Jakarta 12345</p>
                        </div>
                        
                        <!-- Phones -->
                        <div class="col-12">
                            <h5 class="mb-3"><i class="fa fa-phone me-2" style="color: #C00000;"></i>Phones</h5>
                            <div class="mb-2">
                                <i class="fa fa-phone me-2" style="color: #C00000;"></i>+62 812-3456-7890
                            </div>
                            <div>
                                <i class="fa fa-phone me-2" style="color: #C00000;"></i>+62 812-3456-7891
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="col-12">
                            <h5 class="mb-3"><i class="fa fa-envelope me-2" style="color: #C00000;"></i>Email</h5>
                            <p class="mb-0">
                                <i class="fa fa-envelope me-2" style="color: #C00000;"></i>foody@gmail.com
                            </p>
                        </div>
                        
                        <!-- Escalations -->
                        <div class="col-12">
                            <h5 class="mb-3"><i class="fa fa-info-circle me-2" style="color: #C00000;"></i>Escalations</h5>
                            <div class="d-flex align-items-start">
                                <i class="fa fa-info-circle me-2 mt-1" style="color: #C00000;"></i>
                                <p class="mb-0 small">"If you are not satisfied with the resolution of your complaint, please escalate your complaint at foody@gmail.com and I will personally take a look and get back to you with proper resolution"- Founder.</p>
                            </div>
                        </div>
                        
                        <!-- Follow Us -->
                        <div class="col-12">
                            <h5 class="mb-3">Follow Us</h5>
                            <div class="d-flex gap-3">
                                <a href="#" style="color: #C00000; font-size: 24px;"><i class="fab fa-facebook"></i></a>
                                <a href="#" style="color: #C00000; font-size: 24px;"><i class="fab fa-instagram"></i></a>
                                <a href="#" style="color: #C00000; font-size: 24px;"><i class="fab fa-whatsapp"></i></a>
                                <a href="#" style="color: #C00000; font-size: 24px;"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection