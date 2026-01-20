<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\News;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalNews = News::count();
        $totalContacts = Contact::count();
        $recentNews = News::latest()->take(5)->get();
        $recentContacts = Contact::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalNews', 'totalContacts', 'recentNews', 'recentContacts'));
    }
    
    public function contacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }
}