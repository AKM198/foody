<?php

namespace App\Models\Concerns;

use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;

trait HasImages
{
    /**
     * Get all images for this model.
     */
    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * Get only visible images.
     */
    public function visibleImages(): Collection
    {
        return $this->images()->visible()->get();
    }

    /**
     * Get the primary image.
     */
    public function primaryImage(): ?Image
    {
        return $this->images()->primary()->visible()->first();
    }

    /**
     * Get the first visible image (fallback if no primary).
     */
    public function getFirstVisibleImage(): ?Image
    {
        $primary = $this->primaryImage();
        if ($primary) {
            return $primary;
        }

        return $this->images()->visible()->first();
    }

    /**
     * Add an image to this model.
     */
    public function addImage(
        $file,
        ?string $altText = null,
        ?string $title = null,
        ?string $context = 'other',
        bool $isPrimary = false
    ): Image {
        $imageService = app(\App\Services\ImageService::class);
        
        return $imageService->uploadForModel(
            $file,
            $this,
            $this->getImageCategory(),
            $context,
            $altText,
            $title,
            auth('admin')->id(),
            $isPrimary
        );
    }

    /**
     * Replace an existing image.
     */
    public function replaceImage(Image $oldImage, $file): Image
    {
        $imageService = app(\App\Services\ImageService::class);
        
        return $imageService->replaceImage(
            $oldImage,
            $file,
            auth('admin')->id()
        );
    }

    /**
     * Remove an image from this model.
     */
    public function removeImage(Image $image): bool
    {
        $imageService = app(\App\Services\ImageService::class);
        return $imageService->delete($image);
    }

    /**
     * Get the image category for this model.
     * Override in models to specify custom category.
     */
    protected function getImageCategory(): string
    {
        return 'general';
    }

    /**
     * Get image URL for display (with fallback).
     */
    public function getImageUrlAttribute(): string
    {
        $image = $this->getFirstVisibleImage();
        
        if ($image) {
            return $image->url;
        }

        // Fallback to old method if exists
        if (isset($this->attributes['image_path']) && $this->attributes['image_path']) {
            return asset($this->attributes['image_path']);
        }

        if (isset($this->attributes['image']) && $this->attributes['image']) {
            return asset('assets/images/' . $this->attributes['image']);
        }

        return asset('assets/images/placeholder.png');
    }

    /**
     * Get thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): string
    {
        $image = $this->getFirstVisibleImage();
        
        if ($image) {
            return $image->url;
        }

        return $this->image_url;
    }
}
