<!-- Image Carousel Component -->
<div class="image-carousel-container">
    <div class="main-image-container">
        <button class="carousel-nav prev" onclick="prevImage()">‹</button>
        <div class="main-image-wrapper">
            <img id="mainImage" src="{{ asset('assets/images/healty1.png') }}" alt="Main Image">
        </div>
        <button class="carousel-nav next" onclick="nextImage()">›</button>
    </div>
    
    <div class="thumbnail-container">
        <div class="thumbnail active" onclick="showImage(0)">
            <img src="{{ asset('assets/images/healty1.png') }}" alt="Image 1">
        </div>
        <div class="thumbnail" onclick="showImage(1)">
            <img src="{{ asset('assets/images/healty2.png') }}" alt="Image 2">
        </div>
        <div class="thumbnail" onclick="showImage(2)">
            <img src="{{ asset('assets/images/healty3.png') }}" alt="Image 3">
        </div>
        <div class="thumbnail" onclick="showImage(3)">
            <img src="{{ asset('assets/images/cooking1.jpg') }}" alt="Image 4">
        </div>
    </div>
</div>

<style>
.image-carousel-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.main-image-container {
    position: relative;
    background: linear-gradient(135deg, #ff6b35, #f7931e);
    border-radius: 25px;
    padding: 40px;
    margin-bottom: 20px;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-image-wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-image-wrapper img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 20px;
    object-fit: cover;
}

.carousel-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.9);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}

.carousel-nav.prev {
    left: 15px;
}

.carousel-nav.next {
    right: 15px;
}

.carousel-nav:hover {
    background: white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.thumbnail-container {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.thumbnail {
    width: 120px;
    height: 120px;
    border-radius: 15px;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s ease;
}

.thumbnail.active {
    border-color: #ff6b35;
    transform: scale(1.05);
}

.thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>

<script>
const images = [
    '{{ asset("assets/images/healty1.png") }}',
    '{{ asset("assets/images/healty2.png") }}',
    '{{ asset("assets/images/healty3.png") }}',
    '{{ asset("assets/images/cooking1.jpg") }}'
];

let currentIndex = 0;

function showImage(index) {
    currentIndex = index;
    document.getElementById('mainImage').src = images[index];
    
    document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
        thumb.classList.toggle('active', i === index);
    });
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
}

function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
}
</script>