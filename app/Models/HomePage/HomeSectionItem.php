<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A repeater row inside a home page section. Edited inline in the
 * central Home Page Editor — these never get their own dashboard page.
 */
class HomeSectionItem extends Model
{
    public const TYPE_HERO_PROOF = 'hero_proof';
    public const TYPE_TRUST_ITEM = 'trust_item';
    public const TYPE_ADVICE_POINT = 'advice_point';
    public const TYPE_PROCESS_STEP = 'process_step';
    public const TYPE_FAQ_ITEM = 'faq_item';

    /** Whitelist — anything else is rejected by validation. */
    public const TYPES = [
        self::TYPE_HERO_PROOF,
        self::TYPE_TRUST_ITEM,
        self::TYPE_ADVICE_POINT,
        self::TYPE_PROCESS_STEP,
        self::TYPE_FAQ_ITEM,
    ];

    /** Which section key each type belongs to. */
    public const TYPE_SECTION = [
        self::TYPE_HERO_PROOF => 'hero_benefits',
        self::TYPE_TRUST_ITEM => 'trust',
        self::TYPE_ADVICE_POINT => 'advice',
        self::TYPE_PROCESS_STEP => 'process',
        self::TYPE_FAQ_ITEM => 'faq',
    ];

    /** Soft design limit on active rows; the UI warns past this. */
    public const TYPE_LIMITS = [
        self::TYPE_HERO_PROOF => 3,
        self::TYPE_TRUST_ITEM => 3,
        self::TYPE_ADVICE_POINT => 3,
        self::TYPE_PROCESS_STEP => 3,
        self::TYPE_FAQ_ITEM => null,
    ];

    public const TYPE_LABELS = [
        self::TYPE_HERO_PROOF => 'مزايا الهيرو السريعة',
        self::TYPE_TRUST_ITEM => 'عناصر شريط الثقة',
        self::TYPE_ADVICE_POINT => 'نقاط لماذا mas Cool',
        self::TYPE_PROCESS_STEP => 'خطوات العمل',
        self::TYPE_FAQ_ITEM => 'الأسئلة الشائعة',
    ];

    /** Icons the public page actually ships as SVG symbols. */
    public const ICON_KEYS = ['globe', 'warehouse', 'support', 'check', 'calendar', 'search', 'note', 'snow'];

    protected $fillable = [
        'home_section_id',
        'type',
        'title',
        'description',
        'label',
        'icon_key',
        'image',
        'image_alt',
        'settings',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(HomeSection::class, 'home_section_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function setting(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }

    /** Process steps mark the final node with the lime accent. */
    public function isFinal(): bool
    {
        return (bool) $this->setting('is_final', false);
    }
}
