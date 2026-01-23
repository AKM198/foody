<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [
            // Home Page Content
            [
                'page_name' => 'home',
                'section_name' => 'hero_title',
                'content_value' => 'HEALTHY TASTY FOOD'
            ],
            [
                'page_name' => 'home',
                'section_name' => 'hero_description',
                'content_value' => 'Nikmati kelezatan makanan sehat yang disiapkan dengan bahan-bahan segar pilihan terbaik. Kami menghadirkan cita rasa autentik yang memanjakan lidah sambil menjaga kesehatan tubuh Anda. Setiap hidangan dibuat dengan penuh perhatian untuk memberikan nutrisi optimal bagi keluarga.'
            ],
            [
                'page_name' => 'home',
                'section_name' => 'tentang_description',
                'content_value' => 'Tasty Food hadir sebagai solusi terpercaya untuk kebutuhan makanan sehat dan bergizi keluarga Indonesia. Dengan komitmen menggunakan bahan-bahan segar berkualitas tinggi, kami menghadirkan berbagai pilihan hidangan lezat yang tidak hanya memanjakan lidah tetapi juga memberikan nutrisi terbaik untuk kesehatan optimal.'
            ],
            
            // About Page Content
            [
                'page_name' => 'about',
                'section_name' => 'header_title',
                'content_value' => 'TENTANG KAMI'
            ],
            [
                'page_name' => 'about',
                'section_name' => 'tasty_food_content',
                'content_value' => 'Tasty Food adalah perusahaan yang bergerak di bidang kuliner dengan fokus pada penyediaan makanan sehat dan bergizi. Didirikan dengan visi untuk menghadirkan solusi makanan terbaik bagi keluarga Indonesia, kami berkomitmen untuk selalu menggunakan bahan-bahan segar berkualitas tinggi dalam setiap hidangan yang kami sajikan.'
            ],
            [
                'page_name' => 'about',
                'section_name' => 'visi_content',
                'content_value' => 'Menjadi perusahaan kuliner terdepan di Indonesia yang menghadirkan makanan sehat, lezat, dan bergizi untuk mendukung gaya hidup sehat masyarakat Indonesia.'
            ],
            [
                'page_name' => 'about',
                'section_name' => 'misi_content',
                'content_value' => 'Menyediakan makanan berkualitas tinggi dengan bahan-bahan segar pilihan. Menghadirkan inovasi dalam bidang kuliner sehat. Memberikan pelayanan terbaik kepada setiap pelanggan. Mendukung gaya hidup sehat masyarakat Indonesia.'
            ]
        ];
        
        foreach ($contents as $content) {
            PageContent::updateOrCreate(
                ['page_name' => $content['page_name'], 'section_name' => $content['section_name']],
                ['content_value' => $content['content_value']]
            );
        }
    }
}
