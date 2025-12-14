<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request, GeneralSettings $settings)
    {
        $data = $request->validate([
            'site_name' => 'required|array',
            'site_name.ar' => 'required|string|max:255',
            'site_name.en' => 'required|string|max:255',

            'site_meta_description' => 'nullable|array',
            'site_meta_description.ar' => 'nullable|string',
            'site_meta_description.en' => 'nullable|string',

            'site_meta_keywords' => 'nullable|string',
            'site_meta_author' => 'nullable|string',

            'address' => 'nullable|array',
            'address.ar' => 'nullable|string',
            'address.en' => 'nullable|string',

            'phone_number' => 'nullable|string',
            'email' => 'nullable|email',

            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable|url',

            'site_logo' => 'nullable|image',
            'site_favicon' => 'nullable|image',
        ]);

        // Upload Logo
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $request->file('site_logo')->store('logos', 'public');
        }

        // Upload Favicon
        if ($request->hasFile('site_favicon')) {
            $data['site_favicon'] = $request->file('site_favicon')->store('favicons', 'public');
        }

        // Save Settings Values
        foreach ($data as $key => $value) {
            $settings->$key = $value;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Settings saved successfully!');
    }
}
