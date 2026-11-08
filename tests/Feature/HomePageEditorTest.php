<?php

namespace Tests\Feature;

use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\EquipmentProduct;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\HomeSectionItem;
use App\Services\Landing\MasCoolHomePageService;
use Database\Seeders\MasCoolHomePageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Auth\Models\User;
use Tests\TestCase;

class HomePageEditorTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(MasCoolHomePageSeeder::class);
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.test',
            'password' => 'password',
        ]);
    }

    private function section(string $key): HomeSection
    {
        return HomeSection::where('key', $key)->firstOrFail();
    }

    // ---------------------------------------------------------------- access

    public function test_guests_cannot_access_cms_routes(): void
    {
        $product = EquipmentProduct::first();

        foreach ([
            '/admin',
            '/admin/home-page',
            '/admin/home-page?section=faq',
            '/admin/equipment/products',
            '/admin/equipment/categories',
            route('admin.equipment.products.edit', $product),
        ] as $url) {
            $this->get($url)->assertRedirect(route('loginform'));
        }
    }

    public function test_editor_and_home_page_return_200(): void
    {
        $this->get('/')->assertOk();
        $this->actingAs($this->admin)->get(route('admin.home.editor'))->assertOk();
        $this->actingAs($this->admin)->get(route('dashboard'))->assertOk();
    }

    public function test_every_section_tab_opens_in_the_single_editor(): void
    {
        foreach (array_merge(HomeSection::KEYS, ['seo']) as $key) {
            $this->actingAs($this->admin)
                ->get(route('admin.home.editor', ['section' => $key]))
                ->assertOk()
                ->assertSee('محرر الصفحة الرئيسية المرئي', false);
        }
    }

    public function test_repeaters_have_no_standalone_pages(): void
    {
        // the repeater content must only be reachable through the editor
        foreach (['/admin/home/faqs', '/admin/home/steps', '/admin/home/features', '/admin/home/sections'] as $gone) {
            $this->actingAs($this->admin)->get($gone)->assertNotFound();
        }
    }

    // ---------------------------------------------------------------- sections

    public function test_admin_can_update_every_home_page_section(): void
    {
        foreach (HomeSection::KEYS as $key) {
            $section = $this->section($key);

            $this->actingAs($this->admin)
                ->put(route('admin.home.sections.update', $key), [
                    'title' => 'عنوان '.$key,
                    'description' => 'وصف '.$key,
                    'is_active' => 1,
                ])
                ->assertRedirect(route('admin.home.editor', ['section' => $key]));

            $this->assertSame('عنوان '.$key, $section->fresh()->title);
        }
    }

    public function test_section_update_keeps_existing_image_and_hidden_settings(): void
    {
        $hero = $this->section('hero');
        $image = $hero->image;

        $this->actingAs($this->admin)->put(route('admin.home.sections.update', 'hero'), [
            'title' => 'بدون صورة جديدة',
            'settings' => ['tag' => 'شارة محدثة'],
            'is_active' => 1,
        ])->assertRedirect();

        $fresh = $hero->fresh();
        $this->assertSame($image, $fresh->image, 'approved image must survive an update with no upload');
        $this->assertSame('شارة محدثة', $fresh->setting('tag'));
        // a settings key the form did not post must not be wiped
        $this->assertSame('#equipment', $fresh->setting('primary_button_href'));
    }

    public function test_inactive_section_disappears_from_the_home_page(): void
    {
        $this->get('/')->assertSee('أسئلة قبل الشراء', false);

        $this->actingAs($this->admin)
            ->patch(route('admin.home.sections.toggle', 'faq'))
            ->assertRedirect();

        $this->assertFalse($this->section('faq')->fresh()->is_active);
        $this->get('/')->assertDontSee('أسئلة قبل الشراء', false);
    }

    // ---------------------------------------------------------------- repeaters

    public static function repeaterProvider(): array
    {
        return [
            'hero proof points' => ['hero_benefits', 'hero_proof'],
            'trust items' => ['trust', 'trust_item'],
            'advice points' => ['advice', 'advice_point'],
            'process steps' => ['process', 'process_step'],
            'faq items' => ['faq', 'faq_item'],
        ];
    }

    /**
     * @dataProvider repeaterProvider
     */
    public function test_admin_can_add_edit_reorder_and_delete_repeater_items(string $sectionKey, string $type): void
    {
        $section = $this->section($sectionKey);
        $before = $section->items()->where('type', $type)->count();

        // add
        $this->actingAs($this->admin)->post(route('admin.home.items.store', $sectionKey), [
            'type' => $type,
            'title' => 'عنصر جديد',
            'description' => 'وصف العنصر الجديد',
            'is_active' => 1,
        ])->assertRedirect(route('admin.home.editor', ['section' => $sectionKey]));

        $item = HomeSectionItem::where('type', $type)->where('title', 'عنصر جديد')->firstOrFail();
        $this->assertSame($before + 1, $section->items()->where('type', $type)->count());

        // edit
        $this->actingAs($this->admin)->put(route('admin.home.items.update', [$sectionKey, $item]), [
            'type' => $type,
            'title' => 'عنصر معدّل',
            'is_active' => 1,
        ])->assertRedirect();
        $this->assertSame('عنصر معدّل', $item->fresh()->title);

        // reorder — the new row is last, move it up one place
        $ordered = $section->items()->where('type', $type)->get();
        $this->assertSame($item->id, $ordered->last()->id);

        $this->actingAs($this->admin)
            ->patch(route('admin.home.items.reorder', [$sectionKey, $item]), ['direction' => 'up'])
            ->assertRedirect();

        $after = $section->items()->where('type', $type)->get();
        $this->assertSame($item->id, $after[$after->count() - 2]->id, 'item should have moved up one position');

        // toggle
        $this->actingAs($this->admin)->patch(route('admin.home.items.toggle', [$sectionKey, $item]))->assertRedirect();
        $this->assertFalse($item->fresh()->is_active);

        // delete
        $this->actingAs($this->admin)->delete(route('admin.home.items.destroy', [$sectionKey, $item]))->assertRedirect();
        $this->assertDatabaseMissing('home_section_items', ['id' => $item->id]);
    }

    public function test_item_type_must_match_its_section(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.home.items.store', 'faq'), ['type' => 'process_step', 'title' => 'خطأ'])
            ->assertSessionHasErrors('type');
    }

    public function test_icon_keys_are_whitelisted(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.home.items.store', 'trust'), [
                'type' => 'trust_item',
                'title' => 'عنصر',
                'icon_key' => '<script>alert(1)</script>',
            ])
            ->assertSessionHasErrors('icon_key');
    }

    public function test_inactive_items_are_hidden_and_order_is_respected(): void
    {
        $faq = HomeSectionItem::where('type', 'faq_item')->where('title', 'كيف أطلب عرض سعر؟')->firstOrFail();
        $faq->update(['is_active' => false]);

        $step = HomeSectionItem::where('type', 'process_step')->orderByDesc('sort_order')->first();
        $step->update(['sort_order' => 0]);
        MasCoolHomePageService::flush();

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringNotContainsString('كيف أطلب عرض سعر؟', $html);
        $this->assertLessThan(
            strpos($html, 'حدد احتياجك'),
            strpos($html, 'احجز المعاينة'),
            'sort_order must drive the rendered step order',
        );
    }

    // ---------------------------------------------------------------- catalog

    public function test_admin_can_manage_categories_and_products(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin)->post(route('admin.equipment.categories.store'), [
            'name' => 'تصنيف تجريبي',
            'media_shape' => 'wide',
            'is_active' => 1,
            'image' => UploadedFile::fake()->image('c.png', 800, 600),
        ])->assertRedirect(route('admin.equipment.categories.index'));

        $category = EquipmentCategory::where('name', 'تصنيف تجريبي')->firstOrFail();

        $this->actingAs($this->admin)->post(route('admin.equipment.products.store'), [
            'equipment_category_id' => $category->id,
            'name' => 'معدة تجريبية',
            'description' => 'وصف.',
            'media_shape' => 'wide',
            'is_active' => 1,
            'image' => UploadedFile::fake()->image('p.png', 800, 600),
        ])->assertRedirect(route('admin.equipment.products.index'));

        $product = EquipmentProduct::where('name', 'معدة تجريبية')->firstOrFail();

        $this->actingAs($this->admin)->put(route('admin.equipment.products.update', $product), [
            'equipment_category_id' => $category->id,
            'name' => 'معدة معدّلة',
            'description' => 'وصف محدث.',
            'media_shape' => 'square',
            'is_active' => 1,
        ])->assertRedirect();
        $this->assertSame('معدة معدّلة', $product->fresh()->name);

        $this->actingAs($this->admin)->delete(route('admin.equipment.products.destroy', $product))->assertRedirect();
        $this->actingAs($this->admin)->delete(route('admin.equipment.categories.destroy', $category))->assertRedirect();
        $this->assertDatabaseMissing('equipment_products', ['id' => $product->id]);
        $this->assertDatabaseMissing('equipment_categories', ['id' => $category->id]);
    }

    public function test_image_replacement_is_optional_and_never_deletes_approved_art(): void
    {
        Storage::fake('public');
        $product = EquipmentProduct::where('slug', 'air-condenser')->firstOrFail();
        $bundled = $product->image;

        // no upload -> keeps the approved image
        $this->actingAs($this->admin)->put(route('admin.equipment.products.update', $product), [
            'equipment_category_id' => $product->equipment_category_id,
            'name' => $product->name,
            'description' => $product->description,
            'media_shape' => $product->media_shape,
            'is_active' => 1,
        ])->assertRedirect();
        $this->assertSame($bundled, $product->fresh()->image);

        // upload -> replaces the reference but leaves the bundled file on disk
        $this->actingAs($this->admin)->put(route('admin.equipment.products.update', $product), [
            'equipment_category_id' => $product->equipment_category_id,
            'name' => $product->name,
            'description' => $product->description,
            'media_shape' => $product->media_shape,
            'is_active' => 1,
            'image' => UploadedFile::fake()->image('new.png', 800, 600),
        ])->assertRedirect();

        $this->assertNotSame($bundled, $product->fresh()->image);
        $this->assertFileExists(resource_path('images/mas-cool/'.basename($bundled)));
    }

    // ---------------------------------------------------------------- seo + cache

    public function test_admin_can_update_home_page_seo(): void
    {
        $this->actingAs($this->admin)->put(route('admin.home.seo.update'), [
            'meta_title' => 'عنوان سيو جديد',
            'meta_description' => 'وصف سيو جديد',
        ])->assertRedirect(route('admin.home.editor', ['section' => 'seo']));

        $this->get('/')->assertSee('عنوان سيو جديد', false);
    }

    public function test_cache_is_invalidated_after_an_edit(): void
    {
        $this->get('/')->assertSee('قوة التبريد.', false);

        $this->actingAs($this->admin)->put(route('admin.home.sections.update', 'hero'), [
            'title' => 'عنوان الهيرو الجديد',
            'is_active' => 1,
        ])->assertRedirect();

        // the editor save flushes the cache, so the change shows immediately
        $this->get('/')->assertSee('عنوان الهيرو الجديد', false);
    }
}
