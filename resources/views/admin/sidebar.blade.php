<div class="admin-sidebar">
    <div class="admin-brand">
        <h4>TASTY FOOD</h4>
        <p>Admin Panel</p>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}" href="{{ route('admin.index') }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <a class="nav-link {{ request()->routeIs('admin.news') ? 'active' : '' }}" href="{{ route('admin.news') }}">
            <i class="fas fa-newspaper me-2"></i> Berita
        </a>
        <a class="nav-link {{ request()->routeIs('admin.gallery') ? 'active' : '' }}" href="{{ route('admin.gallery') }}">
            <i class="fas fa-images me-2"></i> Galeri
        </a>
        <a class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}" href="{{ route('admin.contacts') }}">
            <i class="fas fa-envelope me-2"></i> Kontak
        </a>
        <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">
            <i class="fas fa-home me-2"></i> Home
        </a>
        <a class="nav-link {{ request()->routeIs('admin.about') ? 'active' : '' }}" href="{{ route('admin.about') }}">
            <i class="fas fa-info-circle me-2"></i> About
        </a>
        <hr class="admin-divider">
        <a class="nav-link" href="{{ route('welcome') }}">
            <i class="fas fa-external-link-alt me-2"></i> Kembali ke Website
        </a>
    </nav>
</div>