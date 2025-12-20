<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::latest()->paginate(10);
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:7'],
        ]);

        Color::create($data);

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color created successfully');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:7'],
        ]);

        $color->update($data);

        return redirect()
            ->route('admin.colors.index')
            ->with('success', 'Color updated successfully');
    }

    public function destroy(Color $color)
    {
        // حماية: لو مستخدم في variants
        if ($color->variants()->exists()) {
            return back()->with('error', 'Color is used in products');
        }

        $color->delete();

        return back()->with('success', 'Color deleted successfully');
    }
}
