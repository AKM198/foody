<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Product;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        // Sample News Data
        $newsData = [
            [
                'title' => 'LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce scelerisque magna aliquet cursus tempus. Duis viverra metus et turpis elementum elementum. Aliquam rutrum placerat tellus et suscipit. Curabitur facilisis lectus vitae eros malesuada eleifend. Mauris eget tellus odio. Phasellus vestibulum turpis ac sem commodo, at posuere eros consequat.',
                'category' => 'food',
                'image_path' => 'assets/images/news1.jpg',
                'published_at' => now()
            ],
            [
                'title' => 'LOREM IPSUM',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,',
                'category' => 'recipe',
                'image_path' => 'assets/images/news2.jpg',
                'published_at' => now()
            ],
            [
                'title' => 'LOREM IPSUM',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,',
                'category' => 'healthy',
                'image_path' => 'assets/images/news3.jpg',
                'published_at' => now()
            ],
            [
                'title' => 'LOREM IPSUM',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,',
                'category' => 'cooking',
                'image_path' => 'assets/images/news4.jpg',
                'published_at' => now()
            ],
            [
                'title' => 'LOREM IPSUM',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ornare, augue eu rutrum commodo,',
                'category' => 'tips',
                'image_path' => 'assets/images/news5.jpg',
                'published_at' => now()
            ]
        ];

        foreach ($newsData as $news) {
            News::create($news);
        }

        // Sample Gallery Data
        $galleryData = [
            [
                'title' => 'Healthy Salad Bowl',
                'image' => 'healty1.png',
                'description' => 'Fresh and healthy salad bowl',
                'category' => 'healthy'
            ],
            [
                'title' => 'Grilled Salmon',
                'image' => 'healty2.png',
                'description' => 'Perfectly grilled salmon with vegetables',
                'category' => 'main-course'
            ],
            [
                'title' => 'Asian Noodles',
                'image' => 'healty3.png',
                'description' => 'Delicious Asian style noodles',
                'category' => 'asian'
            ],
            [
                'title' => 'Homemade Dish',
                'image' => 'homemade1.jpg',
                'description' => 'Traditional homemade cooking',
                'category' => 'traditional'
            ],
            [
                'title' => 'Breakfast Bowl',
                'image' => 'homemade2.jpg',
                'description' => 'Nutritious breakfast bowl',
                'category' => 'breakfast'
            ],
            [
                'title' => 'Dessert Parfait',
                'image' => 'homemade3.jpg',
                'description' => 'Sweet dessert parfait',
                'category' => 'dessert'
            ]
        ];

        foreach ($galleryData as $gallery) {
            Gallery::create($gallery);
        }

        // Sample Product Data for search functionality
        $productData = [
            [
                'name' => 'Healthy Salad Bowl',
                'description' => 'Fresh mixed greens with seasonal vegetables',
                'category' => 'salad',
                'price' => 45000,
                'image_path' => 'assets/images/product1.jpg',
                'is_available' => true
            ],
            [
                'name' => 'Grilled Salmon',
                'description' => 'Premium salmon grilled to perfection',
                'category' => 'main-course',
                'price' => 85000,
                'image_path' => 'assets/images/product2.jpg',
                'is_available' => true
            ],
            [
                'name' => 'Asian Noodle Soup',
                'description' => 'Traditional Asian noodle soup with rich broth',
                'category' => 'soup',
                'price' => 35000,
                'image_path' => 'assets/images/product3.jpg',
                'is_available' => true
            ],
            [
                'name' => 'Cheese Platter',
                'description' => 'Selection of artisanal cheeses with fruits',
                'category' => 'appetizer',
                'price' => 65000,
                'image_path' => 'assets/images/product4.jpg',
                'is_available' => true
            ]
        ];

        foreach ($productData as $product) {
            Product::create($product);
        }
    }
}