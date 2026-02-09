// CRUD Modal System - Isolated with IIFE
(function() {
    'use strict';
    
    // State Management
    const state = {
        currentItem: null,
        modalType: null
    };
    
    // DOM Elements
    let modalOverlay, modalContainer, modalHeader, modalBody, modalFooter;
    
    // Initialize
    function init() {
        createModalElements();
        attachEventListeners();
    }
    
    // Create Modal Structure
    function createModalElements() {
        // Create overlay
        modalOverlay = document.createElement('div');
        modalOverlay.className = 'crud-modal-overlay';
        modalOverlay.id = 'crudModalOverlay';
        
        // Create container
        modalContainer = document.createElement('div');
        modalContainer.className = 'crud-modal-container';
        
        // Create header
        modalHeader = document.createElement('div');
        modalHeader.className = 'crud-modal-header';
        
        // Create body
        modalBody = document.createElement('div');
        modalBody.className = 'crud-modal-body';
        
        // Create footer
        modalFooter = document.createElement('div');
        modalFooter.className = 'crud-modal-footer';
        
        // Assemble modal
        modalContainer.appendChild(modalHeader);
        modalContainer.appendChild(modalBody);
        modalContainer.appendChild(modalFooter);
        modalOverlay.appendChild(modalContainer);
        
        // Add to document
        document.body.appendChild(modalOverlay);
        
        // Close on overlay click
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });
    }
    
    // Attach Event Listeners
    function attachEventListeners() {
        // Tambah Data Button
        const tambahBtn = document.getElementById('crudTambahBtn');
        if (tambahBtn) {
            tambahBtn.addEventListener('click', openCreateModal);
        }
        
        // View Buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.crud-btn-view')) {
                const btn = e.target.closest('.crud-btn-view');
                const id = btn.dataset.id;
                openViewModal(id);
            }
        });
        
        // Edit Buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.crud-btn-edit')) {
                const btn = e.target.closest('.crud-btn-edit');
                const id = btn.dataset.id;
                openEditModal(id);
            }
        });
        
        // Delete Buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('.crud-btn-delete')) {
                const btn = e.target.closest('.crud-btn-delete');
                const id = btn.dataset.id;
                openDeleteConfirm(id);
            }
        });
    }
    
    // Open Create Modal
    function openCreateModal() {
        state.modalType = 'create';
        
        modalHeader.innerHTML = `
            <h3 class="crud-modal-title">Tambah Data</h3>
            <button class="crud-modal-close" onclick="window.CRUDModal.close()">&times;</button>
        `;
        
        modalBody.innerHTML = `
            <form id="crudCreateForm">
                <div class="crud-form-group">
                    <label class="crud-form-label">Gambar</label>
                    <input type="file" class="crud-form-file" id="crudImageInput" accept="image/*" required>
                    <img id="crudImagePreview" class="crud-image-preview" style="display:none;">
                </div>
                <div class="crud-form-group">
                    <label class="crud-form-label">Judul</label>
                    <input type="text" class="crud-form-input" id="crudTitleInput" placeholder="Masukkan judul" required>
                </div>
                <div class="crud-form-group">
                    <label class="crud-form-label">Deskripsi</label>
                    <textarea class="crud-form-textarea" id="crudDescInput" placeholder="Masukkan deskripsi" required></textarea>
                </div>
            </form>
        `;
        
        modalFooter.innerHTML = `
            <button class="crud-btn crud-btn-secondary" onclick="window.CRUDModal.close()">Batal</button>
            <button class="crud-btn crud-btn-primary" onclick="window.CRUDModal.submitCreate()">Simpan</button>
        `;
        
        openModal();
        
        // Image preview
        document.getElementById('crudImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('crudImagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Open View Modal
    function openViewModal(id) {
        state.modalType = 'view';
        
        // Get data from row
        const row = document.querySelector(`[data-gallery-id="${id}"]`);
        if (!row) return;
        
        const img = row.querySelector('img').src;
        const title = row.querySelector('.gallery-title').textContent;
        const desc = row.querySelector('.gallery-desc').textContent;
        const date = row.querySelector('.gallery-date').textContent;
        
        modalHeader.innerHTML = `
            <h3 class="crud-modal-title">Detail</h3>
            <button class="crud-modal-close" onclick="window.CRUDModal.close()">&times;</button>
        `;
        
        modalBody.innerHTML = `
            <img src="${img}" alt="${title}" class="crud-view-image">
            <div class="crud-view-meta">
                <span class="crud-view-badge">Data</span>
                <span class="crud-view-date">${date}</span>
            </div>
            <h2 class="crud-view-title">${title}</h2>
            <p class="crud-view-description">${desc}</p>
        `;
        
        modalFooter.innerHTML = `
            <button class="crud-btn crud-btn-secondary" onclick="window.CRUDModal.close()">Tutup</button>
        `;
        
        openModal();
    }
    
    // Open Edit Modal
    function openEditModal(id) {
        state.modalType = 'edit';
        state.currentItem = id;
        
        // Get data from row
        const row = document.querySelector(`[data-gallery-id="${id}"]`);
        if (!row) return;
        
        const img = row.querySelector('img').src;
        const title = row.querySelector('.gallery-title').textContent;
        const desc = row.querySelector('.gallery-desc').textContent;
        
        modalHeader.innerHTML = `
            <h3 class="crud-modal-title">Edit Data</h3>
            <button class="crud-modal-close" onclick="window.CRUDModal.close()">&times;</button>
        `;
        
        modalBody.innerHTML = `
            <form id="crudEditForm">
                <div class="crud-form-group">
                    <label class="crud-form-label">Gambar Saat Ini</label>
                    <img src="${img}" class="crud-image-preview">
                    <input type="file" class="crud-form-file" id="crudImageInput" accept="image/*" style="margin-top:10px;">
                    <img id="crudImagePreview" class="crud-image-preview" style="display:none;">
                </div>
                <div class="crud-form-group">
                    <label class="crud-form-label">Judul</label>
                    <input type="text" class="crud-form-input" id="crudTitleInput" value="${title}" required>
                </div>
                <div class="crud-form-group">
                    <label class="crud-form-label">Deskripsi</label>
                    <textarea class="crud-form-textarea" id="crudDescInput" required>${desc}</textarea>
                </div>
            </form>
        `;
        
        modalFooter.innerHTML = `
            <button class="crud-btn crud-btn-secondary" onclick="window.CRUDModal.close()">Batal</button>
            <button class="crud-btn crud-btn-primary" onclick="window.CRUDModal.submitEdit()">Update</button>
        `;
        
        openModal();
        
        // Image preview for new upload
        document.getElementById('crudImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('crudImagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Open Delete Confirmation
    function openDeleteConfirm(id) {
        state.modalType = 'delete';
        state.currentItem = id;
        
        modalHeader.innerHTML = `
            <h3 class="crud-modal-title">Konfirmasi Hapus</h3>
            <button class="crud-modal-close" onclick="window.CRUDModal.close()">&times;</button>
        `;
        
        modalBody.innerHTML = `
            <p class="crud-confirm-text">Apakah Anda yakin ingin menghapus data ini?<br>Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="crud-confirm-buttons">
                <button class="crud-btn crud-btn-secondary" onclick="window.CRUDModal.close()">Batal</button>
                <button class="crud-btn crud-btn-danger" onclick="window.CRUDModal.confirmDelete()">Hapus</button>
            </div>
        `;
        
        modalFooter.innerHTML = '';
        
        openModal();
    }
    
    // Submit Create
    function submitCreate() {
        const form = document.getElementById('crudCreateForm');
        const formData = new FormData();
        
        const imageFile = document.getElementById('crudImageInput').files[0];
        const title = document.getElementById('crudTitleInput').value;
        const desc = document.getElementById('crudDescInput').value;
        
        if (!imageFile || !title || !desc) {
            alert('Semua field harus diisi!');
            return;
        }
        
        // Detect if we're on news or gallery page
        const isNewsPage = window.location.pathname.includes('/news');
        
        formData.append('image', imageFile);
        formData.append(isNewsPage ? 'title' : 'name', title);
        formData.append(isNewsPage ? 'content' : 'description', desc);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        
        // Submit via AJAX
        fetch(window.location.pathname, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal();
                location.reload();
            } else {
                alert('Gagal menyimpan data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
    
    // Submit Edit
    function submitEdit() {
        const formData = new FormData();
        
        const imageFile = document.getElementById('crudImageInput').files[0];
        const title = document.getElementById('crudTitleInput').value;
        const desc = document.getElementById('crudDescInput').value;
        
        if (!title || !desc) {
            alert('Judul dan deskripsi harus diisi!');
            return;
        }
        
        // Detect if we're on news or gallery page
        const isNewsPage = window.location.pathname.includes('/news');
        
        if (imageFile) {
            formData.append('image', imageFile);
        }
        formData.append(isNewsPage ? 'title' : 'name', title);
        formData.append(isNewsPage ? 'content' : 'description', desc);
        formData.append('_method', 'PUT');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        
        // Submit via AJAX
        const url = window.location.pathname + '/' + state.currentItem;
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal();
                location.reload();
            } else {
                alert('Gagal mengupdate data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
    
    // Confirm Delete
    function confirmDelete() {
        const formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        
        const url = window.location.pathname + '/' + state.currentItem;
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal();
                location.reload();
            } else {
                alert('Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
    
    // Open Modal
    function openModal() {
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    // Close Modal
    function closeModal() {
        modalOverlay.classList.remove('active');
        document.body.style.overflow = '';
        state.currentItem = null;
        state.modalType = null;
    }
    
    // Public API
    window.CRUDModal = {
        close: closeModal,
        submitCreate: submitCreate,
        submitEdit: submitEdit,
        confirmDelete: confirmDelete
    };
    
    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
})();
