<?php

namespace App\Http\Controllers\Dashboard\Hero;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HeroSection\UpdateHeroSectionRequest;
use App\Services\Dashboard\HeroSection\HeroSectionService;

class HeroSectionController extends Controller
{
    protected $heroSectionService;

    public function __construct(HeroSectionService $heroSectionService)
    {
        $this->heroSectionService = $heroSectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSection = $this->heroSectionService->getHeroSection();
        return view('dashboard.hero.index', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroSectionRequest $request)
    {
        $this->heroSectionService->updateHeroSection(
            $request->validated(),
            $request->file('image')
        );

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }
}
