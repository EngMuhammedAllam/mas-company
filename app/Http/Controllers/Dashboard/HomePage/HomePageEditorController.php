<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\EquipmentProduct;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\HomeSectionItem;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * The single central "Visual Home Page Editor" screen.
 * Every ordinary section — including the FAQ, process, advice, trust and
 * hero-benefit repeaters — is edited here; only the equipment catalog
 * (products + categories) gets its own pages.
 */
class HomePageEditorController extends Controller
{
    public function __invoke(Request $request): View
    {
        $sections = HomeSection::query()
            ->ordered()
            ->with(['items'])             // repeaters in one extra query
            ->get()
            ->keyBy('key');

        // keep the tab order defined by the model, not by whatever is in the table
        $ordered = collect(HomeSection::KEYS)
            ->map(fn (string $key) => $sections->get($key))
            ->filter()
            ->values();

        $active = $request->string('section')->toString();
        // "seo" is a virtual tab backed by SeoSetting rather than a home_sections row
        if ($active !== 'seo' && ! $sections->has($active)) {
            $active = $ordered->first()?->key ?? 'hero';
        }

        return view('dashboard.home.editor', [
            'sections' => $ordered,
            'sectionMap' => $sections,
            'activeKey' => $active,
            'seoSetting' => SeoSetting::query()->first() ?? new SeoSetting(),
            'itemLimits' => HomeSectionItem::TYPE_LIMITS,
            'iconKeys' => HomeSectionItem::ICON_KEYS,
            'previewUrl' => route('landing', ['preview' => 1]),
            'counts' => [
                'categories' => EquipmentCategory::count(),
                'products' => EquipmentProduct::count(),
            ],
        ]);
    }
}
