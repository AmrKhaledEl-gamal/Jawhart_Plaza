<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'variants'])->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        // إنشاء المنتج بدون سعر الخصم أو المخزون
        $product = Product::create(
            $request->safe()->only([
                'name',
                'description',
                'slug',
                'price',
                'category_id',
                'is_active',
            ])
        );

        // صورة المنتج
        if ($request->hasFile('image')) {
            $product
                ->addMediaFromRequest('image')
                ->toMediaCollection('products');
        }

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('success', 'Product created successfully, add variants now.');
    }

    public function edit(Product $product)
    {
        $product->load(['variants.color', 'variants.size']);
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update(
            $request->safe()->only([
                'name',
                'description',
                'slug',
                'price',
                'category_id',
                'is_active',
            ])
        );

        if ($request->hasFile('image')) {
            $product->clearMediaCollection('products');
            $product
                ->addMediaFromRequest('image')
                ->toMediaCollection('products');
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function deleteImage(Product $product, int $mediaId): RedirectResponse
    {
        $media = $product->media()->where('id', $mediaId)->first();

        if ($media) {
            $media->delete();
        }

        return redirect()
            ->back()
            ->with('success', 'Product image deleted successfully!');
    }

    public function destroy(Product $product)
    {
        $product->clearMediaCollection('products');
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
