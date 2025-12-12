<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $banners = Banner::all();
        $about = About::first();
        $categories = Category::latest()->take(6)->get();
        $products = Product::latest()->take(6)->get();
        return view('front.index', compact('banners', 'categories', 'products', 'about'));
    }
}
