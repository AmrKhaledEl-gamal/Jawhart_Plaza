<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = \App\Models\Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function destroy($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully!');
    }
}
