<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
            'name' => 'required|array',
            'name.*' => 'required|string',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|max:4096',
            'variations' => 'required|array',
            'variations.*.attribute_id' => 'required|exists:attributes,id',
            'variations.*.value' => 'required|array',
            'variations.*.value.*' => 'required|string',
            'variations.*.price_adjustment' => 'nullable|numeric',
            'variations.*.stock' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::create($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $product->addMedia($image)->toMediaCollection('gallery');
                }
            }

            foreach ($data['variations'] as $variation) {
                foreach ($variation['value'] as $value) {
                    $attributeValue = Attribute::find($variation['attribute_id'])->values()->firstOrCreate(['value' => $value]);

                    ProductAttributeValue::create([
                        'product_id' => $product->id,
                        'attribute_value_id' => $attributeValue->id,
                        'price_adjustment' => $variation['price_adjustment'] ?? 0,
                        'stock' => $variation['stock'],
                    ]);
                }
            }

            DB::commit();
            Session::flash('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Failed to create product: ' . $e->getMessage());
        }

        return redirect()->route('admin.products.index');
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
