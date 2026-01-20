<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::create([
            'section' => 'visi',
            'title' => 'Visi Kami',
            'content' => 'Menjadi brand makanan terdepan yang melestarikan cita rasa autentik Indonesia dan memperkenalkan kuliner nusantara ke seluruh dunia.',
            'image' => 'visi.jpg'
        ]);

        About::create([
            'section' => 'misi',
            'title' => 'Misi Kami',
            'content' => 'Menyajikan makanan berkualitas tinggi dengan bahan-bahan pilihan, melestarikan resep tradisional, dan memberikan pengalaman kuliner yang tak terlupakan bagi setiap pelanggan.',
            'image' => 'misi.jpg'
        ]);

        About::create([
            'section' => 'sejarah',
            'title' => 'Sejarah Foody',
            'content' => 'Foody didirikan pada tahun 2020 dengan semangat untuk melestarikan kuliner Indonesia. Dimulai dari dapur rumahan, kini Foody telah menjadi brand yang dikenal luas melalui media sosial.',
            'image' => 'sejarah.jpg'
        ]);

        About::create([
            'section' => 'nilai',
            'title' => 'Nilai-Nilai Kami',
            'content' => 'Kualitas, Autentisitas, Inovasi, dan Kepuasan Pelanggan adalah empat pilar utama yang menjadi fondasi dalam setiap langkah perjalanan Foody.',
            'image' => 'nilai.jpg'
        ]);
    }
}
