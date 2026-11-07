<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\UpdateSeoSettingRequest;
use App\Services\Dashboard\Setting\SeoSettingService;

class SeoSettingController extends Controller
{
    protected $seoService;

    public function __construct(SeoSettingService $seoService)
    {
        $this->seoService = $seoService;
    }

    public function edit()
    {
        $seo = $this->seoService->getSeoSetting();
        return view('dashboard.seo.edit', compact('seo'));
    }

    public function update(UpdateSeoSettingRequest $request)
    {
        $this->seoService->updateSeoSetting(
            $request->validated(),
            $request->file('og_image'),
            $request->file('favicon')
        );

        return redirect()->back()->with('success', 'SEO settings updated successfully.');
    }
}
