<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $category = Category::create($request->validated());

            if ($request->hasFile('cover')) {
                $category->addMediaFromRequest('cover')->toMediaCollection('cover');
            }

            DB::commit();
            Session::flash('success', 'Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Failed to create category: ' . $e->getMessage());
        }

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            DB::beginTransaction();

            $category->update($request->validated());

            if ($request->hasFile('cover')) {
                $category->clearMediaCollection('cover');
                $category->addMediaFromRequest('cover')->toMediaCollection('cover');
            }

            DB::commit();
            Session::flash('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Failed to update category: ' . $e->getMessage());
        }

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->clearMediaCollection('categories');
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'category deleted successfully!');
    }
}
