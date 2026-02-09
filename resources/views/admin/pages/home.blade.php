@extends('layouts.admin')

@section('title', 'Edit Home Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    @foreach($homeSections as $key => $section)
    <div class="card mb-4">
        <div class="card-header">
            <h5>{{ ucfirst(str_replace('_', ' ', $key)) }} Section</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="{{ $key }}">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $section->title }}">
                        </div>
                        @if($key !== 'header')
                        <div class="form-group mb-3">
                            <label>Content</label>
                            <textarea class="form-control" name="content" rows="3">{{ $section->content }}</textarea>
                        </div>
                        @endif
                    </div>
                    
                    @if($key !== 'tentang')
                    <div class="col-md-6">
                        <div class="image-section">
                            <div class="current-image mb-3">
                                <label>Current Image @if($key === 'header')(Top Circle)@endif</label>
                                <img id="current_{{ $key }}" src="{{ asset($section->current_img) }}" class="current-img img-fluid">
                            </div>
                            
                            <div class="previous-images mb-3">
                                <label>Previous Images (Click to switch)</label>
                                <div class="prev-grid">
                                    @foreach($section->getPreviousImages() as $index => $prevImg)
                                        <img src="{{ asset($prevImg) }}" class="prev-img img-fluid" onclick="switchImage('{{ $key }}', {{ $index }})">
                                    @endforeach
                                </div>
                            </div>
                            
                            <input type="file" class="form-control" name="image" accept="image/*" onchange="previewImage(this, '{{ $key }}')">
                        </div>
                    </div>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary">Update {{ ucfirst(str_replace('_', ' ', $key)) }}</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<style>
.current-img {
    width: 100%;
    max-width: 200px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #007bff;
}

.prev-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
    gap: 5px;
    max-width: 200px;
}

.prev-img {
    width: 100%;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ccc;
    cursor: pointer;
    transition: all 0.3s ease;
}

.prev-img:hover {
    border-color: #007bff;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .current-img {
        max-width: 150px;
        height: 90px;
    }
    
    .prev-img {
        height: 45px;
    }
    
    .prev-grid {
        max-width: 150px;
    }
}
</style>

<script>
function previewImage(input, section) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('current_' + section).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function switchImage(section, prevIndex) {
    fetch('{{ route("admin.home.switch-image") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            section: section,
            prev_index: prevIndex
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endsection