<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageImageHistory;

class PageImageHistorySeeder extends Seeder
{
    public function run()
    {
        // Initialize some default history for home page menu cards
        $homeImageHistory = [
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_1',
                'image_path' => 'assets/images/healty2.png',
                'alt_text' => 'Menu Card 1 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_1',
                'image_path' => 'assets/images/healty3.png',
                'alt_text' => 'Menu Card 1 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_2',
                'image_path' => 'assets/images/healty1.png',
                'alt_text' => 'Menu Card 2 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_2',
                'image_path' => 'assets/images/street3.png',
                'alt_text' => 'Menu Card 2 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_3',
                'image_path' => 'assets/images/healty1.png',
                'alt_text' => 'Menu Card 3 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_3',
                'image_path' => 'assets/images/healty2.png',
                'alt_text' => 'Menu Card 3 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_4',
                'image_path' => 'assets/images/healty1.png',
                'alt_text' => 'Menu Card 4 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'home',
                'section_name' => 'menu_card_4',
                'image_path' => 'assets/images/healty2.png',
                'alt_text' => 'Menu Card 4 Previous',
                'is_active' => false
            ]
        ];

        // Initialize some default history for about page images
        $aboutImageHistory = [
            [
                'page_name' => 'about',
                'section_name' => 'tasty_food_image_1',
                'image_path' => 'assets/images/cooking1.jpg',
                'alt_text' => 'Tasty Food Image 1 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'about',
                'section_name' => 'tasty_food_image_2',
                'image_path' => 'assets/images/homemade1.jpg',
                'alt_text' => 'Tasty Food Image 2 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'about',
                'section_name' => 'visi_image_1',
                'image_path' => 'assets/images/street1.jpg',
                'alt_text' => 'Visi Image 1 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'about',
                'section_name' => 'visi_image_2',
                'image_path' => 'assets/images/homemade2.jpg',
                'alt_text' => 'Visi Image 2 Previous',
                'is_active' => false
            ],
            [
                'page_name' => 'about',
                'section_name' => 'misi_image',
                'image_path' => 'assets/images/cooking1.jpg',
                'alt_text' => 'Misi Image Previous',
                'is_active' => false
            ]
        ];

        foreach (array_merge($homeImageHistory, $aboutImageHistory) as $history) {
            PageImageHistory::create($history);
        }
    }
}