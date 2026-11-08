<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentProduct extends Model
{
    public const SHAPE_SQUARE = 'square';
    public const SHAPE_WIDE = 'wide';
    public const SHAPE_XWIDE = 'xwide';

    public const SHAPES = [
        self::SHAPE_SQUARE,
        self::SHAPE_WIDE,
        self::SHAPE_XWIDE,
    ];

    /** Arabic labels used by the dashboard UI. */
    public const SHAPE_LABELS = [
        self::SHAPE_SQUARE => 'مربّع (كباسات)',
        self::SHAPE_WIDE => 'عريض (كويلات وكوندنسرات)',
        self::SHAPE_XWIDE => 'عريض جدًا (متعدد المراوح)',
    ];

    /**
     * The home page CSS uses .media--sq / .media--wide / .media--xwide.
     * Only the square shape differs from the stored value.
     */
    public const SHAPE_CSS = [
        self::SHAPE_SQUARE => 'sq',
        self::SHAPE_WIDE => 'wide',
        self::SHAPE_XWIDE => 'xwide',
    ];

    protected $fillable = [
        'equipment_category_id',
        'name',
        'slug',
        'kicker',
        'description',
        'image',
        'image_alt',
        'media_shape',
        'availability_label',
        'is_available',
        'is_featured',
        'specifications',
        'whatsapp_price_message',
        'whatsapp_details_message',
        'whatsapp_specs_message',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_available' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /** CSS modifier for the media well on the home page. */
    public function mediaShapeClass(): string
    {
        return self::SHAPE_CSS[$this->media_shape] ?? 'wide';
    }
}
