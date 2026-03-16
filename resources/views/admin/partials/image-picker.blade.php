{{-- Image Picker Partial --}}
{{-- Use this in any admin form to select or upload images --}}

<div class="image-picker-container mb-3">
    <label>{{ $label ?? 'Gambar' }} {{ $required ?? false ? '<span class="text-danger">*</span>' : '' }}</label>
    
    <div class="row">
        <!-- Upload New Image -->
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-upload"></i> Upload Baru</h6>
                </div>
                <div class="card-body">
                    <input type="file" 
                           name="{{ $inputName ?? 'image' }}" 
                           id="{{ $inputId ?? 'image' }}"
                           class="form-control @error($inputName ?? 'image') is-invalid @enderror" 
                           accept="image/jpeg,image/jpg,image/png,image/gif,image/webp"
                           {{ $required ?? false ? 'required' : '' }}>
                    <small class="text-muted">Format: JPG, PNG, GIF, WebP. Max 5MB</small>
                    @error($inputName ?? 'image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Select Existing Image -->
        <div class="col-md-6 mb-2">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="fas fa-images"></i> Pilih dari Galeri</h6>
                    <button type="button" class="btn btn-sm btn-light" onclick="loadImageLibrary('{{ $category ?? 'general' }}')">
                        <i class="fas fa-sync"></i> Refresh
                    </button>
                </div>
                <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                    <div id="imageLibraryGrid" class="row g-1">
                        <div class="col-12 text-center text-muted">
                            <i class="fas fa-spinner fa-spin"></i> Memuat gambar...
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="{{ $hiddenName ?? 'selected_image_id' }}" id="{{ $hiddenId ?? 'selected_image_id' }}" value="">
                    <small class="text-muted">Atau pilih gambar yang sudah ada</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Preview Selected Image -->
    @if(isset($currentImage) && $currentImage)
    <div class="mt-2">
        <strong>Gambar Saat Ini:</strong>
        <div class="mt-1">
            <img src="{{ $currentImage }}" alt="Current" class="img-thumbnail" style="max-height: 150px;">
        </div>
    </div>
    @endif
    
    <!-- Preview Container -->
    <div id="imagePreview" class="mt-2" style="display: none;">
        <strong>Preview:</strong>
        <div class="mt-1">
            <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
        </div>
    </div>
</div>

@push('scripts')
<script>
// Image library cache
let imageLibraryCache = {};

// Load images from library
function loadImageLibrary(category = 'general') {
    const grid = document.getElementById('imageLibraryGrid');
    
    if (imageLibraryCache[category]) {
        renderImageGrid(imageLibraryCache[category], category);
        return;
    }
    
    grid.innerHTML = '<div class="col-12 text-center text-muted"><i class="fas fa-spinner fa-spin"></i> Memuat...</div>';
    
    fetch(`/admin/images-selector?category=${category}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                imageLibraryCache[category] = data.data;
                renderImageGrid(data.data, category);
            } else {
                grid.innerHTML = '<div class="col-12 text-center text-danger">Gagal memuat gambar</div>';
            }
        })
        .catch(error => {
            console.error('Error loading images:', error);
            grid.innerHTML = '<div class="col-12 text-center text-danger">Error memuat gambar</div>';
        });
}

// Render image grid
function renderImageGrid(images, category) {
    const grid = document.getElementById('imageLibraryGrid');
    const selectedId = document.getElementById('{{ $hiddenId ?? "selected_image_id" }}').value;
    
    if (!images || images.length === 0) {
        grid.innerHTML = '<div class="col-12 text-center text-muted">Belum ada gambar. Silakan upload gambar baru.</div>';
        return;
    }
    
    let html = '';
    images.forEach(img => {
        const isSelected = img.id == selectedId;
        html += `
            <div class="col-4">
                <div class="image-select-item position-relative" 
                     style="cursor: pointer; border: 2px solid ${isSelected ? '#007bff' : 'transparent'}; border-radius: 4px; overflow: hidden;"
                     onclick="selectImage(${img.id}, '${img.url}', '${img.filename.replace(/'/g, "\\'")}', '${category}')">
                    <img src="${img.thumbnail || img.url}" 
                         alt="${img.alt_text || img.filename}" 
                         class="img-fluid" 
                         style="width: 100%; height: 60px; object-fit: cover;">
                    ${isSelected ? '<div class="position-absolute top-0 end-0 bg-primary text-white p-1"><i class="fas fa-check"></i></div>' : ''}
                </div>
            </div>
        `;
    });
    
    grid.innerHTML = html;
}

// Select image from library
function selectImage(id, url, filename, category) {
    const hiddenInput = document.getElementById('{{ $hiddenId ?? "selected_image_id" }}');
    const fileInput = document.getElementById('{{ $inputId ?? "image" }}');
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImage');
    
    // Clear file input when selecting existing image
    if (fileInput) {
        fileInput.value = '';
    }
    
    // Set hidden value
    hiddenInput.value = id;
    
    // Show preview
    preview.style.display = 'block';
    previewImg.src = url;
    
    // Re-render grid to show selection
    if (imageLibraryCache[category]) {
        renderImageGrid(imageLibraryCache[category], category);
    }
    
    // Show toast/notification
    if (typeof toastr !== 'undefined') {
        toastr.success('Gambar dipilih: ' + filename);
    } else {
        alert('Gambar dipilih: ' + filename);
    }
}

// Preview uploaded file
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('{{ $inputId ?? "image" }}');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Clear selected image when uploading new
                const hiddenInput = document.getElementById('{{ $hiddenId ?? "selected_image_id" }}');
                if (hiddenInput) {
                    hiddenInput.value = '';
                }
                
                // Show preview
                const preview = document.getElementById('imagePreview');
                const previewImg = document.getElementById('previewImage');
                if (preview && previewImg) {
                    preview.style.display = 'block';
                    previewImg.src = URL.createObjectURL(file);
                }
            }
        });
    }
    
    // Load images on page load
    loadImageLibrary('{{ $category ?? "general" }}');
});
</script>
@endpush
