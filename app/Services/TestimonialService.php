<?php

namespace App\Services;

use App\Repositories\Interfaces\SectionTestimonialRepositoryInterface;
use App\Models\Testimonials\SectionTestimonial;
use App\Models\Testimonials\Testimonial;

class TestimonialService
{
    protected $sectionRepo;

    public function __construct(SectionTestimonialRepositoryInterface $sectionRepo)
    {
        $this->sectionRepo = $sectionRepo;
    }

    public function getSectionData()
    {
        return $this->sectionRepo->first();
    }

    public function updateSection(array $data)
    {
        $section = $this->sectionRepo->first();
        if (!$section) {
            return $this->sectionRepo->create($data);
        }
        return $section->update($data);
    }

    public function getAllTestimonials()
    {
        return Testimonial::latest()->get();
    }

    public function createTestimonial(array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('testimonials', 'public');
        }
        return Testimonial::create($data);
    }

    public function updateTestimonial(Testimonial $testimonial, array $data)
    {
        if (isset($data['image']) && is_object($data['image'])) {
            $data['image'] = $data['image']->store('testimonials', 'public');
        }
        return $testimonial->update($data);
    }

    public function deleteTestimonial(Testimonial $testimonial)
    {
        return $testimonial->delete();
    }
}
