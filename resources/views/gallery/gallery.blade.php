@extends('layouts.foody')

@section('title', 'FOODY - Galeri')

@section('content')
<!-- Header Section with Banner2 Background -->
<section class="about-header">
    <div class="container-fluid">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <div class="about-header-content">
                    <h1 class="about-header-title">GALERI KAMI</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carousel Section -->
<section class="product-carousel-section">
    <div class="container">
        <div class="product-carousel-container">
            <div class="product-carousel-wrapper">
                <button class="carousel-nav prev" onclick="prevSlide()">‹</button>
                <div class="product-carousel-image">
                    <img id="carouselImage" src="" alt="Product Image">
                </div>
                <button class="carousel-nav next" onclick="nextSlide()">›</button>
            </div>
        </div>
    </div>
</section>

<!-- Product Grid Section -->
<section class="product-grid-section">
    <div class="container">
        <div class="row" id="galleryGrid">
            @foreach($galleries as $index => $gallery)
            <div class="col-md-3 col-sm-6 mb-4 gallery-item {{ $index >= 8 ? 'd-none' : '' }}">
                <div class="product-card">
                    @if(Str::startsWith($gallery->image_path, 'http'))
                        <img src="{{ $gallery->image_path }}" alt="{{ $gallery->name }}" class="product-image">
                    @else
                        <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->name }}" class="product-image">
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @if($galleries->count() > 8)
        <div class="text-center mt-4">
            <button id="loadMoreGallery" class="btn-load-more" onclick="loadMoreGallery()">LIHAT LEBIH BANYAK</button>
        </div>
        @endif
    </div>
</section>

<script>
let currentSlide = 0;
const galleries = {!! json_encode($galleries->toArray()) !!}.map(function(gallery) {
    let imagePath = gallery.image_path;
    if (imagePath.startsWith('http')) {
        return {
            id: gallery.id,
            name: gallery.name,
            image: imagePath
        };
    } else {
        return {
            id: gallery.id,
            name: gallery.name,
            image: '{{ asset('') }}' + imagePath
        };
    }
});

function showSlide(index) {
    if (galleries.length > 0) {
        const img = document.getElementById('carouselImage');
        img.src = galleries[index].image;
        img.alt = galleries[index].name;
    }
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % galleries.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + galleries.length) % galleries.length;
    showSlide(currentSlide);
}

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    if (galleries.length > 0) {
        showSlide(0);
    }
});

function loadMoreGallery() {
    const hiddenItems = document.querySelectorAll('.gallery-item.d-none');
    let delay = 0;
    hiddenItems.forEach(item => {
        setTimeout(() => {
            item.classList.remove('d-none');
            item.classList.add('fade-in-down');
        }, delay);
        delay += 100;
    });
    document.getElementById('loadMoreGallery').style.display = 'none';
}
</script>
@endsection