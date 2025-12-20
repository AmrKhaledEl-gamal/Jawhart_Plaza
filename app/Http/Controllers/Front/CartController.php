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
            $price = $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        return view('front.cart', compact('cartItems', 'subtotal'));
    }

    /**
     * Add item to cart.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_variant_id' => 'required|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if variant has enough stock
        $variant = ProductVariant::findOrFail($validated['product_variant_id']);

        // Check if item already in cart
        $existingItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $validated['product_id'])
            ->where('product_variant_id', $validated['product_variant_id'])
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
                'product_variant_id' => $validated['product_variant_id'],
                'quantity' => $validated['quantity'],
            ]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('front.added_to_cart'),
                'cartCount' => Cart::where('user_id', Auth::id())->sum('quantity'),
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
            $price = $cart->product->discount_price ?? $cart->product->price;
            $itemTotal = $price * $cart->quantity;

            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            $subtotal = $cartItems->sum(function ($item) {
                $price = $item->product->discount_price ?? $item->product->price;
                return $price * $item->quantity;
            });

            return response()->json([
                'success' => true,
                'itemTotal' => number_format($itemTotal, 2),
                'subtotal' => number_format($subtotal, 2),
                'cartCount' => $cartItems->sum('quantity'),
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
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
            $subtotal = $cartItems->sum(function ($item) {
                $price = $item->product->discount_price ?? $item->product->price;
                return $price * $item->quantity;
            });

            return response()->json([
                'success' => true,
                'message' => __('front.item_removed'),
                'subtotal' => number_format($subtotal, 2),
                'cartCount' => $cartItems->sum('quantity'),
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
}
