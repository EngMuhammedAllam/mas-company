<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\HomePage\WhatsappInteraction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Anonymous CTA analytics.
 *
 * Deliberately records only which button was pressed and for which product.
 * No message body, phone number, IP address or user agent is persisted.
 */
class WhatsappTrackingController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'source' => ['required', 'string', Rule::in(WhatsappInteraction::SOURCES)],
            'action_type' => ['nullable', 'string', Rule::in(WhatsappInteraction::ACTION_TYPES)],
            'equipment_product_id' => ['nullable', 'integer', 'exists:equipment_products,id'],
        ]);

        WhatsappInteraction::create([
            'source' => $data['source'],
            'action_type' => $data['action_type'] ?? 'contact',
            'equipment_product_id' => $data['equipment_product_id'] ?? null,
        ]);

        return response()->json(['ok' => true], 202);
    }
}
