<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoSettingController extends Controller
{
    public function edit()
    {
        $seo = SeoSetting::firstOrCreate([]);
        return view('dashboard.seo.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $seo = SeoSetting::firstOrCreate([]);

        $data = $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'canonical_url' => 'nullable|url|max:255',
            'robots' => 'nullable|string|max:50',
            'author' => 'nullable|string|max:255',
            'twitter_handle' => 'nullable|string|max:255',
            'twitter_card_type' => 'nullable|string|max:50',
            'og_type' => 'nullable|string|max:50',
            'og_site_name' => 'nullable|string|max:255',
            'header_code' => 'nullable|string',
            'footer_code' => 'nullable|string',
            'og_image' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg|max:1024',
        ]);

        if ($request->hasFile('og_image')) {
            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($seo->favicon) {
                Storage::disk('public')->delete($seo->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('seo', 'public');
        }

        $seo->update($data);

        return redirect()->back()->with('success', 'SEO settings updated successfully.');
    }
}
