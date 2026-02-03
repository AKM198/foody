<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = [
            'address' => PageContent::where('page_name', 'contact')->where('section_name', 'address')->value('content_value'),
            'phone' => PageContent::where('page_name', 'contact')->where('section_name', 'phone')->value('content_value'),
            'email' => PageContent::where('page_name', 'contact')->where('section_name', 'email')->value('content_value')
        ];
            
        $mapUrl = PageContent::where('page_name', 'contact')
            ->where('section_name', 'map_url')
            ->first();
            
        $showSettings = request()->has('settings');
            
        return view('contact.contact', compact('contactInfo', 'mapUrl', 'showSettings'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);
        
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        
        return redirect()->back()->with('success', 'Terima kasih atas pesan Anda! Kami akan segera menghubungi Anda.');
    }
    
    public function updateSettings(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'map_url' => 'required|url'
        ]);
        
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'contact_info', 'content_type' => 'address'],
            ['content_value' => $request->address]
        );
        
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'contact_info', 'content_type' => 'phone'],
            ['content_value' => $request->phone]
        );
        
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'contact_info', 'content_type' => 'email'],
            ['content_value' => $request->email]
        );
        
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'map', 'content_type' => 'url'],
            ['content_value' => $request->map_url]
        );
        
        return redirect()->route('contact.index')->with('success', 'Contact settings updated successfully!');
    }
}