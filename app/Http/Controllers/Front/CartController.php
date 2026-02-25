<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     */
    public function index()
    {
        $cartItems = Cart::with(['product.media', 'variant.size', 'variant.color'])
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            $price = $item->variant->price ?? $item->product->price;
            return $price * $item->quantity;
        });

        return view('front.cart', compact('cartItems', 'subtotal'));
    }

    /**
     * Add item to cart.
     */
    public function store(Request $request)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('front.login')->with('error', __('front.please_login_first'));
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id' => 'nullable|exists:sizes,id',
            'color_id' => 'nullable|exists:colors,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the variant matching the selected size and color
        $variantQuery = ProductVariant::where('product_id', $validated['product_id']);

        if (!empty($validated['size_id'])) {
            $variantQuery->where('size_id', $validated['size_id']);
        }
        if (!empty($validated['color_id'])) {
            $variantQuery->where('color_id', $validated['color_id']);
        }

        $variant = $variantQuery->first();

        if (!$variant) {
            return back()->with('error', __('front.variant_not_found'));
        }

        // Check if item already in cart
        $existingItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->where('product_variant_id', $variant->id)
            ->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $validated['quantity'];

            if ($newQuantity > $variant->stock) {
                return back()->with('error', __('front.not_enough_stock'));
            }

            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            if ($validated['quantity'] > $variant->stock) {
                return back()->with('error', __('front.not_enough_stock'));
            }

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $validated['product_id'],
                'product_variant_id' => $variant->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return back()->with('success', __('front.added_to_cart'));
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, Cart $cart)
    {
        // Ensure user owns this cart item
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check stock
        if ($validated['quantity'] > $cart->variant->stock) {
            return back()->with('error', __('front.not_enough_stock'));
        }

        $cart->update(['quantity' => $validated['quantity']]);

        if ($request->ajax()) {
            $price = $cart->variant->price ?? $cart->product->price;
            $itemTotal = $price * $cart->quantity;

            $cartItems = Cart::where('user_id', Auth::id())->with(['product', 'variant'])->get();
            $subtotal = $cartItems->sum(function ($item) {
                $price = $item->variant->price ?? $item->product->price;
                return $price * $item->quantity;
            });

            return response()->json([
                'success' => true,
                'itemTotal' => number_format($itemTotal, 2),
                'subtotal' => number_format($subtotal, 2),
                'cartCount' => $cartItems->count(),
            ]);
        }

        return back()->with('success', __('front.cart_updated'));
    }

    /**
     * Remove item from cart.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        if (request()->ajax()) {
            $cartItems = Cart::where('user_id', Auth::id())->with(['product', 'variant'])->get();
            $subtotal = $cartItems->sum(function ($item) {
                $price = $item->variant->price ?? $item->product->price;
                return $price * $item->quantity;
            });

            return response()->json([
                'success' => true,
                'message' => __('front.item_removed'),
                'subtotal' => number_format($subtotal, 2),
                'cartCount' => $cartItems->count(),
            ]);
        }

        return back()->with('success', __('front.item_removed'));
    }

    /**
     * Clear entire cart.
     */
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('front.cart_cleared'),
            ]);
        }

        return back()->with('success', __('front.cart_cleared'));
    }

    /**
     * Get distinct distinct cart items count.
     */
    public function getCartItemCount()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0]);
        }

        $count = Cart::where('user_id', Auth::id())->count();

        return response()->json(['count' => $count]);
    }
}
