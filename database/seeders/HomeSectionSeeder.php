<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSection;

class HomeSectionSeeder extends Seeder
{
    public function run()
    {
        $homeSections = [
            [
                'section_name' => 'header',
                'title' => 'HEALTHY',
                'content' => 'Nikmati kelezatan makanan sehat yang disiapkan dengan bahan-bahan segar pilihan terbaik. Kami menghadirkan cita rasa autentik yang memanjakan lidah sambil menjaga kesehatan tubuh Anda. Setiap hidangan dibuat dengan penuh perhatian untuk memberikan nutrisi optimal bagi keluarga.',
                'current_img' => 'assets/images/healty3.png'
            ],
            [
                'section_name' => 'tentang',
                'title' => 'TENTANG KAMI',
                'content' => 'Foody hadir sebagai solusi terpercaya untuk kebutuhan makanan sehat dan bergizi keluarga Indonesia. Dengan komitmen menggunakan bahan-bahan segar berkualitas tinggi, kami menghadirkan berbagai pilihan hidangan lezat yang tidak hanya memanjakan lidah tetapi juga memberikan nutrisi terbaik untuk kesehatan optimal.',
                'current_img' => null
            ],
            [
                'section_name' => 'menu_card_1',
                'title' => 'MAKANAN SEHAT',
                'content' => 'Hidangan bergizi tinggi yang diolah dengan teknik memasak modern untuk mempertahankan kandungan vitamin dan mineral alami.',
                'current_img' => 'assets/images/healty1.png'
            ],
            [
                'section_name' => 'menu_card_2',
                'title' => 'MAKANAN SEGAR',
                'content' => 'Bahan-bahan segar pilihan yang dipetik langsung dari kebun organik untuk menjamin kualitas dan kesegaran setiap hidangan.',
                'current_img' => 'assets/images/healty2.png'
            ],
            [
                'section_name' => 'menu_card_3',
                'title' => 'MAKANAN BERGIZI',
                'content' => 'Menu seimbang dengan kandungan protein, karbohidrat, dan vitamin yang tepat untuk mendukung gaya hidup sehat keluarga.',
                'current_img' => 'assets/images/healty3.png'
            ],
            [
                'section_name' => 'menu_card_4',
                'title' => 'MAKANAN LEZAT',
                'content' => 'Cita rasa autentik yang memadukan resep tradisional dengan sentuhan modern untuk pengalaman kuliner yang tak terlupakan.',
                'current_img' => 'assets/images/street3.png'
            ]
        ];

        foreach ($homeSections as $section) {
            HomeSection::firstOrCreate(
                ['section_name' => $section['section_name']],
                $section
            );
        }
    }
}