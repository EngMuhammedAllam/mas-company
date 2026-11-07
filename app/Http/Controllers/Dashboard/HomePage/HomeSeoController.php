<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HomePage\SeoSettingsRequest;
use App\Models\SeoSetting;
use App\Services\Dashboard\HomePage\HomePageContentService;
use Illuminate\Http\RedirectResponse;

/** SEO fields for the home page, edited from the editor's SEO tab. */
class HomeSeoController extends Controller
{
    public function __construct(private readonly HomePageContentService $content)
    {
    }

    public function update(SeoSettingsRequest $request): RedirectResponse
    {
        $seo = SeoSetting::query()->first() ?? new SeoSetting();
        $seo->fill($request->validated())->save();

        $this->content->flushCache();

        return redirect()
            ->route('admin.home.editor', ['section' => 'seo'])
            ->with('success', 'تم حفظ إعدادات SEO بنجاح.');
    }
}
