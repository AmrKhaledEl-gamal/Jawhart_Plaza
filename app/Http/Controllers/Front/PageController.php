<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('front.about');
    }

    public function privacyPolicy()
    {
        return view('front.pages.privacy-policy');
    }

    public function termsConditions()
    {
        return view('front.pages.terms-conditions');
    }

    public function buyingGuide()
    {
        return view('front.pages.buying-guide');
    }

    public function faq()
    {
        $faqs = \App\Models\Faq::all();
        return view('front.pages.faq', compact('faqs'));
    }
}
