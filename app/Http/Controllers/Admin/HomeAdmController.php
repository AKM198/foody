<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSection;

class HomeAdmController extends Controller
{
    public function edit()
    {
        $sections = [
            'header' => 'Header',
            'tentang' => 'Tentang Kami', 
            'menu_card_1' => 'Menu Card 1',
            'menu_card_2' => 'Menu Card 2',
            'menu_card_3' => 'Menu Card 3',
            'menu_card_4' => 'Menu Card 4'
        ];
        
        $homeSections = [];
        foreach ($sections as $key => $name) {
            $homeSections[$key] = HomeSection::firstOrCreate(
                ['section_name' => $key],
                [
                    'title' => $this->getDefaultTitle($key),
                    'content' => $this->getDefaultContent($key),
                    'current_img' => $this->getDefaultImage($key)
                ]
            );
        }
        
        return view('admin.pages.home', compact('homeSections'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'title' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $section = HomeSection::where('section_name', $request->section)->first();
        
        if ($request->filled('title')) $section->title = $request->title;
        if ($request->filled('content')) $section->content = $request->content;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $request->section . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/pages'), $fileName);
            $section->addNewImage('storage/pages/' . $fileName);
        }
        
        $section->save();
        
        return redirect()->route('admin.home.edit')->with('success', 'Home section updated successfully!');
    }
    
    public function switchImage(Request $request)
    {
        $request->validate([
            'section' => 'required|string',
            'prev_index' => 'required|integer|min:1|max:4'
        ]);
        
        $section = HomeSection::where('section_name', $request->section)->first();
        $section->switchToPrevious($request->prev_index);
        
        return response()->json(['success' => true]);
    }
    
    private function getDefaultImage($section)
    {
        $defaults = [
            'header' => 'assets/images/healty3.png',
            'tentang' => null,
            'menu_card_1' => 'assets/images/healty1.png',
            'menu_card_2' => 'assets/images/healty2.png',
            'menu_card_3' => 'assets/images/healty3.png',
            'menu_card_4' => 'assets/images/street3.png'
        ];
        return $defaults[$section] ?? null;
    }
    
    private function getDefaultTitle($section)
    {
        $defaults = [
            'header' => 'HEALTHY',
            'tentang' => 'TENTANG KAMI',
            'menu_card_1' => 'MAKANAN SEHAT',
            'menu_card_2' => 'MAKANAN SEGAR',
            'menu_card_3' => 'MAKANAN BERGIZI',
            'menu_card_4' => 'MAKANAN LEZAT'
        ];
        return $defaults[$section] ?? ucfirst(str_replace('_', ' ', $section));
    }
    
    private function getDefaultContent($section)
    {
        $defaults = [
            'header' => 'Nikmati kelezatan makanan sehat yang disiapkan dengan bahan-bahan segar pilihan terbaik. Kami menghadirkan cita rasa autentik yang memanjakan lidah sambil menjaga kesehatan tubuh Anda.',
            'tentang' => 'Foody hadir sebagai solusi terpercaya untuk kebutuhan makanan sehat dan bergizi keluarga Indonesia. Dengan komitmen menggunakan bahan-bahan segar berkualitas tinggi, kami menghadirkan berbagai pilihan hidangan lezat yang tidak hanya memanjakan lidah tetapi juga memberikan nutrisi terbaik untuk kesehatan optimal.',
            'menu_card_1' => 'Hidangan bergizi tinggi yang diolah dengan teknik memasak modern untuk mempertahankan kandungan vitamin dan mineral alami.',
            'menu_card_2' => 'Bahan-bahan segar pilihan yang dipetik langsung dari kebun organik untuk menjamin kualitas dan kesegaran setiap hidangan.',
            'menu_card_3' => 'Menu seimbang dengan kandungan protein, karbohidrat, dan vitamin yang tepat untuk mendukung gaya hidup sehat keluarga.',
            'menu_card_4' => 'Cita rasa autentik yang memadukan resep tradisional dengan sentuhan modern untuk pengalaman kuliner yang tak terlupakan.'
        ];
        return $defaults[$section] ?? 'Content for ' . ucfirst(str_replace('_', ' ', $section));
    }
}