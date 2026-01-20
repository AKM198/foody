<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Foody - Organic Food Website Template')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/css/stylesheet.css') }}" rel="stylesheet">
    


    @stack('styles')
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    
    @include('partials.header')

    <!-- Search Modal -->
    <div id="searchModal" class="search-modal">
        <div class="search-overlay">
            <div class="search-content">
                <h1 class="search-title">What're you searching for?</h1>
                <button id="closeSearch" class="close-search">&times;</button>
                <div class="search-input-container">
                    <input type="text" id="searchInput" placeholder="start typing" class="search-input">
                    <button id="clearSearch" class="clear-btn" style="display: none;">clear</button>
                </div>
                <div id="searchResults" class="search-results"></div>
            </div>
        </div>
    </div>

    @yield('page-header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/header.js') }}"></script>

    <!-- Search Modal Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBtn = document.querySelector('a[title="Search"]');
        const searchModal = document.getElementById('searchModal');
        const closeSearch = document.getElementById('closeSearch');
        const searchInput = document.getElementById('searchInput');
        const clearSearch = document.getElementById('clearSearch');
        const searchResults = document.getElementById('searchResults');

        if (searchBtn) {
            searchBtn.addEventListener('click', function(e) {
                e.preventDefault();
                searchModal.style.display = 'flex';
                setTimeout(() => searchInput.focus(), 100);
            });
        }

        closeSearch.addEventListener('click', function() {
            searchModal.style.display = 'none';
            searchInput.value = '';
            clearSearch.style.display = 'none';
            searchResults.innerHTML = '';
        });

        searchModal.addEventListener('click', function(e) {
            if (e.target === searchModal || e.target.classList.contains('search-overlay')) {
                searchModal.style.display = 'none';
                searchInput.value = '';
                clearSearch.style.display = 'none';
                searchResults.innerHTML = '';
            }
        });

        clearSearch.addEventListener('click', function() {
            searchInput.value = '';
            clearSearch.style.display = 'none';
            searchResults.innerHTML = '';
            searchInput.focus();
        });

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            if (query.length > 0) {
                clearSearch.style.display = 'block';
                performSearch(query);
            } else {
                clearSearch.style.display = 'none';
                searchResults.innerHTML = '';
            }
        });

        function performSearch(query) {
            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displayResults(data);
                })
                .catch(error => {
                    console.error('Search error:', error);
                });
        }

        function displayResults(products) {
            if (products.length === 0) {
                searchResults.innerHTML = '<div class="no-results">No products found</div>';
                return;
            }

            const resultsHTML = products.map(product => `
                <div class="search-result-item">
                    <img src="${product.image_path}" alt="${product.name}" class="result-image">
                    <div class="result-info">
                        <h4>${product.name}</h4>
                        <p class="result-price">Rp ${new Intl.NumberFormat('id-ID').format(product.price)}</p>
                    </div>
                </div>
            `).join('');

            searchResults.innerHTML = resultsHTML;
        }
    });
    </script>



    @stack('scripts')
</body>
</html>