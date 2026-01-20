@extends('layouts.app')

@section('title', 'Contacts - Admin')

@section('content')
<div class="container-lg py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 fw-bold">Contact Messages</h1>
                    <p class="text-muted">Manage customer inquiries</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @forelse($contacts as $contact)
                    <div class="border-bottom py-4">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="fw-bold">{{ $contact->subject }}</h5>
                                <p class="mb-2"><strong>From:</strong> {{ $contact->name }} ({{ $contact->email }})</p>
                                <p class="text-muted">{{ $contact->message }}</p>
                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                            <div class="col-md-4 text-md-end">
                                <small class="text-muted">{{ $contact->created_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <svg width="64" height="64" fill="currentColor" class="bi bi-envelope text-muted mb-3" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z"/>
                        </svg>
                        <h5 class="text-muted">No contact messages yet</h5>
                        <p class="text-muted">Customer inquiries will appear here.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection