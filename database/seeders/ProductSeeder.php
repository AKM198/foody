<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Salmon Bowl',
                'description' => 'Fresh salmon with quinoa and vegetables',
                'category' => 'Main Course',
                'price' => 25.99,
                'image_path' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Buddha Bowl',
                'description' => 'Healthy mix of grains and fresh vegetables',
                'category' => 'Healthy',
                'price' => 18.99,
                'image_path' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Breakfast Skillet',
                'description' => 'Pan-fried breakfast with eggs and vegetables',
                'category' => 'Breakfast',
                'price' => 22.50,
                'image_path' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Fruit Parfait',
                'description' => 'Layered yogurt with fresh fruits and granola',
                'category' => 'Dessert',
                'price' => 12.99,
                'image_path' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Avocado Toast',
                'description' => 'Artisan bread with fresh avocado and toppings',
                'category' => 'Breakfast',
                'price' => 15.99,
                'image_path' => 'https://images.unsplash.com/photo-1541519227354-08fa5d50c44d?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Quinoa Salad',
                'description' => 'Nutritious quinoa with mixed vegetables',
                'category' => 'Healthy',
                'price' => 16.50,
                'image_path' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Grilled Chicken',
                'description' => 'Tender grilled chicken with herbs',
                'category' => 'Main Course',
                'price' => 28.99,
                'image_path' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=400&h=300&fit=crop',
                'is_available' => true
            ],
            [
                'name' => 'Smoothie Bowl',
                'description' => 'Thick smoothie topped with fresh fruits',
                'category' => 'Healthy',
                'price' => 14.99,
                'image_path' => 'https://images.unsplash.com/photo-1511690743698-d9d85f2fbf38?w=400&h=300&fit=crop',
                'is_available' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}