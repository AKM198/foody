<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'filename',
        'path',
        'url',
        'extension',
        'mime_type',
        'width',
        'height',
        'file_size',
        'alt_text',
        'title',
        'caption',
        'category',
        'context',
        'imageable_id',
        'imageable_type',
        'is_visible',
        'is_primary',
        'sort_order',
        'uploaded_by'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_visible' => 'boolean',
        'is_primary' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'file_size' => 'integer',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Allowed image extensions/mime types for validation
     */
    public const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg', 'ico'];

    public const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/bmp',
        'image/svg+xml',
        'image/x-icon'
    ];

    /**
     * Default image categories
     */
    public const CATEGORIES = [
        'news' => 'News/Berita',
        'gallery' => 'Gallery/Galeri',
        'product' => 'Product/Produk',
        'banner' => 'Banner',
        'hero' => 'Hero Image',
        'thumbnail' => 'Thumbnail',
        'about' => 'About/Tentang',
        'contact' => 'Contact/Kontak',
        'profile' => 'Profile',
        'logo' => 'Logo',
        'favicon' => 'Favicon',
        'general' => 'General/Umum'
    ];

    /**
     * Image contexts/usage
     */
    public const CONTEXTS = [
        'hero' => 'Hero Section',
        'banner' => 'Banner',
        'featured' => 'Featured',
        'thumbnail' => 'Thumbnail',
        'slider' => 'Slider',
        'card' => 'Card Image',
        'background' => 'Background',
        'logo' => 'Logo',
        'icon' => 'Icon',
        'content' => 'Content Image',
        'other' => 'Other'
    ];

    /**
     * Get the admin who uploaded the image.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'uploaded_by');
    }

    /**
     * Get the parent imageable model (polymorphic).
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope to get only visible images.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    /**
     * Scope to get images by category.
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get primary images.
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope to filter by context.
     */
    public function scopeContext($query, string $context)
    {
        return $query->where('context', $context);
    }

    /**
     * Get the full URL to the image.
     */
    public function getFullUrlAttribute(): string
    {
        return asset($this->path);
    }

    /**
     * Get formatted file size (KB/MB).
     */
    public function getFormattedSizeAttribute(): string
    {
        if (!$this->file_size) {
            return 'N/A';
        }

        if ($this->file_size < 1024) {
            return $this->file_size . ' B';
        } elseif ($this->file_size < 1048576) {
            return round($this->file_size / 1024, 2) . ' KB';
        } else {
            return round($this->file_size / 1048576, 2) . ' MB';
        }
    }

    /**
     * Get dimensions string (e.g., "1920x1080").
     */
    public function getDimensionsAttribute(): string
    {
        if ($this->width && $this->height) {
            return $this->width . 'x' . $this->height;
        }
        return 'N/A';
    }

    /**
     * Check if the image is an allowed type.
     */
    public function isAllowedType(): bool
    {
        return in_array(strtolower($this->extension), self::ALLOWED_EXTENSIONS);
    }

    /**
     * Check if the image is visible.
     */
    public function isVisible(): bool
    {
        return $this->is_visible;
    }

    /**
     * Toggle visibility status.
     */
    public function toggleVisibility(): self
    {
        $this->is_visible = !$this->is_visible;
        $this->save();
        return $this;
    }

    /**
     * Set as primary image for the imageable model.
     */
    public function setAsPrimary(): self
    {
        // Remove primary status from other images of the same imageable
        if ($this->imageable_id && $this->imageable_type) {
            self::where('imageable_id', $this->imageable_id)
                ->where('imageable_type', $this->imageable_type)
                ->where('id', '!=', $this->id)
                ->update(['is_primary' => false]);
        }

        $this->is_primary = true;
        $this->save();
        return $this;
    }

    /**
     * Get image info as array (for API responses).
     */
    public function toImageArray(): array
    {
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'path' => $this->path,
            'url' => $this->url,
            'extension' => $this->extension,
            'mime_type' => $this->mime_type,
            'width' => $this->width,
            'height' => $this->height,
            'dimensions' => $this->dimensions,
            'file_size' => $this->file_size,
            'formatted_size' => $this->formatted_size,
            'alt_text' => $this->alt_text,
            'title' => $this->title,
            'caption' => $this->caption,
            'category' => $this->category,
            'context' => $this->context,
            'is_visible' => $this->is_visible,
            'is_primary' => $this->is_primary,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString()
        ];
    }

    /**
     * Find image by filename.
     */
    public static function findByFilename(string $filename): ?self
    {
        return self::where('filename', $filename)->first();
    }

    /**
     * Find image by path.
     */
    public static function findByPath(string $path): ?self
    {
        return self::where('path', $path)->first();
    }

    /**
     * Get images for a specific model.
     */
    public static function forModel($model, bool $visibleOnly = true): \Illuminate\Database\Eloquent\Collection
    {
        $query = self::where('imageable_id', $model->id)
            ->where('imageable_type', get_class($model));

        if ($visibleOnly) {
            $query->visible();
        }

        return $query->orderBy('sort_order')->get();
    }

    /**
     * Get primary image for a specific model.
     */
    public static function primaryForModel($model): ?self
    {
        return self::where('imageable_id', $model->id)
            ->where('imageable_type', get_class($model))
            ->primary()
            ->visible()
            ->first();
    }
}
