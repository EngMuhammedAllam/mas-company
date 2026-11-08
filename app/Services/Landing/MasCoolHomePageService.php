<?php

namespace App\Services\Landing;

use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\HomeSectionItem;
use App\Models\SeoSetting;
use App\Models\Setting\ContactSetting;
use Illuminate\Support\Facades\Cache;

class MasCoolHomePageService
{
    public const CACHE_KEY = 'mas_cool.home_page.v2';

    public const CACHE_TTL = 3600;

    /**
     * Everything the mas Cool home page needs, in one cached payload.
     *
     * @return array<string, mixed>
     */
    public function getHomePageData(): array
    {
        $payload = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, fn () => $this->buildPayload());

        // read fresh so an admin phone change is visible immediately
        $contactSetting = ContactSetting::query()->first();

        return $payload + [
            'contactSetting' => $contactSetting,
            'whatsappNumber' => $this->whatsappNumber($contactSetting),
        ];
    }

    /** @return array<string, mixed> */
    private function buildPayload(): array
    {
        $categories = EquipmentCategory::query()
            ->active()
            ->ordered()
            ->with(['activeProducts'])      // one extra query, no N+1 in the loop
            ->get();

        $products = $categories
            ->flatMap(fn (EquipmentCategory $category) => $category->activeProducts->each(
                fn ($product) => $product->setRelation('category', $category)
            ))
            ->sortBy([['sort_order', 'asc'], ['id', 'asc']])
            ->values();

        // all repeater rows in one query, grouped by type for the view
        $items = HomeSectionItem::query()
            ->active()
            ->ordered()
            ->get()
            ->groupBy('type');

        return [
            'sections' => HomeSection::query()->active()->ordered()->get()->keyBy('key'),
            'items' => $items,
            'categories' => $categories,
            'products' => $products,
            'seoSetting' => SeoSetting::query()->first(),
        ];
    }

    /** Digits only, falling back to the public phone number. */
    public function whatsappNumber(?ContactSetting $contactSetting): string
    {
        $source = $contactSetting?->whatsapp_number ?: $contactSetting?->phone;

        return (string) preg_replace('/\D+/', '', (string) $source);
    }

    /** Drop the cached payload. Called from every dashboard write. */
    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
