<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $contact = new Contact();
        $contact->full_name = $request->full_name;
        $contact->email = $request->email;
        $contact->phone_number = $request->phone_number;
        $contact->message = $request->message;
        $contact->save();

        return redirect()
            ->route('front.index')
            ->with('success', 'تم ارسال الرسالة بنجاح!');
    }
}
