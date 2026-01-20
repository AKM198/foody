<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'category',
        'is_available'
    ];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return $this->image_path;
    }

    protected $casts = [
        'price' => 'decimal:2'
    ];
}