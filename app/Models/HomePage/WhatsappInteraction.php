<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Anonymous CTA analytics. Never stores customer content or identifiers.
 */
class WhatsappInteraction extends Model
{
    public const UPDATED_AT = null;

    /** Sources accepted from the public site. Anything else is rejected. */
    public const SOURCES = [
        'header_cta',
        'mobile_cta',
        'hero_booking',
        'equipment_help',
        'product_price',
        'product_details',
        'product_specs',
        'visit_booking',
        'inquiry_form',
        'floating_button',
        'footer_quote',
    ];

    public const ACTION_TYPES = [
        'quote',
        'booking',
        'details',
        'specs',
        'help',
        'inquiry',
        'contact',
    ];

    protected $fillable = [
        'source',
        'equipment_product_id',
        'action_type',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(EquipmentProduct::class, 'equipment_product_id');
    }
}
