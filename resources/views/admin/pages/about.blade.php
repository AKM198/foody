@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-3">
    <button type="button" class="btn btn-success" onclick="updateAll()">Update All</button>
</div>

<div class="table-responsive">
    @foreach($aboutSections as $key => $section)
    <div class="card mb-4">
        <div class="card-header">
            <h5>{{ ucfirst(str_replace('_', ' ', $key)) }} Section</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="{{ $key }}">
                
                <div class="row">
                    <div class="col-md-6">
                        @if($key === 'header' || $key === 'misi')
                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $section->title }}">
                        </div>
                        @else
                        <div class="form-group mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{ $section->title }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Content</label>
                            <textarea class="form-control" name="content" rows="3">{{ $section->content }}</textarea>
                        </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <!-- First Image -->
                        <div class="image-section-wrapper">
                            <div class="current-image">
                                <label>Current Image 1</label>
                                <img id="current_{{ $key }}_1" src="{{ asset($section->current_img) }}" class="current-img img-fluid">
                            </div>
                            
                            <div class="previous-images">
                                <label>Previous Images 1 (Click to switch)</label>
                                <div class="prev-grid">
                                    @foreach($section->getPreviousImages(1) as $index => $prevImg)
                                        <img src="{{ asset($prevImg) }}" class="prev-img img-fluid" onclick="switchImage('{{ $key }}', {{ $index }}, 1)">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" class="form-control mt-3 mb-3" name="image" accept="image/*" onchange="previewImage(this, '{{ $key }}', 1)">
                        
                        @if($key === 'visi' || $key === 'tasty_food')
                        <!-- Second Image -->
                        <div class="image-section-wrapper">
                            <div class="current-image">
                                <label>Current Image 2</label>
                                <img id="current_{{ $key }}_2" src="{{ asset($section->current_img_2 ?? 'assets/images/placeholder.png') }}" class="current-img img-fluid">
                            </div>
                            
                            <div class="previous-images">
                                <label>Previous Images 2 (Click to switch)</label>
                                <div class="prev-grid">
                                    @foreach($section->getPreviousImages(2) as $index => $prevImg)
                                        <img src="{{ asset($prevImg) }}" class="prev-img img-fluid" onclick="switchImage('{{ $key }}', {{ $index }}, 2)">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" class="form-control mt-3" name="image_2" accept="image/*" onchange="previewImage(this, '{{ $key }}', 2)">
                        @endif
                    </div>
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

function previewImage(input, section, imageType) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('current_' + section + '_' + imageType).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function switchImage(section, prevIndex, imageType) {
    fetch('{{ route("admin.about.switch-image") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            section: section,
            prev_index: prevIndex,
            image_type: imageType
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