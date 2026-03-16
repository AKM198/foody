<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageService
{
    /**
     * Default configuration
     */
    protected array $config = [
        'max_file_size' => 5242880, // 5MB
        'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'],
        'allowed_mime_types' => [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/bmp',
            'image/svg+xml'
        ],
        'storage_disk' => 'public',
        'storage_path' => 'images',
    ];

    /**
     * Upload a new image and create metadata record.
     */
    public function upload(
        UploadedFile $file,
        ?string $category = 'general',
        ?string $context = 'other',
        ?string $altText = null,
        ?string $title = null,
        ?int $uploadedBy = null,
        ?string $caption = null,
        bool $isVisible = true,
        bool $isPrimary = false,
        int $sortOrder = 0
    ): Image {
        // Validate the file first
        $this->validateImage($file);

        // Generate unique filename
        $filename = $this->generateFilename($file);
        
        // Determine storage path
        $datePath = date('Y/m');
        $fullPath = $this->config['storage_path'] . '/' . $datePath;
        
        // Store the file
        $storedPath = $this->storeFile($file, $filename, $fullPath);
        
        // Get image dimensions using Intervention Image
        $imageInfo = $this->getImageInfo(Storage::disk($this->config['storage_disk'])->path($storedPath));
        
        // Create the image record
        $image = Image::create([
            'filename' => $filename,
            'path' => $storedPath,
            'url' => $this->generateUrl($storedPath),
            'extension' => strtolower($file->getClientOriginalExtension()),
            'mime_type' => $file->getMimeType(),
            'width' => $imageInfo['width'] ?? null,
            'height' => $imageInfo['height'] ?? null,
            'file_size' => $file->getSize(),
            'alt_text' => $altText ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'title' => $title ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'caption' => $caption,
            'category' => $category,
            'context' => $context,
            'is_visible' => $isVisible,
            'is_primary' => $isPrimary,
            'sort_order' => $sortOrder,
            'uploaded_by' => $uploadedBy
        ]);

        return $image;
    }

    /**
     * Upload image and associate with a polymorphic model.
     */
    public function uploadForModel(
        UploadedFile $file,
        $model,
        ?string $category = null,
        ?string $context = 'other',
        ?string $altText = null,
        ?string $title = null,
        ?int $uploadedBy = null,
        bool $isPrimary = false
    ): Image {
        // Determine category from model if not provided
        if ($category === null) {
            $category = $this->getCategoryFromModel($model);
        }

        $image = $this->upload(
            $file,
            $category,
            $context,
            $altText,
            $title,
            $uploadedBy,
            null,
            true,
            $isPrimary
        );

        // Associate with model
        $image->imageable()->associate($model);
        $image->save();

        return $image;
    }

    /**
     * Validate uploaded image.
     */
    public function validateImage(UploadedFile $file): array
    {
        $errors = [];

        // Check file size
        if ($file->getSize() > $this->config['max_file_size']) {
            $errors[] = 'File size exceeds maximum allowed size of ' . 
                round($this->config['max_file_size'] / 1048576, 2) . 'MB';
        }

        // Check extension
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $this->config['allowed_extensions'])) {
            $errors[] = 'File extension "' . $extension . '" is not allowed. Allowed: ' . 
                implode(', ', $this->config['allowed_extensions']);
        }

        // Check MIME type
        $mimeType = $file->getMimeType();
        if (!in_array($mimeType, $this->config['allowed_mime_types'])) {
            $errors[] = 'File MIME type "' . $mimeType . '" is not allowed.';
        }

        // Check if file is valid image
        if (!$file->isValid()) {
            $errors[] = 'File is not valid or corrupted.';
        }

        // Try to get image info to verify it's a real image
        try {
            $imageInfo = @getimagesize($file->getPathname());
            if (!$imageInfo) {
                $errors[] = 'Cannot read image dimensions. File may be corrupted.';
            }
        } catch (\Exception $e) {
            $errors[] = 'Cannot process this file as an image: ' . $e->getMessage();
        }

        if (!empty($errors)) {
            return [
                'valid' => false,
                'errors' => $errors
            ];
        }

        return ['valid' => true, 'errors' => []];
    }

    /**
     * Get validation rules for image upload.
     */
    public function getValidationRules(): array
    {
        return [
            'image' => 'required|image|mimes:' . implode(',', $this->config['allowed_extensions'])
                . '|max:' . round($this->config['max_file_size'] / 1024),
            'alt_text' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:50',
            'context' => 'nullable|string|max:50',
            'is_visible' => 'nullable|boolean',
            'is_primary' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0'
        ];
    }

    /**
     * Get validation messages in Indonesian.
     */
    public function getValidationMessages(): array
    {
        $maxSizeKB = round($this->config['max_file_size'] / 1024);
        $extensions = implode(', ', $this->config['allowed_extensions']);

        return [
            'image.required' => 'Gambar wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar tidak didukung. Format yang diperbolehkan: ' . $extensions,
            'image.max' => 'Ukuran gambar terlalu besar. Maksimal ' . $maxSizeKB . 'KB.',
            'alt_text.max' => 'Alt text maksimal 255 karakter.',
            'title.max' => 'Title maksimal 255 karakter.',
            'caption.max' => 'Caption maksimal 500 karakter.',
            'category.max' => 'Category maksimal 50 karakter.',
            'context.max' => 'Context maksimal 50 karakter.',
            'sort_order.integer' => 'Sort order harus berupa angka.',
            'sort_order.min' => 'Sort order tidak boleh negatif.'
        ];
    }

    /**
     * Delete image and its file.
     */
    public function delete(Image $image): bool
    {
        // Delete file from storage
        $this->deleteFile($image->path);
        
        // Delete database record
        $image->delete();
        
        return true;
    }

    /**
     * Delete image file from storage.
     */
    public function deleteFile(string $path): bool
    {
        if (Storage::disk($this->config['storage_disk'])->exists($path)) {
            return Storage::disk($this->config['storage_disk'])->delete($path);
        }
        return false;
    }

    /**
     * Update image metadata.
     */
    public function updateMetadata(
        Image $image,
        ?string $altText = null,
        ?string $title = null,
        ?string $caption = null,
        ?string $category = null,
        ?string $context = null,
        ?bool $isVisible = null,
        ?bool $isPrimary = null,
        ?int $sortOrder = null
    ): Image {
        $updateData = [];

        if ($altText !== null) {
            $updateData['alt_text'] = $altText;
        }
        if ($title !== null) {
            $updateData['title'] = $title;
        }
        if ($caption !== null) {
            $updateData['caption'] = $caption;
        }
        if ($category !== null) {
            $updateData['category'] = $category;
        }
        if ($context !== null) {
            $updateData['context'] = $context;
        }
        if ($isVisible !== null) {
            $updateData['is_visible'] = $isVisible;
        }
        if ($isPrimary !== null && $isPrimary) {
            $image->setAsPrimary();
        }
        if ($sortOrder !== null) {
            $updateData['sort_order'] = $sortOrder;
        }

        $image->update($updateData);
        return $image;
    }

    /**
     * Toggle image visibility.
     */
    public function toggleVisibility(Image $image): Image
    {
        $image->toggleVisibility();
        return $image;
    }

    /**
     * Replace existing image for a model.
     */
    public function replaceImage(
        Image $oldImage,
        UploadedFile $newFile,
        ?int $uploadedBy = null
    ): Image {
        // Get old image metadata for preservation
        $category = $oldImage->category;
        $context = $oldImage->context;
        $altText = $oldImage->alt_text;
        $title = $oldImage->title;
        $isPrimary = $oldImage->is_primary;
        $sortOrder = $oldImage->sort_order;
        $model = $oldImage->imageable;

        // Delete old image
        $this->delete($oldImage);

        // Upload new image
        if ($model) {
            return $this->uploadForModel(
                $newFile,
                $model,
                $category,
                $context,
                $altText,
                $title,
                $uploadedBy,
                $isPrimary
            );
        }

        return $this->upload(
            $newFile,
            $category,
            $context,
            $altText,
            $title,
            $uploadedBy,
            null,
            true,
            $isPrimary,
            $sortOrder
        );
    }

    /**
     * Get images by category.
     */
    public function getByCategory(string $category, bool $visibleOnly = true): \Illuminate\Database\Eloquent\Collection
    {
        $query = Image::category($category);
        
        if ($visibleOnly) {
            $query->visible();
        }
        
        return $query->orderBy('sort_order')->get();
    }

    /**
     * Get images for a specific model.
     */
    public function getForModel($model, bool $visibleOnly = true): \Illuminate\Database\Eloquent\Collection
    {
        return Image::forModel($model, $visibleOnly);
    }

    /**
     * Get primary image for a model.
     */
    public function getPrimaryForModel($model): ?Image
    {
        return Image::primaryForModel($model);
    }

    /**
     * Register existing image from path (for images already in storage).
     */
    public function registerExistingImage(
        string $path,
        ?string $category = 'general',
        ?string $context = 'other',
        ?string $altText = null,
        ?string $title = null,
        ?int $uploadedBy = null
    ): ?Image {
        // Check if file exists
        if (!Storage::disk($this->config['storage_disk'])->exists($path)) {
            return null;
        }

        // Get file info
        $fullPath = Storage::disk($this->config['storage_disk'])->path($path);
        $filename = basename($path);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Get image dimensions
        $imageInfo = $this->getImageInfo($fullPath);
        
        // Get file size
        $fileSize = filesize($fullPath);

        // Create the image record
        return Image::create([
            'filename' => $filename,
            'path' => $path,
            'url' => $this->generateUrl($path),
            'extension' => strtolower($extension),
            'mime_type' => $this->getMimeType($extension),
            'width' => $imageInfo['width'] ?? null,
            'height' => $imageInfo['height'] ?? null,
            'file_size' => $fileSize,
            'alt_text' => $altText ?? pathinfo($filename, PATHINFO_FILENAME),
            'title' => $title ?? pathinfo($filename, PATHINFO_FILENAME),
            'category' => $category,
            'context' => $context,
            'is_visible' => true,
            'is_primary' => false,
            'sort_order' => 0,
            'uploaded_by' => $uploadedBy
        ]);
    }

    /**
     * Get all allowed extensions as string for validation.
     */
    public function getAllowedExtensionsString(): string
    {
        return implode(',', $this->config['allowed_extensions']);
    }

    /**
     * Get all allowed MIME types.
     */
    public function getAllowedMimeTypes(): array
    {
        return $this->config['allowed_mime_types'];
    }

    /**
     * Get maximum file size in KB.
     */
    public function getMaxFileSizeKB(): int
    {
        return round($this->config['max_file_size'] / 1024);
    }

    /**
     * Generate unique filename.
     */
    protected function generateFilename(UploadedFile $file): string
    {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($originalName);
        
        return $slug . '_' . time() . '_' . Str::random(8) . '.' . $extension;
    }

    /**
     * Store file to disk.
     */
    protected function storeFile(UploadedFile $file, string $filename, string $path): string
    {
        return $file->storeAs($path, $filename, $this->config['storage_disk']);
    }

    /**
     * Generate public URL for the image.
     */
    protected function generateUrl(string $path): string
    {
        // For public disk, we can use asset() directly
        return asset($path);
    }

    /**
     * Get image dimensions and info.
     */
    protected function getImageInfo(string $filePath): array
    {
        try {
            // Try using getimagesize (PHP built-in)
            if ($info = @getimagesize($filePath)) {
                return [
                    'width' => $info[0],
                    'height' => $info[1],
                ];
            }
            
            // Fallback: try to create image resource to get dimensions
            $image = $this->createImageFromFile($filePath);
            if ($image) {
                $width = imagesx($image);
                $height = imagesy($image);
                imagedestroy($image);
                return [
                    'width' => $width,
                    'height' => $height,
                ];
            }
            
            return [
                'width' => null,
                'height' => null,
            ];
        } catch (\Exception $e) {
            return [
                'width' => null,
                'height' => null,
            ];
        }
    }

    /**
     * Create image resource from file.
     */
    protected function createImageFromFile(string $filePath)
    {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                return @imagecreatefromjpeg($filePath);
            case 'png':
                return @imagecreatefrompng($filePath);
            case 'gif':
                return @imagecreatefromgif($filePath);
            case 'webp':
                return function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($filePath) : null;
            case 'bmp':
                return function_exists('imagecreatefrombmp') ? @imagecreatefrombmp($filePath) : null;
            default:
                return null;
        }
    }

    /**
     * Get MIME type from extension.
     */
    protected function getMimeType(string $extension): string
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'bmp' => 'image/bmp',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
        ];

        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }

    /**
     * Determine category from model class.
     */
    protected function getCategoryFromModel($model): string
    {
        $className = class_basename($model);
        
        $categoryMap = [
            'News' => 'news',
            'Gallery' => 'gallery',
            'Product' => 'product',
            'About' => 'about',
            'Contact' => 'contact',
            'HomeSection' => 'general',
            'AboutSection' => 'about',
            'PageImage' => 'general',
        ];

        return $categoryMap[$className] ?? 'general';
    }

    /**
     * Set custom configuration.
     */
    public function setConfig(array $config): self
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }
}
