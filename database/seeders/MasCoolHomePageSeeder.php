<?php

namespace Database\Seeders;

use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\EquipmentProduct;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\HomeSectionItem;
use Illuminate\Database\Seeder;

/**
 * Seeds the EXACT content that the mas Cool home page shipped with,
 * including the approved artwork. Idempotent (updateOrCreate on natural keys).
 */
class MasCoolHomePageSeeder extends Seeder
{
    public function run(): void
    {
        $sections = $this->seedSections();
        $this->seedItems($sections);
        $categories = $this->seedCategories();
        $this->seedProducts($categories);
    }

    /** @return array<string, HomeSection> */
    private function seedSections(): array
    {
        $sections = [
            [
                'key' => 'general',
                'title' => 'mas Cool',
                'description' => 'معدات التبريد الصناعي',
                'settings' => [
                    'brand_word' => 'mas Cool',
                    'brand_tag' => 'معدات التبريد الصناعي',
                    'nav_home' => 'الرئيسية',
                    'nav_equipment' => 'المعدات',
                    'nav_about' => 'لماذا mas Cool',
                    'nav_contact' => 'تواصل معنا',
                    'skip_link' => 'تخطي إلى المحتوى',
                ],
                'sort_order' => 0,
            ],
            [
                'key' => 'hero',
                'eyebrow' => 'mas Cool · معدات التبريد الصناعي',
                'title' => 'قوة التبريد.',
                'highlighted_text' => 'ثقة الاختيار.',
                'description' => 'معدات تبريد مستوردة، تعاينها وتختبرها قبل الشراء. اختر المعدة المناسبة وراجع تفاصيلها قبل القرار.',
                'image' => 'mas-cool-assets/hero-compressor.png',
                'image_alt' => 'كباس تبريد صناعي أخضر على خلفية رسم هندسي',
                'button_text' => 'استكشف المعدات',
                'secondary_button_text' => 'احجز معاينة',
                'secondary_whatsapp_message' => 'مرحبًا mas Cool، أرغب في حجز موعد لمعاينة معدات التبريد.',
                'settings' => [
                    'primary_button_href' => '#equipment',
                    'tag' => 'جاهز للمعاينة',
                    'badge' => 'معاينة واختبار قبل الشراء',
                ],
                'sort_order' => 1,
            ],
            [
                'key' => 'hero_benefits',
                'title' => 'مزايا سريعة',
                'description' => 'تظهر أسفل أزرار الهيرو مباشرة.',
                'sort_order' => 2,
            ],
            [
                'key' => 'trust',
                'title' => 'شريط الثقة',
                'description' => 'يظهر أسفل الهيرو داخل الخلفية الداكنة.',
                'sort_order' => 3,
            ],
            [
                'key' => 'categories',
                'eyebrow' => '01 / تصفح حسب النوع',
                'title' => 'كل ما يحتاجه نظام التبريد',
                'description' => 'مجموعة متكاملة من معدات التبريد الصناعي بمواصفات عالمية.',
                'sort_order' => 4,
            ],
            [
                'key' => 'equipment',
                'eyebrow' => '02 / معدات مختارة',
                'title' => 'معدات تستحق نظرة أقرب',
                'description' => 'معدات مختارة بعناية من أفضل العلامات، راجع مواصفاتها قبل الزيارة.',
                'button_text' => 'اسأل عن معدة محددة',
                'whatsapp_message' => 'مرحبًا mas Cool، أبحث عن معدة محددة وأحتاج مساعدة في الاختيار.',
                'secondary_button_text' => 'استعرض جميع المعدات ⊞',
                'secondary_whatsapp_message' => 'مرحبًا mas Cool، أريد معرفة المعدات المتاحة حاليًا.',
                'settings' => ['filter_all_label' => 'الكل'],
                'sort_order' => 5,
            ],
            [
                'key' => 'visit',
                'title' => 'شوف المعدة. جرّبها.',
                'highlighted_text' => 'وقرر بثقة.',
                'description' => 'تواصل معنا لتنسيق زيارتك ومعاينة المعدات.',
                'image' => 'mas-cool-assets/fan-closeup.png',
                'image_alt' => 'مراوح تبريد صناعية',
                'button_text' => 'احجز زيارتك الآن',
                'whatsapp_message' => 'مرحبًا mas Cool، أريد حجز موعد للزيارة ومعاينة المعدات.',
                'settings' => ['note' => 'معاينة واختبار بالمخزن مع استشارة فنية'],
                'sort_order' => 6,
            ],
            [
                'key' => 'advice',
                'eyebrow' => '03 / اختيار مدروس',
                'title' => 'اختيار المعدة يبدأ بفهم',
                'highlighted_text' => 'احتياجك',
                'description' => 'شاركنا نوع الاستخدام والمواصفات المطلوبة؛ لنساعدك في اختيار المعدة المناسبة.',
                'image' => 'mas-cool-assets/fan-closeup.png',
                'image_alt' => 'مروحة تبريد صناعية عن قرب',
                'settings' => ['caption' => 'خبرة فنية • اختيار أدق'],
                'sort_order' => 7,
            ],
            [
                'key' => 'process',
                'eyebrow' => '04 / خطوات واضحة',
                'title' => 'من أول استفسار لحد المعاينة',
                'description' => 'خطوات بسيطة تضمن لك اختيار المعدة المناسبة.',
                'sort_order' => 8,
            ],
            [
                'key' => 'faq',
                'eyebrow' => '05 / نجاوب على أسئلتك',
                'title' => 'أسئلة قبل الشراء',
                'description' => 'إجابات واضحة تساعدك في اتخاذ القرار المناسب.',
                'sort_order' => 9,
            ],
            [
                'key' => 'contact',
                'eyebrow' => 'الخطوة القادمة تبدأ هنا',
                'title' => 'جاهز نختار المعدة',
                'highlighted_text' => 'المناسبة؟',
                'description' => 'اترك تفاصيل احتياجك وسنتواصل معك.',
                'button_text' => 'إرسال عبر واتساب',
                'settings' => [
                    'form_note' => 'سيُفتح واتساب برسالة جاهزة، ولن تُرسل إلا بعد تأكيدك داخل المحادثة.',
                    'other_option_label' => 'أحتاج مساعدة في الاختيار',
                ],
                'sort_order' => 10,
            ],
            [
                'key' => 'footer',
                'title' => 'mas Cool',
                'description' => 'معدات التبريد الصناعي',
                'button_text' => 'اطلب عرض سعر ←',
                'whatsapp_message' => 'مرحبًا mas Cool، أرغب في طلب عرض سعر.',
                'secondary_button_text' => 'نسّق موعد المعاينة',
                'secondary_whatsapp_message' => 'مرحبًا mas Cool، أريد تنسيق موعد للمعاينة.',
                'settings' => [
                    'copyright' => 'mas Cool — جميع الحقوق محفوظة.',
                    'quick_links_title' => 'روابط سريعة',
                    'equipment_title' => 'المعدات',
                    'start_title' => 'ابدأ معنا',
                    'equipment_links' => ['كباسات', 'كويلات تبريد', 'وحدات تكثيف', 'كوندنسرات'],
                    'header_cta_text' => 'اطلب عرض سعر',
                    'floating_message' => 'مرحبًا mas Cool، أريد الاستفسار عن معدات التبريد.',
                ],
                'sort_order' => 11,
            ],
        ];

        $map = [];

        foreach ($sections as $section) {
            $map[$section['key']] = HomeSection::updateOrCreate(
                ['key' => $section['key']],
                $section + ['is_active' => true],
            );
        }

        return $map;
    }

