<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImageHistory extends Model
{
    use HasFactory;

    protected $table = 'page_image_history';

    protected $fillable = [
        'page_name',
        'section_name',
        'image_path',
        'alt_text',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}