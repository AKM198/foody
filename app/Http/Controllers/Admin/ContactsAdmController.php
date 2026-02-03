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
        
        $contactInfo = [
            'address' => PageContent::where('page_name', 'contact')->where('section_name', 'address')->value('content_value'),
            'phone' => PageContent::where('page_name', 'contact')->where('section_name', 'phone')->value('content_value'),
            'email' => PageContent::where('page_name', 'contact')->where('section_name', 'email')->value('content_value')
        ];
            
        $mapUrl = PageContent::where('page_name', 'contact')
            ->where('section_name', 'map_url')
            ->first();
            
        return view('admin.contacts.index', compact('contacts', 'contactInfo', 'mapUrl'));
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
            'map_url' => 'nullable|url'
        ]);
        
        // Update contact info using different section names
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'address'],
            ['content_type' => 'text', 'content_value' => $request->address]
        );
        
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'phone'],
            ['content_type' => 'text', 'content_value' => $request->phone]
        );
        
        PageContent::updateOrCreate(
            ['page_name' => 'contact', 'section_name' => 'email'],
            ['content_type' => 'text', 'content_value' => $request->email]
        );
        
        // Update map URL if provided
        if ($request->map_url) {
            PageContent::updateOrCreate(
                ['page_name' => 'contact', 'section_name' => 'map_url'],
                ['content_type' => 'url', 'content_value' => $request->map_url]
            );
        }
        
        return redirect()->route('admin.contacts.index')->with('success', 'Contact settings updated successfully!');
    }
}