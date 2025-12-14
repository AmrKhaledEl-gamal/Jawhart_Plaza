<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of active carts (e.g., for abandoned cart analysis).
     */
    public function index()
    {
        // Eager load user and product to avoid N+1 problem
        $carts = Cart::with(['user', 'product'])->latest()->paginate(20);
        return view('admin.carts.index', compact('carts'));
    }
}