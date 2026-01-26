<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_name',
        'section_name',
        'image_path',
        'alt_text'
    ];
}