    /** @param array<string, HomeSection> $sections */
    private function seedItems(array $sections): void
    {
        $items = [
            // hero quick proof points
            ['hero_benefits', 'hero_proof', 'فحص قبل الشراء', null, null, 'check', 1, []],
            ['hero_benefits', 'hero_proof', 'اختيارات متعددة', null, null, 'check', 2, []],
            ['hero_benefits', 'hero_proof', 'دعم فني متخصص', null, null, 'check', 3, []],
            // trust bar
            ['trust', 'trust_item', 'معدات مستوردة', 'من أفضل العلامات العالمية', null, 'globe', 1, []],
            ['trust', 'trust_item', 'معاينة بالمخزن', 'تعاين وتختبر قبل الشراء', null, 'warehouse', 2, []],
            ['trust', 'trust_item', 'مساعدة في الاختيار', 'فريق متخصص يساعدك', null, 'support', 3, []],
            // advice points
            ['advice', 'advice_point', 'نوع الاستخدام', 'تحديد طبيعة التطبيق وبيئة التشغيل المناسبة.', '01', null, 1, []],
            ['advice', 'advice_point', 'القدرة المطلوبة', 'اختيار السعة والقدرة المتوافقة مع احتياج مشروعك.', '02', null, 2, []],
            ['advice', 'advice_point', 'ظروف التشغيل', 'مراعاة درجات الحرارة والظروف البيئية لأفضل أداء.', '03', null, 3, []],
            // process steps
            ['process', 'process_step', 'حدد احتياجك', 'اخبرنا بنوع الاستخدام والمواصفات التي تبحث عنها.', '01', 'note', 1, ['is_final' => false]],
            ['process', 'process_step', 'راجع التفاصيل', 'استفسر عن الموديل والقدرة والحالة والتوافر والسعر.', '02', 'search', 2, ['is_final' => false]],
            ['process', 'process_step', 'احجز المعاينة', 'نسّق موعدًا لمعاينة المعدة والتأكد من ملاءمتها.', '03', 'calendar', 3, ['is_final' => true]],
            // FAQs
            ['faq', 'faq_item', 'هل يمكن معاينة المعدة قبل الشراء؟', 'يمكن التواصل معنا لتنسيق موعد المعاينة والاطلاع على تفاصيل المعدة وإجراءات الاختبار المتاحة.', null, null, 1, []],
            ['faq', 'faq_item', 'كيف أختار القدرة المناسبة؟', 'شارك معنا نوع الاستخدام وحجم المساحة ودرجة الحرارة المطلوبة، وسنراجع المتطلبات الفنية معك.', null, null, 2, []],
            ['faq', 'faq_item', 'كيف أطلب عرض سعر؟', 'اختر «استفسر عن السعر» أسفل المعدة أو املأ النموذج التالي بتفاصيل احتياجك.', null, null, 3, []],
            ['faq', 'faq_item', 'كيف أتأكد من توافر المعدة؟', 'التوافر يتغير؛ تواصل معنا لتأكيد الموديل والحالة والكمية المتاحة قبل الزيارة.', null, null, 4, []],
        ];

        foreach ($items as [$sectionKey, $type, $title, $description, $label, $icon, $order, $settings]) {
            HomeSectionItem::updateOrCreate(
                ['type' => $type, 'title' => $title],
                [
                    'home_section_id' => $sections[$sectionKey]->id,
                    'description' => $description,
                    'label' => $label,
                    'icon_key' => $icon,
                    'settings' => $settings ?: null,
                    'is_active' => true,
                    'sort_order' => $order,
                ],
            );
        }
    }

