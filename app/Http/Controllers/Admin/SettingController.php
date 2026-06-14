<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'light_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'dark_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:10240',
            'contact_emails.*' => 'nullable|email',
            'contact_phones.*' => 'nullable|string|max:20',
            'whatsapp_number' => 'nullable',
            'map_iframe' => 'nullable|string',
            'address.*' => 'nullable|string',
            'footer_text' => 'nullable|string',
            'social_links' => 'nullable|array',
            'social_links.*.icon' => 'required|string',
            'social_links.*.url' => 'required|url',
        ]);

        $setting = Setting::firstOrNew([]);

        if ($request->hasFile('light_logo')) {

            if ($setting->light_logo && file_exists(public_path($setting->light_logo))) {
                unlink(public_path($setting->light_logo));
            }

            $lightLogo = $request->file('light_logo');
            $lightLogoName = time() . '_light.' . $lightLogo->getClientOriginalExtension();
            $lightLogo->move(public_path('uploads/logos'), $lightLogoName);
            $setting->light_logo = 'uploads/logos/' . $lightLogoName;
        }

        if ($request->hasFile('dark_logo')) {

            if ($setting->dark_logo && file_exists(public_path($setting->dark_logo))) {
                unlink(public_path($setting->dark_logo));
            }

            $darkLogo = $request->file('dark_logo');
            $darkLogoName = time() . '_dark.' . $darkLogo->getClientOriginalExtension();
            $darkLogo->move(public_path('uploads/logos'), $darkLogoName);
            $setting->dark_logo = 'uploads/logos/' . $darkLogoName;
        }

        if ($request->hasFile('favicon')) {

            if ($setting->favicon && file_exists(public_path($setting->favicon))) {
                unlink(public_path($setting->favicon));
            }

            $favicon = $request->file('favicon');
            $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('uploads/icons'), $faviconName);
            $setting->favicon = 'uploads/icons/' . $faviconName;
        }

        $setting->site_name = $request->site_name;
        $setting->contact_emails = $request->contact_emails ?? [];
        $setting->contact_phones = $request->contact_phones ?? [];
        $setting->whatsapp_number = $request->whatsapp_number;
        $setting->map_iframe = $request->map_iframe;
        $setting->address = $request->address ?? [];
        $setting->footer_text = $request->footer_text;
        $setting->social_links = $request->input('social_links', []);
        $setting->header_code = $request->header_code;
        $setting->footer_code = $request->footer_code;
        $setting->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully!');
    }
}
