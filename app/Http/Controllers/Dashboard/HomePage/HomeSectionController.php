<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HomePage\HomeSectionRequest;
use App\Models\HomePage\HomeSection;
use App\Services\Dashboard\HomePage\HomePageContentService;
use Illuminate\Http\RedirectResponse;

class HomeSectionController extends Controller
{
    public function __construct(private readonly HomePageContentService $content)
    {
    }

    public function update(HomeSectionRequest $request, HomeSection $section): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        // merge so settings keys the form does not expose (e.g. equipment_links) survive
        $data['settings'] = array_replace($section->settings ?? [], $data['settings'] ?? []);

        $this->content->save($section, $data, $request->file('image'), 'sections');

        return redirect()
            ->route('admin.home.editor', ['section' => $section->key])
            ->with('success', 'تم حفظ قسم «'.$section->label().'» بنجاح.');
    }

    public function toggle(HomeSection $section): RedirectResponse
    {
        $section->update(['is_active' => ! $section->is_active]);
        $this->content->flushCache();

        return redirect()
            ->route('admin.home.editor', ['section' => $section->key])
            ->with('success', $section->is_active ? 'تم إظهار القسم في الصفحة.' : 'تم إخفاء القسم من الصفحة.');
    }
}