    /** @return array<string, EquipmentCategory> */
    private function seedCategories(): array
    {
        $categories = [
            ['compressors', 'كباسات', 'كباسات نصف مغلقة', 'compressor-green.png', 'كباس تبريد نصف مغلق باللون الأخضر', 'sq', 1],
            ['coils', 'كويلات', 'كويلات تبريد وتجميد', 'coil-white.png', 'كويل تبريد أبيض بمروحتين', 'wide', 2],
            ['units', 'وحدات تبريد', 'وحدات متكاملة وجاهزة', 'condensing-unit-green.png', 'وحدة تكثيف خضراء متكاملة', 'wide', 3],
            ['condensers', 'كوندنسرات', 'مكثفات هواء عالية الكفاءة', 'condenser-blue.png', 'كوندنسر هواء أزرق بمروحتين', 'wide', 4],
        ];

        $map = [];

        foreach ($categories as [$slug, $name, $desc, $image, $alt, $shape, $order]) {
            $map[$slug] = EquipmentCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'short_description' => $desc,
                    'image' => 'mas-cool-assets/'.$image,
                    'image_alt' => $alt,
                    'media_shape' => $shape,
                    'is_active' => true,
                    'sort_order' => $order,
                ],
            );
        }

        return $map;
    }

    /** @param array<string, EquipmentCategory> $categories */
    private function seedProducts(array $categories): void
    {
        $products = [
            ['air-condenser', 'condensers', 'كوندنسر هواء', 'مكثفات هوائية', 'مكثف هواء صناعي بمواصفات عالية وتبريد ثابت.', 'condenser-blue.png', 'كوندنسر هواء صناعي أزرق بمروحتين', 'wide', 1],
            ['cooling-coil', 'coils', 'كويل تبريد', 'تبريد وتجميد', 'كويل هواء للتبريد والتجميد بمقاسات وقدرات متعددة.', 'coil-white.png', 'كويل تبريد أبيض بمروحتين', 'wide', 2],
            ['semi-hermetic-compressor', 'compressors', 'كباس نصف مغلق', 'كباسات تبريد', 'كباس صناعي عالي الكفاءة، اسأل عن القدرة والحالة.', 'compressor-green.png', 'كباس تبريد نصف مغلق أخضر', 'square', 3],
            ['condensing-unit', 'units', 'وحدة تكثيف', 'وحدات تبريد', 'وحدة تكثيف متكاملة وجاهزة لمتطلبات المشروع.', 'condensing-unit-green.png', 'وحدة تكثيف خضراء متكاملة', 'wide', 4],
            ['freezing-coil', 'coils', 'كويل تجميد', 'كويلات متعددة المراوح', 'كويل تجميد صناعي بأربع مراوح وقدرة تشغيل عالية.', 'coil-four-fan.png', 'كويل تجميد صناعي بأربع مراوح', 'xwide', 5],
            ['cooling-compressor', 'compressors', 'كباس تبريد', 'كباسات صناعية', 'كباس متعدد الاستخدامات، راجع الموديل والتوافر.', 'compressor-blue.png', 'كباس تبريد صناعي أزرق', 'square', 6],
        ];

        foreach ($products as [$slug, $categorySlug, $name, $kicker, $description, $image, $alt, $shape, $order]) {
            EquipmentProduct::updateOrCreate(
                ['slug' => $slug],
                [
                    'equipment_category_id' => $categories[$categorySlug]->id,
                    'name' => $name,
                    'kicker' => $kicker,
                    'description' => $description,
                    'image' => 'mas-cool-assets/'.$image,
                    'image_alt' => $alt,
                    'media_shape' => $shape,
                    'availability_label' => 'متاح للمعاينة',
                    'is_available' => true,
                    'is_featured' => false,
                    'specifications' => null,
                    'whatsapp_price_message' => "مرحبًا mas Cool، أرغب في معرفة السعر والتوافر والمواصفات الخاصة بـ {$name}.",
                    'whatsapp_details_message' => "مرحبًا mas Cool، أريد تفاصيل أكثر عن {$name}.",
                    'whatsapp_specs_message' => "مرحبًا mas Cool، أريد المواصفات الفنية الكاملة لـ {$name}.",
                    'is_active' => true,
                    'sort_order' => $order,
                ],
            );
        }
    }
}
