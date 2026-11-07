<?php

namespace App\Services\Dashboard\Testimonial;

use App\Models\Testimonials\Testimonial;

class TestimonialService
{
    public function createTestimonial(array $data): Testimonial
    {
        return Testimonial::create([
            'name' => $data['name'],
            'message' => $data['message'],
            'position' => $data['position'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'section_testimonial_id' => 1, // Logic preservation: hardcoded 1
            'active' => isset($data['is_active']) && $data['is_active'] === 'on' ? 1 : 0,
        ]);
    }

    public function updateTestimonial(Testimonial $testimonial, array $data): bool
    {
        return $testimonial->update([
            'name' => $data['name'],
            'message' => $data['message'],
            'position' => $data['position'] ?? null, // Controller didn't use null coalescing for optional fields in update, but typically update expects valid data or keeps old. However, request has rules.
            // Original code: 'position' => $request->position
            // If field not present in request, update might set it to null if nullable or ignore?
            // Actually request usually includes all input.
            // Let's stick to explicitly passing what's validated.
            // Wait, validated data array keys exist if valid.
            'sort_order' => $data['sort_order'] ?? $testimonial->sort_order, // fallback safe
            'active' => isset($data['is_active']) && $data['is_active'] === 'on' ? 1 : 0,
        ]);
    }

    public function deleteTestimonial(Testimonial $testimonial): ?bool
    {
        return $testimonial->delete();
    }

    public function getTestimonialById($id)
    {
        return Testimonial::findOrFail($id);
    }
}
