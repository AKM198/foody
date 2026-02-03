<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageImage;

class DefaultMenuImagesSeeder extends Seeder
{
    public function run()
    {
        $defaultImages = [
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_1',
                'image_path' => 'assets/images/healty1.png',
                'alt_text' => 'Makanan Sehat'
            ],
            [
                'page_name' => 'home', 
                'section_name' => 'menu_card_2',
                'image_path' => 'assets/images/healty2.png',
                'alt_text' => 'Makanan Segar'
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_3', 
                'image_path' => 'assets/images/healty3.png',
                'alt_text' => 'Makanan Bergizi'
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_4',
                'image_path' => 'assets/images/street3.png', 
                'alt_text' => 'Makanan Lezat'
            ]
        ];

        foreach ($defaultImages as $image) {
            PageImage::firstOrCreate(
                [
                    'page_name' => $image['page_name'],
                    'section_name' => $image['section_name']
                ],
                [
                    'image_path' => $image['image_path'],
                    'alt_text' => $image['alt_text']
                ]
            );
        }
    }
}