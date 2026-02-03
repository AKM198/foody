<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $fillable = [
        'section_name',
        'title',
        'content',
        'current_img',
        'prev_img_1',
        'prev_img_2',
        'prev_img_3',
        'prev_img_4'
    ];
    
    public function addNewImage($newImagePath)
    {
        // Shift previous images
        $this->prev_img_4 = $this->prev_img_3;
        $this->prev_img_3 = $this->prev_img_2;
        $this->prev_img_2 = $this->prev_img_1;
        $this->prev_img_1 = $this->current_img;
        $this->current_img = $newImagePath;
        $this->save();
    }
    
    public function switchToPrevious($prevIndex)
    {
        $prevField = 'prev_img_' . $prevIndex;
        if ($this->$prevField) {
            $temp = $this->current_img;
            $this->current_img = $this->$prevField;
            $this->$prevField = $temp;
            $this->save();
        }
    }
    
    public function getPreviousImages()
    {
        return array_filter([
            1 => $this->prev_img_1,
            2 => $this->prev_img_2,
            3 => $this->prev_img_3,
            4 => $this->prev_img_4
        ]);
    }
}