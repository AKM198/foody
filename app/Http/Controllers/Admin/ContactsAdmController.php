<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ContactsAdmController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }
    
    public function all()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.all', compact('contacts'));
    }
    
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully!');
    }
    
    public function contactSettings()
    {
        $contactInfo = PageContent::where('page_name', 'contact')
            ->where('section_name', 'contact_info')
            ->pluck('content_value', 'content_type');
            
        $mapUrl = PageContent::where('page_name', 'contact')
            ->where('section_name', 'map')
            ->where('content_type', 'url')
            ->first();
            
        return view('admin.contacts.settings', compact('contactInfo', 'mapUrl'));
    }
    
    public function updateContactSettings(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'map_url' => 'required|url'
        ]);
        
        // Update contact info
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
        
        // Update map URL
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'map', 'content_type' => 'url'],
            ['content_value' => $request->map_url]
        );
        
        return redirect()->back()->with('success', 'Contact settings updated successfully!');
    }
}