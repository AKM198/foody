@extends('layouts.foody')

@section('title', 'TASTY FOOD - Berita Kami')

@section('content')
<!-- Header Section with Banner2 Background -->
<section class="about-header">
    <div class="container-fluid">
        <div class="row align-items-center h-100">
            <div class="col-lg-12">
                <div class="about-header-content">
                    <h1 class="about-header-title">BERITA KAMI</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured News Section -->
<section class="featured-news-section">
    <div class="container">
        @if($news->isNotEmpty())
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="featured-image">
                    <img src="{{ asset($news->first()->image_path) }}" alt="{{ $news->first()->title }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="featured-content">
                    <h2>{{ strtoupper($news->first()->title) }}</h2>
                    <p>{{ Str::limit(strip_tags($news->first()->content), 200) }}</p>
                    <p>{{ Str::limit(strip_tags($news->first()->content), 200, '') }}</p>
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#newsModal{{ $news->first()->id }}">BACA SELENGKAPNYA</button>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Other News Section -->
<section class="other-news-section">
    <div class="container">
        <h2>BERITA LAINNYA</h2>
        
        <div class="news-cards-row row">
            @php $otherNews = $news->skip(1)->take(8); @endphp
            @forelse($otherNews as $article)
            <div class="news-card-col col-lg-3 col-md-6 mb-4">
                <div class="news-card small-card">
                    <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="news-image">
                    <div class="news-content">
                        <h4 class="news-title">{{ strtoupper($article->title) }}</h4>
                        <p class="news-excerpt">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        <div class="news-footer">
                            <div class="news-footer-bottom">
                                <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#newsModal{{ $article->id }}">Baca selengkapnya</a>
                                <span class="news-dots">•••</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <h4 class="text-muted">Belum ada berita lainnya</h4>
            </div>
            @endforelse
        </div>
        
        @if($news->count() > 9)
        <div class="text-center mt-5">
            <button id="showAllNews" class="btn-lihat-lebih">TAMPILKAN SEMUA</button>
        </div>
        @endif
        
        <!-- Hidden news cards for show all functionality -->
        <div id="hiddenNewsCards" class="news-cards-row row" style="display: none;">
            @php $hiddenNews = $news->skip(9); @endphp
            @foreach($hiddenNews as $article)
            <div class="news-card-col col-lg-3 col-md-6 mb-4">
                <div class="news-card small-card">
                    <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="news-image">
                    <div class="news-content">
                        <h4 class="news-title">{{ strtoupper($article->title) }}</h4>
                        <p class="news-excerpt">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        <div class="news-footer">
                            <div class="news-footer-bottom">
                                <a href="#" class="read-more" data-bs-toggle="modal" data-bs-target="#newsModal{{ $article->id }}">Baca selengkapnya</a>
                                <span class="news-dots">•••</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showAllBtn = document.getElementById('showAllNews');
    const hiddenCards = document.getElementById('hiddenNewsCards');
    
    if (showAllBtn && hiddenCards) {
        showAllBtn.addEventListener('click', function() {
            hiddenCards.style.display = 'flex';
            showAllBtn.style.display = 'none';
        });
    }
});
</script>

<!-- News Modals -->
@foreach($news as $article)
<div class="modal fade" id="newsModal{{ $article->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsModalLabel{{ $article->id }}">{{ $article->title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="img-fluid w-100">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge">{{ ucfirst($article->category ?? 'Berita') }}</span>
                        <small class="text-muted">{{ $article->created_at->format('F d, Y') }}</small>
                    </div>
                    <div class="content">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
                <a href="{{ route('welcome') }}" class="btn">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection