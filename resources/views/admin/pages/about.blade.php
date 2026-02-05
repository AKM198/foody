@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-responsive">
    @foreach($aboutSections as $key => $section)
    <div class="card mb-4" id="section-{{ $key }}">
        <div class="card-header">
            <h5>{{ ucfirst(str_replace('_', ' ', $key)) }} Section</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" onsubmit="console.log('Form submitted for section:', this.querySelector('[name=section]').value);">
                @csrf
                @method('PUT')
                <input type="hidden" name="section" value="{{ $key }}">
                
                <div class="row">
                    <div class="col-md-6">
                        @if($key === 'header')
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
                        <div class="image-section">
                            <!-- First Image -->
                            <div class="image-layout">
                                <div class="current-image-container">
                                    <label>Current Image 1</label>
                                    <img id="current_{{ $key }}_1" src="{{ asset($section->current_img) }}" class="current-img img-fluid">
                                </div>
                                
                                <div class="previous-images-container">
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
                            <div class="image-layout">
                                <div class="current-image-container">
                                    <label>Current Image 2</label>
                                    <img id="current_{{ $key }}_2" src="{{ asset($section->current_img_2 ?? 'assets/images/placeholder.png') }}" class="current-img img-fluid">
                                </div>
                                
                                <div class="previous-images-container">
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
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<style>
.image-layout {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 20px;
}

.current-image-container {
    width: 100%;
}

.current-img {
    width: 100%;
    max-width: 300px;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #007bff;
}

.previous-images-container {
    width: 100%;
}

.prev-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    max-width: 150px;
    margin-left: auto;
    margin-right: auto;
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

@media (min-width: 992px) {
    .image-layout {
        flex-direction: row;
        align-items: flex-start;
    }
    
    .current-image-container {
        flex: 2;
    }
    
    .previous-images-container {
        flex: 1;
        margin-left: 20px;
    }
    
    .prev-grid {
        margin-left: 0;
        margin-right: 0;
    }
}

@media (max-width: 768px) {
    .current-img {
        max-width: 250px;
        height: 150px;
    }
    
    .prev-img {
        height: 45px;
    }
    
    .prev-grid {
        max-width: 120px;
    }
}
</style>

<script>
function previewImage(input, section, imageType) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgElement = document.getElementById('current_' + section + '_' + imageType);
            if (imgElement) {
                imgElement.src = e.target.result;
            }
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
            // Store current section before reload
            sessionStorage.setItem('scrollToSection', section);
            location.reload();
        } else {
            console.error('Error switching image:', data.message);
            alert('Error switching image: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Network error:', error);
        alert('Network error occurred while switching image');
    });
}

// Add form validation and scroll handling
document.addEventListener('DOMContentLoaded', function() {
    // Scroll to section after page load
    const scrollToSection = sessionStorage.getItem('scrollToSection');
    if (scrollToSection) {
        const element = document.getElementById('section-' + scrollToSection);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        sessionStorage.removeItem('scrollToSection');
    }
    
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            const sectionInput = form.querySelector('input[name="section"]');
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Updating...';
            }
            
            // Store section for scroll after form submission
            if (sectionInput) {
                sessionStorage.setItem('scrollToSection', sectionInput.value);
            }
        });
    });
});
</script>
@endsection