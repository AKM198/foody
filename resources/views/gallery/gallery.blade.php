@extends('layouts.foody')

@section('title', 'TASTY FOOD - Galeri')

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
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="product-card">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
let currentSlide = 0;
const products = {!! json_encode($products->map(function($product) {
    return [
        'id' => $product->id,
        'name' => $product->name,
        'image' => $product->image
    ];
})) !!};

function showSlide(index) {
    if (products.length > 0) {
        document.getElementById('carouselImage').src = products[index].image;
    }
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % products.length;
    showSlide(currentSlide);
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + products.length) % products.length;
    showSlide(currentSlide);
}

// Initialize carousel
document.addEventListener('DOMContentLoaded', function() {
    if (products.length > 0) {
        showSlide(0);
    }
});
</script>
@endsection