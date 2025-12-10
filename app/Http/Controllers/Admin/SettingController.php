<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings\GeneralSettings;

class SettingController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request, GeneralSettings $settings)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_meta_description' => 'nullable|string',
            'site_meta_keywords' => 'nullable|string',
            'site_meta_author' => 'nullable|string',

            'address' => 'nullable|string',
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
