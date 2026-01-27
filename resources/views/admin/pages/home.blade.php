@extends('layouts.admin')

@section('title', 'Edit Home Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-6">
            <h4>Content</h4>
            
            <div class="form-group mb-3">
                <label for="hero_title">Hero Title</label>
                <input type="text" class="form-control" id="hero_title" name="hero_title" 
                       value="{{ $contents['hero_title']->content_value ?? 'HEALTHY TASTY FOOD' }}">
            </div>
            
            <div class="form-group mb-3">
                <label for="hero_description">Hero Description</label>
                <textarea class="form-control" id="hero_description" name="hero_description" rows="4">{{ $contents['hero_description']->content_value ?? 'Nikmati kelezatan makanan sehat yang disiapkan dengan bahan-bahan segar pilihan terbaik...' }}</textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="tentang_description">Tentang Kami Description</label>
                <textarea class="form-control" id="tentang_description" name="tentang_description" rows="4">{{ $contents['tentang_description']->content_value ?? 'Tasty Food hadir sebagai solusi terpercaya untuk kebutuhan makanan sehat...' }}</textarea>
            </div>
        </div>
        
        <div class="col-md-6">
            <h4>Menu Card Images</h4>
            
            @foreach(['menu_card_1', 'menu_card_2', 'menu_card_3', 'menu_card_4'] as $index => $field)
            <div class="form-group mb-3">
                <label for="{{ $field }}">Menu Card {{ $index + 1 }}</label>
                @if(isset($images[$field]))
                    <div class="mb-2">
                        <img src="{{ asset($images[$field]->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="{{ $field }}" name="{{ $field }}" accept="image/*">
            </div>
            @endforeach
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Update Home Page</button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</form>
@endsection