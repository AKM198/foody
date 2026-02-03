@extends('layouts.foody')

@section('title', 'FOODY - Tentang Kami')

@section('content')
<!-- Header Section with Dynamic Background -->
<section class="about-header" style="background-image: url('{{ asset($sections['header']->current_img ?? 'assets/images/banner2.png') }}')">
    <div class="container-fluid">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <div class="about-header-content">
                    <h1 class="about-header-title">{{ $sections['header']->title ?? 'TENTANG KAMI' }}</h1>
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
                    <h2 class="about-section-title">{{ $sections['tasty_food']->title ?? 'FOODY' }}</h2>
                    <p class="about-paragraph">
                        {{ $sections['tasty_food']->content ?? 'Tasty Food adalah perusahaan kuliner terdepan yang berkomitmen menghadirkan makanan sehat dan bergizi untuk keluarga Indonesia.' }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-images-grid">
                    <div class="about-image-item">
                        <img src="{{ asset($sections['tasty_food']->current_img ?? 'assets/images/homemade3.jpg') }}" alt="Foody" class="about-img">
                    </div>
                    @if($sections['tasty_food']->current_img_2)
                    <div class="about-image-item">
                        <img src="{{ asset($sections['tasty_food']->current_img_2) }}" alt="Foody 2" class="about-img">
                    </div>
                    @endif
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
                        <img src="{{ asset($sections['visi']->current_img ?? 'assets/images/homemade6.jpg') }}" alt="Visi" class="about-img">
                    </div>
                    @if($sections['visi']->current_img_2)
                    <div class="about-image-item">
                        <img src="{{ asset($sections['visi']->current_img_2) }}" alt="Visi 2" class="about-img">
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-text-content">
                    <h2 class="about-section-title">{{ $sections['visi']->title ?? 'VISI' }}</h2>
                    <p class="about-paragraph">
                        {{ $sections['visi']->content ?? 'Menjadi pelopor revolusi makanan sehat di Indonesia dengan menciptakan generasi yang lebih sadar akan pentingnya nutrisi berkualitas.' }}
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
                    <h2 class="about-section-title">{{ $sections['misi']->title ?? 'MISI' }}</h2>
                    <p class="about-paragraph">
                        {{ $sections['misi']->content ?? 'Menyediakan solusi makanan sehat yang terjangkau dan mudah diakses untuk seluruh masyarakat Indonesia.' }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-images-grid single">
                    <div class="about-image-item large">
                        <img src="{{ asset($sections['misi']->current_img ?? 'assets/images/cooking2.jpg') }}" alt="Misi" class="about-img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection