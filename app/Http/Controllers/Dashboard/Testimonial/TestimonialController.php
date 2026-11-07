<?php

namespace App\Http\Controllers\Dashboard\Testimonial;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Dashboard\Testimonial\UpdateTestimonialRequest;
use App\Services\Dashboard\Testimonial\TestimonialService;

class TestimonialController extends Controller
{
    protected $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {
        $this->testimonialService->createTestimonial($request->validated());

        return redirect()->route('section_testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $testimonial = $this->testimonialService->getTestimonialById($id);
        return view('dashboard.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, $id)
    {
        $testimonial = $this->testimonialService->getTestimonialById($id);

        $this->testimonialService->updateTestimonial($testimonial, $request->validated());

        return redirect()->route('section_testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $testimonial = $this->testimonialService->getTestimonialById($id);
        $this->testimonialService->deleteTestimonial($testimonial);
        return redirect()->route('section_testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
