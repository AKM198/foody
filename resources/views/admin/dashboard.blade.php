@extends('layouts.app')

@section('title', 'Admin Dashboard - Foody')

@section('content')
<div class="container-lg py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="h3 fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Manage your Foody website content</p>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total News</h5>
                            <h2 class="fw-bold">{{ $totalNews }}</h2>
                        </div>
                        <div class="align-self-center">
                            <svg width="48" height="48" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                                <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972a.757.757 0 0 1-.738.5H1.5A1.5 1.5 0 0 1 0 12.5V2.5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">Total Contacts</h5>
                            <h2 class="fw-bold">{{ $totalContacts }}</h2>
                        </div>
                        <div class="align-self-center">
                            <svg width="48" height="48" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="h5 fw-bold mb-3">Quick Actions</h3>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Add News
                </a>
                <a href="{{ route('admin.contacts') }}" class="btn btn-outline-primary">
                    <svg width="16" height="16" fill="currentColor" class="bi bi-envelope me-2" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z"/>
                    </svg>
                    View Contacts
                </a>
            </div>
        </div>
    </div>
    
    <!-- Recent Content -->
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent News</h5>
                </div>
                <div class="card-body">
                    @forelse($recentNews as $news)
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <div>
                            <h6 class="mb-1">{{ Str::limit($news->title, 30) }}</h6>
                            <small class="text-muted">{{ $news->created_at->format('M d, Y') }}</small>
                        </div>
                        <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    </div>
                    @empty
                    <p class="text-muted">No news articles yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Contacts</h5>
                </div>
                <div class="card-body">
                    @forelse($recentContacts as $contact)
                    <div class="py-2 border-bottom">
                        <h6 class="mb-1">{{ $contact->name }}</h6>
                        <p class="mb-1 small">{{ $contact->subject }}</p>
                        <small class="text-muted">{{ $contact->created_at->format('M d, Y') }}</small>
                    </div>
                    @empty
                    <p class="text-muted">No contact messages yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection