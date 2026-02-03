<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'section_name',
        'title',
        'content',
        'current_img',
        'current_img_2',
        'prev_img_1',
        'prev_img_2',
        'prev_img_3',
        'prev_img_4',
        'prev_img_2_1',
        'prev_img_2_2',
        'prev_img_2_3',
        'prev_img_2_4'
    ];
    
    // Disable timestamps if causing issues
    public $timestamps = true;
    
    public function addNewImage($newImagePath, $imageType = 1)
    {
        if ($imageType == 2) {
            // Shift previous images for second image
            $this->prev_img_2_4 = $this->prev_img_2_3;
            $this->prev_img_2_3 = $this->prev_img_2_2;
            $this->prev_img_2_2 = $this->prev_img_2_1;
            $this->prev_img_2_1 = $this->current_img_2;
            $this->current_img_2 = $newImagePath;
        } else {
            // Shift previous images for first image
            $this->prev_img_4 = $this->prev_img_3;
            $this->prev_img_3 = $this->prev_img_2;
            $this->prev_img_2 = $this->prev_img_1;
            $this->prev_img_1 = $this->current_img;
            $this->current_img = $newImagePath;
        }
        $this->save();
    }
    
    public function switchToPrevious($prevIndex, $imageType = 1)
    {
        if ($imageType == 2) {
            $prevField = 'prev_img_2_' . $prevIndex;
            $currentField = 'current_img_2';
        } else {
            $prevField = 'prev_img_' . $prevIndex;
            $currentField = 'current_img';
        }
        
        if ($this->$prevField) {
            $temp = $this->$currentField;
            $this->$currentField = $this->$prevField;
            $this->$prevField = $temp;
            $this->save();
        }
    }
    
    public function getPreviousImages($imageType = 1)
    {
        if ($imageType == 2) {
            return array_filter([
                1 => $this->prev_img_2_1,
                2 => $this->prev_img_2_2,
                3 => $this->prev_img_2_3,
                4 => $this->prev_img_2_4
            ]);
        } else {
            return array_filter([
                1 => $this->prev_img_1,
                2 => $this->prev_img_2,
                3 => $this->prev_img_3,
                4 => $this->prev_img_4
            ]);
        }
    }
}