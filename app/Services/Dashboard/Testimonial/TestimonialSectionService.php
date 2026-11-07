<?php

namespace App\Services\Dashboard\Testimonial;

use App\Models\Testimonials\SectionTestimonial;

class TestimonialSectionService
{
    public function getSectionTestimonial()
    {
        return SectionTestimonial::first();
    }

    public function getTestimonials(SectionTestimonial $section = null)
    {
        $section = $section ?? $this->getSectionTestimonial();
        return $section ? $section->testimonials()->latest()->get() : collect();
    }

    public function updateSectionTestimonial(array $data): bool
    {
        // Logic preservation: Controller logic was: $sectionTestimonial->first()->update(...)
        // Effectively updating the first record regardless of ID passed in URL
        return SectionTestimonial::first()->update([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);
    }

    public function getSectionById($id)
    {
        // Not used for update logic originally (it did first()) but might be needed for edit view
        return SectionTestimonial::findOrFail($id); // Or first() depending on usage
    }
}
