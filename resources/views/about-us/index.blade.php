@extends('layouts.foody')

@section('title', 'FOODY - Tentang Kami')

@section('content')
<!-- Header Section with Banner2 Background -->
<section class="about-header">
    <div class="container-fluid">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <div class="about-header-content">
                    <h1 class="about-header-title">{{ $pageContents['header_title']->content_value ?? 'TENTANG KAMI' }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tasty Food Section -->
<section class="about-tasty-food-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">FOODY</h2>
                    <p class="about-paragraph">
                        {{ $pageContents['tasty_food_content']->content_value ?? 'Tasty Food adalah perusahaan kuliner terdepan yang berkomitmen menghadirkan makanan sehat dan bergizi untuk keluarga Indonesia. Sejak didirikan, kami telah melayani ribuan pelanggan dengan standar kualitas tertinggi dalam setiap hidangan yang kami sajikan.' }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-images-grid">
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/homemade3.jpg') }}" alt="Foody" class="about-img">
                    </div>
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/cooking3.jpg') }}" alt="Foody" class="about-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi Section -->
<section class="about-visi-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-images-grid">
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/homemade6.jpg') }}" alt="Visi" class="about-img">
                    </div>
                    <div class="about-image-item">
                        <img src="{{ asset('assets/images/street2.jpg') }}" alt="Visi" class="about-img">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">VISI</h2>
                    <p class="about-paragraph">
                        {{ $pageContents['visi_content']->content_value ?? 'Menjadi pelopor revolusi makanan sehat di Indonesia dengan menciptakan generasi yang lebih sadar akan pentingnya nutrisi berkualitas.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Misi Section -->
<section class="about-misi-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">MISI</h2>
                    <p class="about-paragraph">
                        {{ $pageContents['misi_content']->content_value ?? 'Menyediakan solusi makanan sehat yang terjangkau dan mudah diakses untuk seluruh masyarakat Indonesia.' }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-images-grid single">
                    <div class="about-image-item large">
                        <img src="{{ asset('assets/images/cooking2.jpg') }}" alt="Misi" class="about-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection