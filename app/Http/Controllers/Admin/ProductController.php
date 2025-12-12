<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:4096',
        ]);

        $product = Product::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'category_id' => $data['category_id'],
            'is_active' => $request->has('is_active') ? $data['is_active'] : false,
        ]);

        if ($request->hasFile('image')) {
            $product->addMediaFromRequest('image')->toMediaCollection('products');
        }

        return redirect()->route('admin.products.index')->with('success', 'product created successfully!');
    }

    // صفحة تعديل جولة
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // تحديث جولة
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'nullable|boolean',
            'images' => 'nullable|image|max:4096',
        ]);

        $product->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'is_active' => $request->has('is_active') ? $data['is_active'] : false,
            'category_id' => $data['category_id'],
        ]);

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('products');
            $product->addMediaFromRequest('image')->toMediaCollection('products');
        }

        return redirect()->route('admin.products.index')->with('success', 'product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection('products');
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'product deleted successfully!');
    }
}
