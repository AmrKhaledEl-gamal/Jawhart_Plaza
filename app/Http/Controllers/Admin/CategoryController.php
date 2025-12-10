<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $category = Category::create(['name' => $data['name']]);

        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')->toMediaCollection('categories');
        }

        return redirect()->route('admin.categories.index')->with('success', 'category created successfully!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
        ]);

        $category->update(['name' => $data['name']]);

        if ($request->hasFile('image')) {
            $category->clearMediaCollection('categories');
            $category->addMediaFromRequest('image')->toMediaCollection('categories');
        }

        return redirect()->route('admin.categories.index')->with('success', 'category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->clearMediaCollection('categories');
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'category deleted successfully!');
    }
}
