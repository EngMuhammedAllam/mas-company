<?php

namespace App\Http\Controllers\Dashboard\Testimonial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Testimonial\UpdateSectionTestimonialRequest;
use App\Models\Testimonials\SectionTestimonial;
use App\Services\Dashboard\Testimonial\TestimonialSectionService;

class SectionTestimonialController extends Controller
{
    protected $sectionService;

    public function __construct(TestimonialSectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectionTestimonial = $this->sectionService->getSectionTestimonial();
        $testimonials = $this->sectionService->getTestimonials($sectionTestimonial);
        return view('dashboard.testimonials.index', compact('sectionTestimonial', 'testimonials'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SectionTestimonial $sectionTestimonial)
    {
        $sectionTestimonial = $this->sectionService->getSectionTestimonial();
        return view('dashboard.testimonials.section-edit', compact('sectionTestimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionTestimonialRequest $request, SectionTestimonial $sectionTestimonial)
    {
        $this->sectionService->updateSectionTestimonial($request->validated());
        return redirect()->route('section_testimonials.index')->with('success', 'تم تحديث قسم الشهادات بنجاح.');
    }
}
