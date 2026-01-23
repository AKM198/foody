@extends('layouts.foody')

@section('title', 'TASTY FOOD - Healthy Tasty Food')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container-fluid">
        <div class="hero-image-top-right">
            <div class="hero-image-circle">
                <img src="{{ asset('assets/images/healty3.png') }}" alt="Healthy Food">
            </div>
        </div>
        <div class="row align-items-center h-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="hero-brand-title">
                        <div class="hero-line"></div>
                        <h1 class="hero-title">
                            {{ $pageContents['hero_title']->content_value ?? 'HEALTHY' }}<br>
                            <span class="hero-bold">TASTY FOOD</span>
                        </h1>
                    </div>
                    <p class="hero-description">
                        {{ $pageContents['hero_description']->content_value ?? 'Nikmati kelezatan makanan sehat yang disiapkan dengan bahan-bahan segar pilihan terbaik. Kami menghadirkan cita rasa autentik yang memanjakan lidah sambil menjaga kesehatan tubuh Anda. Setiap hidangan dibuat dengan penuh perhatian untuk memberikan nutrisi optimal bagi keluarga.' }}
                    </p> 
                    <a href="{{ route('about.index') }}" class="btn-tentang">TENTANG KAMI</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang Kami Section -->
<section id="tentang" class="tentang-section">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">TENTANG KAMI</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <p class="tentang-description">
                        {{ $pageContents['tentang_description']->content_value ?? 'Tasty Food hadir sebagai solusi terpercaya untuk kebutuhan makanan sehat dan bergizi keluarga Indonesia. Dengan komitmen menggunakan bahan-bahan segar berkualitas tinggi, kami menghadirkan berbagai pilihan hidangan lezat yang tidak hanya memanjakan lidah tetapi juga memberikan nutrisi terbaik untuk kesehatan optimal.' }}
                    </p>
                    <div class="tentang-line"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Menu Section with Background -->
<section class="menu-section">
    <div class="container">
        <div class="row justify-content-center menu-row">
            <div class="col-lg-3 col-md-6 menu-col">
                <div class="menu-card">
                    <div class="menu-image-container">
                        <img src="{{ asset('assets/images/healty1.png') }}" alt="Menu" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h4 class="menu-title">MAKANAN SEHAT</h4>
                        <p class="menu-description">
                            Hidangan bergizi tinggi yang diolah dengan teknik memasak modern 
                            untuk mempertahankan kandungan vitamin dan mineral alami.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 menu-col">
                <div class="menu-card">
                    <div class="menu-image-container">
                        <img src="{{ asset('assets/images/healty2.png') }}" alt="Menu" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h4 class="menu-title">MAKANAN SEGAR</h4>
                        <p class="menu-description">
                            Bahan-bahan segar pilihan yang dipetik langsung dari kebun organik 
                            untuk menjamin kualitas dan kesegaran setiap hidangan.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 menu-col">
                <div class="menu-card">
                    <div class="menu-image-container">
                        <img src="{{ asset('assets/images/healty3.png') }}" alt="Menu" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h4 class="menu-title">MAKANAN BERGIZI</h4>
                        <p class="menu-description">
                            Menu seimbang dengan kandungan protein, karbohidrat, dan vitamin 
                            yang tepat untuk mendukung gaya hidup sehat keluarga.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 menu-col">
                <div class="menu-card">
                    <div class="menu-image-container">
                        <img src="{{ asset('assets/images/street3.png') }}" alt="Menu" class="menu-image">
                    </div>
                    <div class="menu-content">
                        <h4 class="menu-title">MAKANAN LEZAT</h4>
                        <p class="menu-description">
                            Cita rasa autentik yang memadukan resep tradisional dengan 
                            sentuhan modern untuk pengalaman kuliner yang tak terlupakan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita Kami Section -->
<section class="berita-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">BERITA KAMI</h2>
        </div>
        <div class="row news-row">
            <div class="col-lg-6 news-col">
                @if($news->isNotEmpty())
                <div class="news-card large-card">
                    <img src="{{ asset($news->first()->image_path) }}" alt="{{ $news->first()->title }}" class="news-image">
                    <div class="news-content">
                        <h3 class="news-title">{{ strtoupper($news->first()->title) }}</h3>
                        <p class="news-excerpt">{{ Str::limit(strip_tags($news->first()->content), 200) }}</p>
                        <div class="news-footer">
                            <div class="news-footer-bottom">
                                <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#newsModal{{ $news->first()->id }}">Baca selengkapnya</a>
                                <span class="news-dots">•••</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-6 news-col">
                <div class="row news-row">
                    @foreach($news->skip(1)->take(4) as $article)
                    <div class="col-md-6 news-col">
                        <div class="news-card small-card">
                            <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="news-image">
                            <div class="news-content">
                                <h4 class="news-title">{{ strtoupper(Str::limit($article->title, 20)) }}</h4>
                                <p class="news-excerpt">{{ Str::limit(strip_tags($article->content), 80) }}</p>
                                <div class="news-footer">
                                    <div class="news-footer-bottom">
                                        <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#newsModal{{ $article->id }}">Baca selengkapnya</a>
                                        <span class="news-dots">•••</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Kami Section -->
<section class="galeri-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">GALERI KAMI</h2>
        </div>
        <div class="row gallery-row">
            <div class="col-lg-4 col-md-6 gallery-col">
                <div class="gallery-card">
                    <img src="{{ asset('assets/images/healty1.png') }}" alt="Gallery" class="gallery-image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 gallery-col">
                <div class="gallery-card">
                    <img src="{{ asset('assets/images/healty2.png') }}" alt="Gallery" class="gallery-image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 gallery-col">
                <div class="gallery-card">
                    <img src="{{ asset('assets/images/healty3.png') }}" alt="Gallery" class="gallery-image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 gallery-col">
                <div class="gallery-card">
                    <img src="{{ asset('assets/images/cooking1.jpg') }}" alt="Gallery" class="gallery-image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 gallery-col">
                <div class="gallery-card">
                    <img src="{{ asset('assets/images/cooking2.jpg') }}" alt="Gallery" class="gallery-image">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 gallery-col">
                <div class="gallery-card">
                    <img src="{{ asset('assets/images/cooking3.jpg') }}" alt="Gallery" class="gallery-image">
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('gallery.index') }}" class="btn-lihat-lebih">LIHAT LEBIH BANYAK</a>
        </div>
    </div>
</section>

<!-- News Modals -->
@foreach($news as $article)
<div class="modal fade" id="newsModal{{ $article->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsModalLabel{{ $article->id }}">{{ $article->title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="img-fluid w-100">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge">{{ ucfirst($article->category ?? 'Berita') }}</span>
                        <small class="text-muted">{{ $article->created_at->format('F d, Y') }}</small>
                    </div>
                    <div class="content">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('news.index') }}" class="btn">Lihat Berita Lainnya</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection