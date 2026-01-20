@extends('layouts.foody')

@section('content')
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Food Stories & News</h1>
            <p>Discover the latest culinary trends, recipes, and food culture stories from around the world.</p>
        </div>
        
        <div class="row g-4">
            @forelse($news as $article)
            <div class="col-lg-4 col-md-6">
                <div class="news-card h-100" style="background: white; overflow: hidden; box-shadow: 0 8px 25px rgba(0,0,0,0.1); transition: all 0.3s ease;">
                    <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="img-fluid" style="height: 250px; object-fit: cover; width: 100%;">
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary">{{ ucfirst($article->category) }}</span>
                            <small class="text-muted">{{ $article->created_at->format('M d, Y') }}</small>
                        </div>
                        <h5 class="mb-3">{{ $article->title }}</h5>
                        <p class="text-muted mb-3">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#newsModal{{ $article->id }}">Read More</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fa fa-newspaper fa-4x text-muted mb-4"></i>
                <h4 class="text-muted">No news available</h4>
                <p class="text-muted">Check back later for updates.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($news->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $news->links() }}
        </div>
        @endif
    </div>
</div>

<!-- News Modals -->
@foreach($news as $article)
<div class="modal fade" id="newsModal{{ $article->id }}" tabindex="-1" aria-labelledby="newsModalLabel{{ $article->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border: none; overflow: hidden;">
            <div class="modal-header" style="background: #FFF0C4; color: #333; border: none; padding: 1.5rem;">
                <h5 class="modal-title fw-bold" id="newsModalLabel{{ $article->id }}">{{ $article->title }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img src="{{ asset($article->image_path) }}" alt="{{ $article->title }}" class="img-fluid w-100" style="height: 300px; object-fit: cover;">
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-primary">{{ ucfirst($article->category) }}</span>
                        <small class="text-muted">{{ $article->created_at->format('F d, Y') }}</small>
                    </div>
                    <div class="content" style="line-height: 1.8;">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none; background-color: #f8f9fa; padding: 1rem 1.5rem;">
                <button type="button" class="btn btn-outline-secondary rounded-pill py-2 px-4" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('welcome') }}" class="btn btn-primary rounded-pill py-2 px-4">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.2) !important;
}
</style>
@endsection