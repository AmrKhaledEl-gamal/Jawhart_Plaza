<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('name')->paginate(10);
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
        ]);

        Size::create($data);

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size created successfully');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
        ]);

        $size->update($data);

        return redirect()
            ->route('admin.sizes.index')
            ->with('success', 'Size updated successfully');
    }

    public function destroy(Size $size)
    {
        if ($size->variants()->exists()) {
            return back()->with('error', 'Size is used in products');
        }

        $size->delete();

        return back()->with('success', 'Size deleted successfully');
    }
}