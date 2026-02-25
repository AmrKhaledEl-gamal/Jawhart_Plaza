<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'variants.color', 'variants.size']);

        // Search filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'like', "%{$search}%");
        }

        // Category filter (multiple categories)
        if ($request->filled('categories')) {
            $query->whereIn('category_id', (array) $request->categories);
        }

        // Size filter (through product variants)
        if ($request->filled('size')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size_id', $request->size);
            });
        }

        // Color filter (through product variants)
        if ($request->filled('color')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('color_id', $request->color);
            });
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            default:
                $query->latest();
                break;
        }

        // Only active products (include null as active by default)
        $query->where(function ($q) {
            $q->where('is_active', true)
                ->orWhereNull('is_active');
        });

        // Exclude products from inactive categories
        $query->whereHas('category', function ($q) {
            $q->where('is_active', true)
                ->orWhereNull('is_active');
        });

        $products = $query->paginate(6)->withQueryString();
        // Only show active categories in the filter
        $categories = Category::where(function ($q) {
            $q->where('is_active', true)
                ->orWhereNull('is_active');
        })->withCount(['products' => function ($q) {
            $q->where(function ($q2) {
                $q2->where('is_active', true)
                    ->orWhereNull('is_active');
            });
        }])->get();
        $colors = Color::all();
        $sizes = Size::all();

        // Get min and max prices for the price range slider
        $minProductPrice = 0;
        $maxProductPrice = (Product::where(function ($q) {
            $q->where('is_active', true)->orWhereNull('is_active');
        })->max('price') ?? 0) + 10;

        // Get wishlist product IDs for authenticated users
        $wishlistIds = [];
        if (\Illuminate\Support\Facades\Auth::check()) {
            $wishlistIds = \App\Models\Wishlist::where('user_id', \Illuminate\Support\Facades\Auth::id())->pluck('product_id')->toArray();
        }

        return view('front.shop.index', compact(
            'products',
            'categories',
            'colors',
            'sizes',
            'minProductPrice',
            'maxProductPrice',
            'wishlistIds'
        ));
    }
}
