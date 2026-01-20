<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
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

    public function getImageUrlAttribute()
    {
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
