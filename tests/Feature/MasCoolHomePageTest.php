<?php

namespace Tests\Feature;

use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\EquipmentProduct;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\HomeSectionItem;
use App\Models\Setting\ContactSetting;
use App\Services\Landing\MasCoolHomePageService;
use Database\Seeders\MasCoolHomePageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MasCoolHomePageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MasCoolHomePageSeeder::class);
        ContactSetting::query()->create(['whatsapp_number' => '+20 123 456 7890']);
    }

    public function test_home_page_returns_successfully(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_seeded_products_and_approved_images_appear(): void
    {
        $response = $this->get('/');

        foreach ([
            'كوندنسر هواء', 'كويل تبريد', 'كباس نصف مغلق',
            'وحدة تكثيف', 'كويل تجميد', 'كباس تبريد',
        ] as $name) {
            $response->assertSee($name, false);
        }

        // the approved artwork must still be referenced, unchanged
        foreach ([
            'hero-compressor.png', 'compressor-green.png', 'compressor-blue.png',
            'coil-white.png', 'coil-four-fan.png', 'condensing-unit-green.png',
            'condenser-blue.png',
        ] as $image) {
            $response->assertSee('/mas-cool-assets/'.$image, false);
        }
    }

    public function test_inactive_records_do_not_appear_on_home_page(): void
    {
        $product = EquipmentProduct::where('slug', 'cooling-coil')->firstOrFail();
        $product->update(['is_active' => false]);

        HomeSectionItem::where('type', 'faq_item')->where('title', 'كيف أطلب عرض سعر؟')->update(['is_active' => false]);
        HomeSectionItem::where('type', 'process_step')->where('title', 'راجع التفاصيل')->update(['is_active' => false]);
        MasCoolHomePageService::flush();

        $response = $this->get('/');
        $response->assertDontSee('كويل هواء للتبريد والتجميد بمقاسات وقدرات متعددة.', false);
        $response->assertDontSee('كيف أطلب عرض سعر؟', false);
        $response->assertDontSee('راجع التفاصيل', false);
    }

    public function test_products_respect_sort_order(): void
    {
        EquipmentProduct::where('slug', 'cooling-compressor')->update(['sort_order' => 0]);
        MasCoolHomePageService::flush();

        $html = $this->get('/')->getContent();
        $first = strpos($html, 'كباس تبريد');
        $other = strpos($html, 'كوندنسر هواء');

        $this->assertLessThan($other, $first, 'sort_order must drive product order');
    }

    public function test_filters_use_category_slugs(): void
    {
        $response = $this->get('/');

        foreach (EquipmentCategory::pluck('slug') as $slug) {
            $response->assertSee('data-filter="'.$slug.'"', false);
            $response->assertSee('data-type="'.$slug.'"', false);
        }
    }

    public function test_whatsapp_links_use_the_configured_number(): void
    {
        $this->get('/')->assertSee('https://wa.me/201234567890', false);
    }

    public function test_empty_sections_do_not_break_the_page(): void
    {
        EquipmentProduct::query()->delete();
        EquipmentCategory::query()->delete();
        HomeSectionItem::query()->delete();
        HomeSection::query()->delete();
        MasCoolHomePageService::flush();

        $this->get('/')->assertOk();
    }

    public function test_home_page_has_no_obvious_n_plus_one(): void
    {
        MasCoolHomePageService::flush();

        DB::enableQueryLog();
        $this->get('/')->assertOk();
        $queries = count(DB::getQueryLog());
        DB::disableQueryLog();

        // sections, features, categories, products, steps, faqs, seo, contact
        $this->assertLessThanOrEqual(12, $queries, "Home page ran {$queries} queries; expected a small fixed number.");
    }

    public function test_cache_is_served_and_invalidated(): void
    {
        $this->get('/')->assertSee('كوندنسر هواء', false);

        EquipmentProduct::where('slug', 'air-condenser')->update(['name' => 'اسم محدث للمكثف']);

        // still cached
        $this->get('/')->assertDontSee('اسم محدث للمكثف', false);

        MasCoolHomePageService::flush();
        $this->get('/')->assertSee('اسم محدث للمكثف', false);
    }
}
