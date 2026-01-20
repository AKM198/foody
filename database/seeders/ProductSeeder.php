<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Healthy Products
        Product::create([
            'name' => 'Fresh Green Salad Bowl',
            'description' => 'Nutritious mixed greens with organic vegetables, perfect for a healthy lifestyle.',
            'category' => 'healthy',
            'price' => 25000,
            'image_path' => 'assets/images/healty1.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Organic Smoothie Bowl',
            'description' => 'Antioxidant-rich smoothie bowl topped with fresh fruits and nuts.',
            'category' => 'healthy',
            'price' => 35000,
            'image_path' => 'assets/images/healty2.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Quinoa Power Bowl',
            'description' => 'Protein-packed quinoa bowl with seasonal vegetables and herbs.',
            'category' => 'healthy',
            'price' => 40000,
            'image_path' => 'assets/images/healty3.png',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Avocado Toast Deluxe',
            'description' => 'Whole grain toast topped with fresh avocado and microgreens.',
            'category' => 'healthy',
            'price' => 30000,
            'image_path' => 'assets/images/healty4.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Mediterranean Wrap',
            'description' => 'Healthy wrap filled with fresh vegetables and lean protein.',
            'category' => 'healthy',
            'price' => 32000,
            'image_path' => 'assets/images/healty5.jpg',
            'is_available' => true
        ]);

        // Street Food Products
        Product::create([
            'name' => 'Authentic Satay Skewers',
            'description' => 'Traditional grilled meat skewers with homemade peanut sauce.',
            'category' => 'street',
            'price' => 20000,
            'image_path' => 'assets/images/street1.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Crispy Fried Chicken',
            'description' => 'Golden crispy fried chicken with special street-style seasoning.',
            'category' => 'street',
            'price' => 28000,
            'image_path' => 'assets/images/street2.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Spicy Noodle Bowl',
            'description' => 'Street-style spicy noodles with fresh vegetables and herbs.',
            'category' => 'street',
            'price' => 22000,
            'image_path' => 'assets/images/street3.png',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Grilled Corn Special',
            'description' => 'Charcoal-grilled corn with butter and traditional spices.',
            'category' => 'street',
            'price' => 15000,
            'image_path' => 'assets/images/street4.jpg',
            'is_available' => true
        ]);

        // Homemade Products
        Product::create([
            'name' => 'Grandma\'s Beef Stew',
            'description' => 'Traditional slow-cooked beef stew with root vegetables.',
            'category' => 'homemade',
            'price' => 45000,
            'image_path' => 'assets/images/homemade1.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Homestyle Fried Rice',
            'description' => 'Classic fried rice made with love and family recipe.',
            'category' => 'homemade',
            'price' => 25000,
            'image_path' => 'assets/images/homemade2.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Mom\'s Chicken Curry',
            'description' => 'Aromatic chicken curry with traditional spices and coconut milk.',
            'category' => 'homemade',
            'price' => 38000,
            'image_path' => 'assets/images/homemade3.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Comfort Soup Bowl',
            'description' => 'Hearty homemade soup perfect for any weather.',
            'category' => 'homemade',
            'price' => 30000,
            'image_path' => 'assets/images/homemade4.jpg',
            'is_available' => true
        ]);

        Product::create([
            'name' => 'Traditional Pancakes',
            'description' => 'Fluffy homemade pancakes served with maple syrup.',
            'category' => 'homemade',
            'price' => 28000,
            'image_path' => 'assets/images/homemade5.jpg',
            'is_available' => true
        ]);
    }
}