<?php

namespace App\Http\Controllers\Dashboard\Cta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Cta\UpdateCtaSectionRequest;
use App\Services\Dashboard\Cta\CtaSectionService;

class CtaSectionController extends Controller
{
    protected $ctaService;

    public function __construct(CtaSectionService $ctaService)
    {
        $this->ctaService = $ctaService;
    }

    public function edit()
    {
        $cta = $this->ctaService->getCtaSection();
        return view('dashboard.cta.edit', compact('cta'));
    }

    public function update(UpdateCtaSectionRequest $request)
    {
        $this->ctaService->updateCtaSection($request->validated());

        return redirect()->back()->with('success', 'CTA section updated successfully.');
    }
}
