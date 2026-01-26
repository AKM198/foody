@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-6">
            <h4>Content</h4>
            
            <div class="form-group mb-3">
                <label for="header_title">Header Title</label>
                <input type="text" class="form-control" id="header_title" name="header_title" 
                       value="{{ $contents['header_title']->content_value ?? 'TENTANG KAMI' }}">
            </div>
            
            <div class="form-group mb-3">
                <label for="tasty_food_content">Tasty Food Content</label>
                <textarea class="form-control" id="tasty_food_content" name="tasty_food_content" rows="6">{{ $contents['tasty_food_content']->content_value ?? 'Tasty Food adalah perusahaan yang bergerak di bidang kuliner...' }}</textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="visi_content">Visi Content</label>
                <textarea class="form-control" id="visi_content" name="visi_content" rows="4">{{ $contents['visi_content']->content_value ?? 'Menjadi perusahaan kuliner terdepan...' }}</textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="misi_content">Misi Content</label>
                <textarea class="form-control" id="misi_content" name="misi_content" rows="6">{{ $contents['misi_content']->content_value ?? 'Menyediakan makanan berkualitas tinggi...' }}</textarea>
            </div>
        </div>
        
        <div class="col-md-6">
            <h4>Images</h4>
            
            <div class="form-group mb-3">
                <label for="tasty_food_image_1">Tasty Food Image 1</label>
                @if(isset($images['tasty_food_image_1']))
                    <div class="mb-2">
                        <img src="{{ asset($images['tasty_food_image_1']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="tasty_food_image_1" name="tasty_food_image_1" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="tasty_food_image_2">Tasty Food Image 2</label>
                @if(isset($images['tasty_food_image_2']))
                    <div class="mb-2">
                        <img src="{{ asset($images['tasty_food_image_2']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="tasty_food_image_2" name="tasty_food_image_2" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="visi_image_1">Visi Image 1</label>
                @if(isset($images['visi_image_1']))
                    <div class="mb-2">
                        <img src="{{ asset($images['visi_image_1']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="visi_image_1" name="visi_image_1" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="visi_image_2">Visi Image 2</label>
                @if(isset($images['visi_image_2']))
                    <div class="mb-2">
                        <img src="{{ asset($images['visi_image_2']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="visi_image_2" name="visi_image_2" accept="image/*">
            </div>
            
            <div class="form-group mb-3">
                <label for="misi_image">Misi Image</label>
                @if(isset($images['misi_image']))
                    <div class="mb-2">
                        <img src="{{ asset($images['misi_image']->image_path) }}" alt="Current" style="max-width: 100px; height: auto;">
                    </div>
                @endif
                <input type="file" class="form-control" id="misi_image" name="misi_image" accept="image/*">
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Update About Page</button>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
</form>
@endsection