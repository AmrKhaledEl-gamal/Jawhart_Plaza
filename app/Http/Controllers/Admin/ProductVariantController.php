<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'color_id' => ['required', 'exists:colors,id'],
            'size_id'  => ['required', 'exists:sizes,id'],
            // 'price'    => ['required', 'numeric', 'min:0'],
            'stock'    => ['required', 'integer', 'min:0'],
        ]);

        $exists = $product->variants()
            ->where('color_id', $data['color_id'])
            ->where('size_id', $data['size_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'This variant already exists'
            ], 422);
        }

        $variant = $product->variants()->create($data);

        return response()->json([
            'message' => 'Variant added',
            'variant' => [
                'id'         => $variant->id,
                'color_code' => $variant->color->code,
                'size'       => $variant->size->name,
                // 'price'      => $variant->price,
                'stock'      => $variant->stock,
            ]
        ], 201);
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        // Ensure the variant belongs to the current product (avoid deleting another product's variant)
        if ((int) $variant->product_id !== (int) $product->id) {
            return response()->json([
                'message' => 'Variant not found for this product'
            ], 404);
        }

        $variant->delete();

        return response()->json([
            'message' => 'Variant deleted'
        ], 200);
    }
}
