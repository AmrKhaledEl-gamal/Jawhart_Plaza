<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->paginate(15);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'link'  => 'nullable|string|max:255',
            'image' => 'required|image'
        ]);

        $bunner = Banner::create([
            'link' => $request->link,
        ]);

        if ($request->hasFile('image')) {
            $bunner->addMediaFromRequest('image')->toMediaCollection('banners');
        }

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner created successfully');
    }

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Edit the specified banner.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    /*******  9e4f96a7-a668-4183-aff6-1bb4a80ecf93  *******/
    public function edit(Banner $banner)
    {
        $banner = $banner; // علشان الاسم اللي انت عايزه
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'link'  => 'nullable|string|max:255',
            'image' => 'nullable|image'
        ]);

        $banner->update([
            'link' => $request->link,
        ]);

        if ($request->hasFile('image')) {
            $banner->clearMediaCollection('banners');
            $banner->addMediaFromRequest('image')->toMediaCollection('banners');
        }

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner updated successfully');
    }

    public function destroy(Banner $banner)
    {
        $banner->clearMediaCollection('banners');
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully');
    }
}
