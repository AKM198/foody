<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasImages;

class Product extends Model
{
    use HasFactory, HasImages;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'category',
        'is_available'
    ];

    protected $appends = ['image'];

    /**
     * Get the image category for Product.
     */
    protected function getImageCategory(): string
    {
        return $this->category === 'gallery' ? 'gallery' : 'product';
    }

    public function getImageAttribute()
    {
        return $this->image_path;
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
        
        return asset('assets/images/placeholder.png');
    }

    protected $casts = [
        'price' => 'decimal:2'
    ];
}