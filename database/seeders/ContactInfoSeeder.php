<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PageContent;

class ContactInfoSeeder extends Seeder
{
    public function run(): void
    {
        $contactData = [
            [
                'page_name' => 'contact',
                'section_name' => 'address',
                'content_type' => 'text',
                'content_value' => "Jl. Babakan Jeruk II No.9, Pasteur\nKec. Sukajadi, Kota Bandung\nJawa Barat 40161"
            ],
            [
                'page_name' => 'contact',
                'section_name' => 'phone',
                'content_type' => 'text',
                'content_value' => '+62 822-1234-5678'
            ],
            [
                'page_name' => 'contact',
                'section_name' => 'email',
                'content_type' => 'text',
                'content_value' => 'info@foody.com'
            ],
            [
                'page_name' => 'contact',
                'section_name' => 'map_url',
                'content_type' => 'url',
                'content_value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d300.72595531967187!2d107.66393355737362!3d-6.943197775870065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7c381e3c323%3A0x5f5160f6c9796e4b!2sCYBERLABS%20-%20Jasa%20Digital%20Marketing%20%7C%20Jasa%20Pembuatan%20Website%20%7C%20Jasa%20Pembuatan%20Aplikasi!5e0!3m2!1sid!2sid!4v1768879182825!5m2!1sid!2sid'
            ]
        ];

        foreach ($contactData as $data) {
            PageContent::updateOrCreate(
                [
                    'page_name' => $data['page_name'],
                    'section_name' => $data['section_name']
                ],
                [
                    'content_type' => $data['content_type'],
                    'content_value' => $data['content_value']
                ]
            );
        }
    }
}