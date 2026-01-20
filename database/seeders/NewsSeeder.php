<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::create([
            'title' => 'Resep Masakan Sehat dan Bergizi untuk Keluarga',
            'content' => 'Memasak makanan sehat tidak harus rumit dan mahal. Dengan bahan-bahan segar dan teknik memasak yang tepat, Anda bisa menyajikan hidangan bergizi untuk keluarga tercinta. Tips memilih sayuran segar, protein berkualitas, dan cara mengolahnya agar nutrisi tetap terjaga. Mulai dari sarapan yang kaya serat, makan siang dengan protein seimbang, hingga makan malam yang ringan namun mengenyangkan. Pelajari juga cara menyimpan bahan makanan agar tetap fresh dan bergizi. Kombinasi warna-warni sayuran tidak hanya menarik mata tapi juga memberikan berbagai vitamin dan mineral yang dibutuhkan tubuh. Teknik memasak seperti mengukus, merebus, dan memanggang dapat mempertahankan kandungan gizi lebih baik dibanding menggoreng. Jangan lupa untuk selalu mencuci bahan makanan dengan bersih sebelum diolah. Dengan perencanaan menu yang baik, Anda dapat menghemat waktu dan biaya sambil tetap memberikan nutrisi terbaik untuk keluarga.',
            'image_path' => 'assets/images/cooking1.jpg',
            'category' => 'resep'
        ]);

        News::create([
            'title' => 'Teknik Memasak Modern untuk Chef Rumahan',
            'content' => 'Pelajari teknik memasak terkini yang digunakan chef profesional di dapur rumah Anda. Dari sous vide hingga molecular gastronomy, kini bisa dipraktikkan dengan peralatan sederhana. Teknik sous vide memungkinkan Anda memasak daging dengan tekstur yang sempurna dan rasa yang terjaga. Sementara teknik emulsifikasi dapat membuat saus yang creamy tanpa menggunakan krim berlebihan. Fermentasi rumahan juga semakin populer untuk membuat kimchi, kombucha, dan roti sourdough. Teknik smoking atau pengasapan bisa dilakukan di rumah untuk memberikan aroma dan rasa yang unik pada makanan. Confit, teknik memasak dengan lemak pada suhu rendah, menghasilkan tekstur yang lembut dan rasa yang mendalam. Spherification untuk membuat caviar palsu dari buah-buahan juga menjadi tren yang menarik. Dengan menguasai teknik-teknik ini, Anda dapat menghadirkan pengalaman fine dining di rumah sendiri.',
            'image_path' => 'assets/images/cooking2.jpg',
            'category' => 'tips'
        ]);

        News::create([
            'title' => 'Seni Plating Makanan Ala Restoran Mewah',
            'content' => 'Cara menyajikan makanan dengan presentasi yang menarik dan profesional seperti di restoran mewah kini bisa Anda terapkan di rumah. Plating bukan hanya soal penampilan, tapi juga tentang keseimbangan rasa, tekstur, dan warna dalam satu piring. Mulai dari pemilihan piring yang tepat, penggunaan saus sebagai elemen dekoratif, hingga penempatan garnish yang strategis. Teknik dots, swoosh, dan quenelle adalah beberapa cara dasar dalam plating profesional. Penggunaan microgreens, edible flowers, dan herb oil dapat memberikan sentuhan akhir yang elegan. Komposisi visual mengikuti rule of thirds, di mana elemen utama ditempatkan pada titik fokus tertentu. Height atau ketinggian dalam plating memberikan dimensi dan drama pada presentasi. Negative space atau ruang kosong dalam piring sama pentingnya dengan area yang terisi makanan. Dengan latihan dan kreativitas, setiap hidangan rumahan bisa tampil seperti karya seni yang menggugah selera.',
            'image_path' => 'assets/images/cooking3.jpg',
            'category' => 'tips'
        ]);

        News::create([
            'title' => 'Masakan Tradisional Indonesia yang Mendunia',
            'content' => 'Eksplorasi cita rasa nusantara dengan resep-resep tradisional yang telah turun temurun dan kini mulai dikenal dunia internasional. Rendang Padang yang telah dinobatkan sebagai makanan terlezat di dunia, gudeg Yogyakarta dengan kelezatan nangka mudanya, hingga sate ayam yang menjadi favorit wisatawan mancanegara. Setiap daerah di Indonesia memiliki keunikan bumbu dan teknik memasak yang berbeda. Bumbu rempah Indonesia yang kaya akan antioksidan tidak hanya memberikan cita rasa yang kompleks tapi juga manfaat kesehatan. Teknik memasak tradisional seperti pepes, bakar, dan santan memberikan karakteristik yang khas pada masakan Indonesia. Warisan kuliner nenek moyang ini perlu dilestarikan dan diwariskan kepada generasi muda. Adaptasi resep tradisional dengan sentuhan modern dapat menjadi cara untuk memperkenalkan kuliner Indonesia kepada dunia. Mari lestarikan kekayaan kuliner nusantara sebagai identitas bangsa yang patut dibanggakan.',
            'image_path' => 'assets/images/cooking4.jpg',
            'category' => 'budaya'
        ]);

        News::create([
            'title' => 'Kuliner Street Food Terbaik di Asia Tenggara',
            'content' => 'Jelajahi dunia street food dengan cita rasa autentik yang menggugah selera dari berbagai negara Asia Tenggara. Dari pad thai Thailand yang gurih pedas, pho Vietnam yang hangat menyegarkan, hingga laksa Malaysia yang kaya rempah. Street food bukan hanya soal rasa, tapi juga tentang budaya dan kehidupan masyarakat lokal. Setiap negara memiliki keunikan dalam penyajian dan bumbu yang digunakan. Teknik memasak cepat dengan api besar atau wok hei memberikan aroma dan rasa yang khas pada street food Asia. Bahan-bahan segar yang diolah langsung di depan pembeli menjamin kualitas dan kesegaran makanan. Harga yang terjangkau membuat street food menjadi pilihan favorit semua kalangan. Pengalaman kuliner street food memberikan insight tentang kehidupan sehari-hari masyarakat lokal. Kini, konsep street food mulai diadaptasi ke dalam restoran modern dengan tetap mempertahankan cita rasa autentiknya. Mari eksplorasi kekayaan kuliner jalanan yang tak pernah habis untuk dijelajahi.',
            'image_path' => 'assets/images/cooking5.jpg',
            'category' => 'kuliner'
        ]);
    }
}