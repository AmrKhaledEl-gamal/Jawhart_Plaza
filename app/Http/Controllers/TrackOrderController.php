<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class TrackOrderController extends Controller
{
    public function index()
    {
        return view('front.pages.track-my-order');
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
        ]);

        $order = Order::with('items.product')->find($request->order_id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found. Please check your order ID and try again.');
        }

        return view('front.pages.track-my-order', compact('order'));
    }
}
