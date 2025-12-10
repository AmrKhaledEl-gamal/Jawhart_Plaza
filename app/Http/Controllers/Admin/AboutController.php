<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * عرض صفحة About مع البيانات الحالية
     */
    public function edit()
    {
        $about = About::first(); // الصفحة واحدة، بناخد أول (أو وحيد) سجل
        return view('admin.about.index', compact('about'));
    }

    /**
     * تحديث أو إنشاء بيانات About
     */
    public function updateOrCreate(Request $request)
    {
        $request->validate([
            'about' => 'required|string',
            'vision' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $about = About::first();

        if (!$about) {
            $about = new About();
        }

        $about->about = $request->about;
        $about->vision = $request->vision;
        $about->save();

        // إضافة الصورة لو موجودة
        if ($request->hasFile('image')) {
            $about->clearMediaCollection('about_images'); // مسح الصورة القديمة
            $about->addMediaFromRequest('image')->toMediaCollection('about_images');
        }

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح ✅');
    }
}
