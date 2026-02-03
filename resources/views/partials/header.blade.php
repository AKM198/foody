<nav class="navbar navbar-expand-lg fixed-top" id="mainNavbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('assets/images/foodylogodrk.png') }}" alt="FOODY" style="height: 40px; margin-right: 10px;" class="navbar-logo">
            <h1 class="brand-title">FOODY</h1>
        </a>
        
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav {{ request()->routeIs('home') ? '' : 'ms-auto' }}">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
                <a href="{{ route('about.index') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">TENTANG</a>
                <a href="{{ route('news.index') }}" class="nav-item nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}">BERITA</a>
                <a href="{{ route('gallery.index') }}" class="nav-item nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">GALERI</a>
                <a href="{{ route('contact.index') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">KONTAK</a>
            </div>
        </div>
    </div>
</nav>