<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view('front.about', compact('about'));
    }
}
