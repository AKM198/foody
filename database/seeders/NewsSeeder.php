<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::create([
            'title' => 'Homemade Comfort Food Goes Viral on TikTok',
            'content' => 'Our authentic homemade recipes are taking TikTok by storm! Watch how we prepare traditional comfort meals using simple, everyday ingredients that bring families together.',
            'category' => 'trending',
            'image_path' => 'assets/images/news1.jpg',
            'published_date' => now()
        ]);

        News::create([
            'title' => 'Street Food Culture: Bringing Authentic Flavors Home',
            'content' => 'Discover the art of recreating beloved street food classics in your own kitchen. Our latest feature showcases how everyday cooks are mastering traditional recipes.',
            'category' => 'tips & tricks',
            'image_path' => 'assets/images/news2.jpg',
            'published_date' => now()->subDays(2)
        ]);

        News::create([
            'title' => 'Real Home Cooking: Stories from Everyday Kitchens',
            'content' => 'Join us as we explore authentic home cooking stories from real families. See how simple ingredients transform into memorable meals that connect generations.',
            'category' => 'inspiration',
            'image_path' => 'assets/images/news3.jpg',
            'published_date' => now()->subDays(5)
        ]);

        News::create([
            'title' => 'Traditional Recipes Making a Comeback',
            'content' => 'Grandmother\'s recipes are trending again as people seek authentic, homemade flavors in their daily meals.',
            'category' => 'trending',
            'image_path' => 'assets/images/news4.jpg',
            'published_date' => now()->subDays(7)
        ]);

        News::create([
            'title' => 'Healthy Home Cooking Tips for Busy Families',
            'content' => 'Learn how to prepare nutritious, homemade meals even with a busy schedule using these simple cooking techniques.',
            'category' => 'tips & tricks',
            'image_path' => 'assets/images/news5.jpg',
            'published_date' => now()->subDays(10)
        ]);

        News::create([
            'title' => 'The Art of Slow Cooking: Patience in the Kitchen',
            'content' => 'Discover how slow cooking methods can transform simple ingredients into extraordinary homemade dishes.',
            'category' => 'inspiration',
            'image_path' => 'assets/images/news6.jpg',
            'published_date' => now()->subDays(12)
        ]);
    }
}
