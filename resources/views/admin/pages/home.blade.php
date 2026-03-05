@extends('layouts.admin')

@section('title', 'Edit Home Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-3">
    <button type="button" class="btn btn-success" onclick="updateAll()">Update All</button>
</div>

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
                        <div class="image-section-wrapper">
                            <div class="current-image">
                                <label>Current Image @if($key === 'header')(Top Circle)@endif</label>
                                <img id="current_{{ $key }}" src="{{ asset($section->current_img) }}" class="current-img img-fluid">
                            </div>
                            
                            <div class="previous-images">
                                <label>Previous Images (Click to switch)</label>
                                <div class="prev-grid">
                                    @foreach($section->getPreviousImages() as $index => $prevImg)
                                        <img src="{{ asset($prevImg) }}" class="prev-img img-fluid" onclick="switchImage('{{ $key }}', {{ $index }})">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" class="form-control mt-3" name="image" accept="image/*" onchange="previewImage(this, '{{ $key }}')">
                    </div>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<style>
.image-section-wrapper {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
    align-items: flex-start;
}

.current-image {
    flex: 0 0 auto;
}

.previous-images {
    flex: 0 0 auto;
    display: flex;
    flex-direction: column;
}

.current-image label, .previous-images label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
}

.current-img {
    width: 200px;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #007bff;
}

.prev-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    width: 200px;
}

.prev-img {
    width: 100%;
    height: 70px;
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
    .image-section-wrapper {
        gap: 15px;
    }
    
    .current-img {
        width: 180px;
        height: 130px;
    }
    
    .prev-grid {
        width: 180px;
    }
    
    .prev-img {
        height: 60px;
    }
}

@media (max-width: 500px) {
    .image-section-wrapper {
        flex-direction: column;
        gap: 15px;
    }
    
    .current-img {
        width: 160px;
        height: 120px;
    }
    
    .prev-grid {
        width: 160px;
    }
    
    .prev-img {
        height: 55px;
    }
}
</style>

<script>
function updateAll() {
    if (confirm('Are you sure you want to update all sections?')) {
        const forms = document.querySelectorAll('form');
        let completed = 0;
        
        forms.forEach((form, index) => {
            setTimeout(() => {
                const formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    completed++;
                    if (completed === forms.length) {
                        alert('All sections updated successfully!');
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }, index * 500);
        });
    }
}

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