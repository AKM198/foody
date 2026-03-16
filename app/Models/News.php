<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasImages;

class News extends Model
{
    use HasImages;

    protected $fillable = [
        'title',
        'content',
        'source',
        'image',
        'image_path',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    /**
     * Get the image category for News.
     */
    protected function getImageCategory(): string
    {
        return 'news';
    }

    public function getImageUrlAttribute()
    {
        // Try new image system first
        $image = $this->getFirstVisibleImage();
        if ($image) {
            return $image->url;
        }
        
        // Fallback to old method
        if ($this->image_path) {
            return asset($this->image_path);
        }
        if ($this->image) {
            return asset('assets/images/' . $this->image);
        }
        // Default fallback image
        return asset('assets/images/news1.jpg');
    }
}
