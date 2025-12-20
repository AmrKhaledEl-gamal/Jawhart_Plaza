<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        // Get all banners
        $banners = Banner::all();

        // Get first 4 active categories with their products (8 products each)
        $categories = Category::where(function ($q) {
            $q->where('is_active', true)->orWhereNull('is_active');
        })
            ->with(['products' => function ($query) {
                $query->where(function ($q) {
                    $q->where('is_active', true)->orWhereNull('is_active');
                })
                    ->with(['media', 'reviews'])
                    ->latest()
                    ->take(8);
            }, 'media'])
            ->withCount(['products' => function ($q) {
                $q->where(function ($q2) {
                    $q2->where('is_active', true)->orWhereNull('is_active');
                });
            }])
            ->having('products_count', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        // Top selling products (is_top_selling = true OR latest with high ratings)
        $topSellingProducts = Product::where(function ($q) {
            $q->where('is_active', true)->orWhereNull('is_active');
        })
            ->where('is_top_selling', true)
            ->with(['media', 'reviews'])
            ->latest()
            ->take(8)
            ->get();

        // If no top selling products, get latest products
        if ($topSellingProducts->isEmpty()) {
            $topSellingProducts = Product::where(function ($q) {
                $q->where('is_active', true)->orWhereNull('is_active');
            })
                ->with(['media', 'reviews'])
                ->latest()
                ->take(8)
                ->get();
        }

        // Get wishlist product IDs for authenticated users
        $wishlistIds = [];
        if (Auth::check()) {
            $wishlistIds = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }

        return view('front.index', compact('banners', 'categories', 'topSellingProducts', 'wishlistIds'));
    }
}
