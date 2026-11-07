<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeSection extends Model
{
    /** Section keys rendered or configured by the mas Cool home page. */
    public const KEYS = [
        'general',
        'hero',
        'hero_benefits',
        'trust',
        'categories',
        'equipment',
        'visit',
        'advice',
        'process',
        'faq',
        'contact',
        'footer',
    ];

    /** Arabic tab labels for the central editor. */
    public const LABELS = [
        'general' => 'إعدادات عامة',
        'hero' => 'الهيرو',
        'hero_benefits' => 'مزايا الهيرو',
        'trust' => 'شريط الثقة',
        'categories' => 'قسم التصنيفات',
        'equipment' => 'قسم المعدات',
        'visit' => 'قسم المعاينة',
        'advice' => 'لماذا mas Cool',
        'process' => 'خطوات العمل',
        'faq' => 'الأسئلة الشائعة',
        'contact' => 'قسم التواصل',
        'footer' => 'الفوتر',
    ];

    /** Anchor used to scroll the live preview to this section. */
    public const PREVIEW_ANCHORS = [
        'hero' => '.hero',
        'hero_benefits' => '.hero__proof',
        'trust' => '.hero__trust',
        'categories' => '.categories-section',
        'equipment' => '#equipment',
        'visit' => '.visit',
        'advice' => '#about',
        'process' => '.process',
        'faq' => '.faq',
        'contact' => '#contact',
        'footer' => '.footer',
    ];

    protected $fillable = [
        'key',
        'eyebrow',
        'title',
        'highlighted_text',
        'description',
        'image',
        'image_alt',
        'button_text',
        'whatsapp_message',
        'secondary_button_text',
        'secondary_whatsapp_message',
        'settings',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(HomeSectionItem::class)->orderBy('sort_order')->orderBy('id');
    }

    public function activeItems(): HasMany
    {
        return $this->items()->where('is_active', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function getRouteKeyName(): string
    {
        return 'key';
    }

    /** Read a value out of the free-form settings bag. */
    public function setting(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }

    public function label(): string
    {
        return self::LABELS[$this->key] ?? $this->key;
    }

    /** The repeater type this section hosts, if any. */
    public function itemType(): ?string
    {
        return array_search($this->key, HomeSectionItem::TYPE_SECTION, true) ?: null;
    }
}
