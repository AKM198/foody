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
                            HEALTHY<br>
                            <span class="hero-bold">TASTY FOOD</span>
                        </h1>
                    </div>
                    <p class="hero-description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, 
                        augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem 
                        eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet 
                        viverra ante.
                    </p>
                    <a href="#tentang" class="btn-tentang">TENTANG KAMI</a>
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, 
                        augue eu rutrum commodo, dui diam convallis arcu, eget consectetur ex sem 
                        eget lacus. Nullam vitae dignissim neque, vel luctus ex. Fusce sit amet 
                        viverra ante.
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
                        <h4 class="menu-title">LOREM IPSUM</h4>
                        <p class="menu-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Phasellus ornare, augue eu rutrum commodo,
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
                        <h4 class="menu-title">LOREM IPSUM</h4>
                        <p class="menu-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Phasellus ornare, augue eu rutrum commodo,
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
                        <h4 class="menu-title">LOREM IPSUM</h4>
                        <p class="menu-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Phasellus ornare, augue eu rutrum commodo,
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
                        <h4 class="menu-title">LOREM IPSUM</h4>
                        <p class="menu-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Phasellus ornare, augue eu rutrum commodo,
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
                <div class="news-card large-card">
                    <img src="{{ asset('assets/images/cooking1.jpg') }}" alt="News" class="news-image">
                    <div class="news-content">
                        <h3 class="news-title">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT</h3>
                        <p class="news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio.</p>
                        <div class="news-footer">
                            <div class="news-footer-bottom">
                                <span class="read-more">Baca selengkapnya</span>
                                <span class="news-dots">•••</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 news-col">
                <div class="row news-row">
                    <div class="col-md-6 news-col">
                        <div class="news-card small-card">
                            <img src="{{ asset('assets/images/cooking2.jpg') }}" alt="News" class="news-image">
                            <div class="news-content">
                                <h4 class="news-title">LOREM IPSUM</h4>
                                <p class="news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <div class="news-footer">
                                    <div class="news-footer-bottom">
                                        <span class="read-more">Baca selengkapnya</span>
                                        <span class="news-dots">•••</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 news-col">
                        <div class="news-card small-card">
                            <img src="{{ asset('assets/images/cooking3.jpg') }}" alt="News" class="news-image">
                            <div class="news-content">
                                <h4 class="news-title">LOREM IPSUM</h4>
                                <p class="news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <div class="news-footer">
                                    <div class="news-footer-bottom">
                                        <span class="read-more">Baca selengkapnya</span>
                                        <span class="news-dots">•••</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 news-col">
                        <div class="news-card small-card">
                            <img src="{{ asset('assets/images/cooking4.jpg') }}" alt="News" class="news-image">
                            <div class="news-content">
                                <h4 class="news-title">LOREM IPSUM</h4>
                                <p class="news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <div class="news-footer">
                                    <div class="news-footer-bottom">
                                        <span class="read-more">Baca selengkapnya</span>
                                        <span class="news-dots">•••</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 news-col">
                        <div class="news-card small-card">
                            <img src="{{ asset('assets/images/cooking5.jpg') }}" alt="News" class="news-image">
                            <div class="news-content">
                                <h4 class="news-title">LOREM IPSUM</h4>
                                <p class="news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <div class="news-footer">
                                    <div class="news-footer-bottom">
                                        <span class="read-more">Baca selengkapnya</span>
                                        <span class="news-dots">•••</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <a href="#" class="btn-lihat-lebih">LIHAT LEBIH BANYAK</a>
        </div>
    </div>
</section>

@endsection