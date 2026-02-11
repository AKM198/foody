@extends('layouts.admin')

@section('title', 'Dashboard - Admin TASTY FOOD')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <h3>{{ $stats['news_count'] }}</h3>
            <p>Total Berita</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <h3>{{ $stats['gallery_count'] }}</h3>
            <p>Total Galeri</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <h3>{{ $stats['contact_count'] }}</h3>
            <p>Pesan Kontak</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="stats-card">
            <h3>{{ $stats['about_count'] }}</h3>
            <p>Halaman About</p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background: #000; color: #fff;">
                <h5 style="font-family: Arial, sans-serif; margin: 0;">Selamat Datang di Admin Panel</h5>
            </div>
            <div class="card-body" style="padding: 30px;">
                <h4 style="font-family: Arial, sans-serif; color: #000; margin-bottom: 20px;">TASTY FOOD Admin Panel</h4>
                <p style="font-family: Arial, sans-serif; color: #666; line-height: 1.8; font-size: 1.1rem;">
                    Selamat datang di panel administrasi Tasty Food. Dari sini Anda dapat mengelola semua konten website 
                    termasuk berita, galeri, dan pesan kontak dari pengunjung. Gunakan menu navigasi di sebelah kiri 
                    untuk mengakses berbagai fitur yang tersedia.
                </p>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6 style="font-family: Arial, sans-serif; color: #000; font-weight: 600;">Fitur Utama:</h6>
                        <ul style="font-family: Arial, sans-serif; color: #666;">
                            <li>Kelola Berita dan Artikel</li>
                            <li>Kelola Galeri Foto</li>
                            <li>Lihat Pesan Kontak</li>
                            <li>Statistik Website</li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection