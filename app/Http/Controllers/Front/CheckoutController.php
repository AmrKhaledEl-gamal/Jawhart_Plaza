<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product', 'variant'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('front.cart')->with('error', __('front.cart_empty'));
        }

        $subtotal = $cartItems->sum(function ($item) {
            $price = $item->variant->price ?? $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        return view('front.checkout.index', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:cash,visa',
        ]);

        $cartItems = Cart::with(['product', 'variant'])->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('front.cart')->with('error', __('front.cart_empty'));
        }

        // Validate stock before taking any action
        foreach ($cartItems as $item) {
            $stock = $item->variant->stock ?? 0;
            if ($item->quantity > $stock) {
                return redirect()->route('front.cart')->with('error', __('front.insufficient_stock_for', ['product' => $item->product->name]));
            }
        }

        // Calculate secure prices dynamically from DB
        $totalAmount = $cartItems->sum(function ($item) {
            $price = $item->variant->price ?? $item->product->discount_price ?? $item->product->price;
            return $price * $item->quantity;
        });

        // Add nominal shipping logic here eventually. E.g: $shipping = 15; $totalAmount += $shipping;

        try {
            DB::beginTransaction();

            $shippingAddress = json_encode([
                'name' => $request->name,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'apartment' => $request->apartment,
            ]);

            // Create Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => $shippingAddress,
                'payment_method' => $request->payment_method,
            ]);

            // Create OrderItems and decrement stock
            foreach ($cartItems as $item) {
                $price = $item->variant->price ?? $item->product->discount_price ?? $item->product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'price' => $price,
                ]);

                // Decrement stock
                if ($item->variant) {
                    $item->variant->decrement('stock', $item->quantity);
                }
            }

            // Clear Cart seamlessly
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            if ($request->payment_method === 'visa') {
                return redirect()->route('front.checkout.payment');
            }

            return redirect()->route('front.checkout.success')->with('success', __('front.order_placed_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', __('front.order_failed_try_again'));
        }
    }

    public function success()
    {
        return view('front.checkout.success');
    }

    public function payment()
    {
        return view('front.checkout.payment');
    }
}
