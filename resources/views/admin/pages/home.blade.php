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
            
            <div class="form-group mb-3">
                <label for="menu_card_1">Menu Card 1</label>
                @if(isset($images['menu_card_1']))
                    <div class="mb-2">
                        <img src="{{ asset($images['menu_card_1']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="menu_card_1" name="menu_card_1" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="menu_card_2">Menu Card 2</label>
                @if(isset($images['menu_card_2']))
                    <div class="mb-2">
                        <img src="{{ asset($images['menu_card_2']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="menu_card_2" name="menu_card_2" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="menu_card_3">Menu Card 3</label>
                @if(isset($images['menu_card_3']))
                    <div class="mb-2">
                        <img src="{{ asset($images['menu_card_3']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="menu_card_3" name="menu_card_3" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="menu_card_4">Menu Card 4</label>
                @if(isset($images['menu_card_4']))
                    <div class="mb-2">
                        <img src="{{ asset($images['menu_card_4']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="menu_card_4" name="menu_card_4" accept="image/*">
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Update Home Page</button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</form>
@endsection