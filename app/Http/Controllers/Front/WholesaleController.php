<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WholesaleController extends Controller
{
    public function index()
    {
        return view('front.wholesale.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:wholesale,email',
            'phone' => 'required|string|max:20',
            'sku' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'has_logo' => 'required|boolean',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\wholesale::create($request->all());

        return redirect()
            ->route('front.index')
            ->with('success', 'Your wholesale inquiry has been submitted successfully!');
    }
}
