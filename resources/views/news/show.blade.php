@extends('layouts.app')

@section('title', $news->title . ' - Foody')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Berita</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($news->title, 50) }}</li>
                </ol>
            </nav>
            
            <!-- Article Header -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>
                        {{ $news->published_at->format('d F Y') }}
                    </small>
                    @if($news->source)
                    <span class="badge bg-primary">
                        <i class="fas fa-tag me-1"></i>{{ $news->source }}
                    </span>
                    @endif
                </div>
                <h1 class="fw-bold">{{ $news->title }}</h1>
            </div>
            
            <!-- Featured Image -->
            <div class="mb-4">
                <img src="{{ $news->image_url }}" class="img-fluid rounded" alt="{{ $news->title }}">
            </div>
            
            <!-- Article Content -->
            <div class="article-content">
                <div class="fs-5 lh-lg">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>
            
            <!-- Share Section -->
            <div class="mt-5 pt-4 border-top">
                <h6 class="mb-3">Bagikan Artikel Ini:</h6>
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-facebook-f me-1"></i>Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}" target="_blank" class="btn btn-outline-info btn-sm">
                        <i class="fab fa-twitter me-1"></i>Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . request()->fullUrl()) }}" target="_blank" class="btn btn-outline-success btn-sm">
                        <i class="fab fa-whatsapp me-1"></i>WhatsApp
                    </a>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="mt-5 pt-4 border-top">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('news.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Berita
                        </a>
                    </div>
                    <div class="col-6 text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-home me-1"></i>Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection