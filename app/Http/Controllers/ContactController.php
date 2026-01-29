<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = PageContent::where('page_name', 'contact')
            ->where('section_name', 'contact_info')
            ->pluck('content_value', 'content_type');
            
        $mapUrl = PageContent::where('page_name', 'contact')
            ->where('section_name', 'map')
            ->where('content_type', 'url')
            ->first();
            
        return view('contact.contact', compact('contactInfo', 'mapUrl'));
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
}