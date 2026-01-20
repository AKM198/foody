<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        Gallery::create([
            'title' => 'Hearty Breakfast Bowl',
            'image' => 'brooke-lark-1Rm9GLHV0UA-unsplash.jpg',
            'description' => 'Start your day with this nourishing homemade breakfast bowl',
            'category' => 'Breakfast'
        ]);

        Gallery::create([
            'title' => 'Fresh Garden Salad',
            'image' => 'anna-pelzer-IGfIGP5ONV0-unsplash.jpg',
            'description' => 'Crisp vegetables straight from the garden to your table',
            'category' => 'Healthy Meals'
        ]);

        Gallery::create([
            'title' => 'Comfort Pasta Night',
            'image' => 'brooke-lark-nBtmglfY0HU-unsplash.jpg',
            'description' => 'Simple pasta made with love and everyday ingredients',
            'category' => 'Comfort Food'
        ]);

        Gallery::create([
            'title' => 'Artisan Bread',
            'image' => 'brooke-lark-oaz0raysASk-unsplash.jpg',
            'description' => 'Freshly baked bread made the traditional way',
            'category' => 'Baked Goods'
        ]);

        Gallery::create([
            'title' => 'Fresh Smoothie',
            'image' => 'eiliv-aceron-ZuIDLSz3XLg-unsplash.jpg',
            'description' => 'Refreshing fruit smoothie packed with natural goodness',
            'category' => 'Beverages'
        ]);

        Gallery::create([
            'title' => 'Colorful Veggie Prep',
            'image' => 'ella-olsson-mmnKI8kMxpc-unsplash.jpg',
            'description' => 'Fresh vegetables ready for your next homemade meal',
            'category' => 'Ingredients'
        ]);

        Gallery::create([
            'title' => 'Grilled Chicken Dinner',
            'image' => 'fathul-abrar-T-qI_MI2EMA-unsplash.jpg',
            'description' => 'Perfectly grilled chicken with herbs and spices',
            'category' => 'Main Course'
        ]);

        Gallery::create([
            'title' => 'Weekend Brunch',
            'image' => 'jimmy-dean-Jvw3pxgeiZw-unsplash.jpg',
            'description' => 'Leisurely weekend brunch made with care',
            'category' => 'Brunch'
        ]);

        Gallery::create([
            'title' => 'Farm Fresh Ingredients',
            'image' => 'jonathan-borba-Gkc_xM3VY34-unsplash.jpg',
            'description' => 'Quality ingredients sourced from local farms',
            'category' => 'Fresh Produce'
        ]);

        Gallery::create([
            'title' => 'Sweet Treats',
            'image' => 'luisa-brimble-HvXEbkcXjSk-unsplash.jpg',
            'description' => 'Homemade desserts that bring back childhood memories',
            'category' => 'Desserts'
        ]);

        Gallery::create([
            'title' => 'Cozy Soup Bowl',
            'image' => 'mariana-medvedeva-iNwCO9ycBlc-unsplash.jpg',
            'description' => 'Warming soup perfect for any season',
            'category' => 'Comfort Food'
        ]);

        Gallery::create([
            'title' => 'Nourishing Bowl',
            'image' => 'michele-blackwell-rAyCBQTH7ws-unsplash.jpg',
            'description' => 'Balanced meal bowl with wholesome ingredients',
            'category' => 'Healthy Meals'
        ]);
    }
}
