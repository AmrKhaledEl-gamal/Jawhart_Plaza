<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $wishlistItems = Wishlist::with(['product.media', 'product.reviews', 'product.variants'])
            ->where('user_id', Auth::id())
            ->paginate(12);

        return view('front.whishlist', compact('wishlistItems'));
    }

    /**
     * Toggle product in wishlist.
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($existing) {
            $existing->delete();
            $message = __('front.removed_from_wishlist');
            $inWishlist = false;
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
            ]);
            $message = __('front.added_to_wishlist');
            $inWishlist = true;
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'inWishlist' => $inWishlist,
                'wishlistCount' => Wishlist::where('user_id', Auth::id())->count(),
            ]);
        }

        return back()->with('success', $message);
    }

    /**
     * Remove item from wishlist.
     */
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
            }
            abort(403);
        }

        $wishlist->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('front.removed_from_wishlist'),
                'wishlistCount' => Wishlist::where('user_id', Auth::id())->count(),
            ]);
        }

        return back()->with('success', __('front.removed_from_wishlist'));
    }

    /**
     * Move item from wishlist to cart.
     */
    public function moveToCart(Request $request, Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Add to cart
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $wishlist->product_id)
            ->where('product_variant_id', $validated['product_variant_id'])
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $validated['quantity']);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $wishlist->product_id,
                'product_variant_id' => $validated['product_variant_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        // Remove from wishlist
        $wishlist->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('front.moved_to_cart'),
                'wishlistCount' => Wishlist::where('user_id', Auth::id())->count(),
                'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity'),
            ]);
        }

        return back()->with('success', __('front.moved_to_cart'));
    }
}
