<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // البحث
        if ($request->filled('searchFilter')) {
            $search = trim($request->searchFilter);
            $locale = app()->getLocale();

            // Product::name is translatable (JSON). Search in the current locale.
            $query->where("name->$locale", 'like', "%{$search}%");
        }

        // الفلترة بالتصنيف
        if ($request->filled('categories')) {
            $query->where('category_id', $request->categories);
        }

        $products = $query->latest()->paginate(9)->withQueryString();

        $notfound = $products->count() == 0;

        $categories = Category::all();

        return view('front.products.index', compact('products', 'categories', 'notfound'));
    }
}
