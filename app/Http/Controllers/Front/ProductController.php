<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display product details page
     */
    public function show(Product $product)
    {
        // Load relationships
        $product->load([
            'category',
            'variants.color',
            'variants.size',
            'reviews',
            'media'
        ]);

        // Get available sizes and colors from variants
        $availableSizes = $product->variants->pluck('size')->unique('id')->values();
        $availableColors = $product->variants->pluck('color')->unique('id')->values();

        // Calculate total stock
        $totalStock = $product->variants->sum('stock');

        // Calculate average rating
        $avgRating = $product->reviews->avg('rating') ?? 0;
        $reviewsCount = $product->reviews->count();

        // Get related products (same category, excluding current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where(function ($q) {
                $q->where('is_active', true)->orWhereNull('is_active');
            })
            ->with(['media', 'reviews'])
            ->limit(8)
            ->get();

        // Get product images
        $productImages = $product->getMedia('products');

        // Check if product is in user's wishlist
        $isInWishlist = false;
        if (auth()->check()) {
            $isInWishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->exists();
        }

        return view('front.products.show', compact(
            'product',
            'availableSizes',
            'availableColors',
            'totalStock',
            'avgRating',
            'reviewsCount',
            'relatedProducts',
            'productImages',
            'isInWishlist'
        ));
    }

    /**
     * Store a new review for a product (authenticated users only)
     */
    public function storeReview(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $user = auth()->user();

        $product->reviews()->create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()
            ->back()
            ->with('success', __('front.review_submitted'));
    }
}
