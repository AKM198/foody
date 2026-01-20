@extends('layouts.foody')

@section('title', 'Gallery - Foody')

@section('content')
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Our Gallery</h1>
            <p>Explore our collection of fresh, organic, and delicious food products.</p>
        </div>
        
        <div class="text-center mb-5">
            <button class="btn btn-outline-primary rounded-pill px-4 me-2 filter-btn active" data-filter="all" style="border-color: #C00000; color: #C00000;">All</button>
            <button class="btn btn-outline-primary rounded-pill px-4 me-2 filter-btn" data-filter="healthy" style="border-color: #C00000; color: #C00000;">Healthy</button>
            <button class="btn btn-outline-primary rounded-pill px-4 me-2 filter-btn" data-filter="street" style="border-color: #C00000; color: #C00000;">Street Food</button>
            <button class="btn btn-outline-primary rounded-pill px-4 filter-btn" data-filter="homemade" style="border-color: #C00000; color: #C00000;">Homemade</button>
        </div>
        
        <div class="row g-4" id="gallery-container">
            @forelse($products as $index => $product)
            <div class="col-lg-4 col-md-6 product-item" data-category="{{ $product->category }}">
                <div class="bg-white rounded overflow-hidden shadow-sm h-100">
                    <img class="img-fluid w-100" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                    <div class="p-4">
                        <h5 class="mb-2">{{ $product->name }}</h5>
                        <p class="text-muted mb-3">{{ Str::limit($product->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary text-capitalize">{{ $product->category }}</span>
                            <span class="fw-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $product->created_at->format('M d, Y') }}</small>
                            @if($product->is_available)
                            <span class="badge bg-success">Available</span>
                            @else
                            <span class="badge bg-secondary">Out of Stock</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="bg-light rounded p-5">
                    <i class="fa fa-images fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No products available</h5>
                    <p class="text-muted">Check back later for new products.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="bg-light rounded p-5">
                    <h3 class="mb-3">Interested in Our Products?</h3>
                    <p class="lead mb-4">Follow our social media for updates on recipes and cooking tips</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('news.index') }}" class="btn btn-primary rounded-pill py-3 px-5">View News</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill py-3 px-5">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.style.backgroundColor = '';
                b.style.color = '#C00000';
            });
            this.classList.add('active');
            this.style.backgroundColor = '#C00000';
            this.style.color = 'white';
            
            // Filter products
            productItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Set initial active button
    const activeBtn = document.querySelector('.filter-btn.active');
    if (activeBtn) {
        activeBtn.style.backgroundColor = '#C00000';
        activeBtn.style.color = 'white';
    }
});
</script>

<style>
.filter-btn {
    transition: all 0.3s ease;
}

.filter-btn:hover {
    background-color: #DE3C3C !important;
    border-color: #DE3C3C !important;
    color: white !important;
}

.product-item {
    transition: all 0.3s ease;
}

.product-item:hover {
    transform: translateY(-5px);
}

.product-item .bg-white:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}
</style>
@endsection