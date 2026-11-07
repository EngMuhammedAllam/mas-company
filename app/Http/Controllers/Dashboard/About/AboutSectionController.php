<?php

namespace App\Http\Controllers\Dashboard\About;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\About\StoreAboutPointRequest;
use App\Http\Requests\Dashboard\About\UpdateAboutSectionRequest;
use App\Services\Dashboard\About\AboutSectionService;

class AboutSectionController extends Controller
{
    protected $aboutService;

    public function __construct(AboutSectionService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    public function edit()
    {
        $about = $this->aboutService->getAboutSection();
        $points = $this->aboutService->getAboutPoints($about->id);
        return view('dashboard.about.edit', compact('about', 'points'));
    }

    public function update(UpdateAboutSectionRequest $request)
    {
        $this->aboutService->updateAboutSection(
            $request->validated(),
            $request->file('image1'),
            $request->file('image2'),
            $request->file('image3')
        );

        return redirect()->back()->with('success', 'About section updated successfully.');
    }

    public function storePoint(StoreAboutPointRequest $request)
    {
        $point = $this->aboutService->createPoint($request->validated());

        if (!$point) {
            return redirect()->back()->with('error', 'Please save about section first');
        }

        return redirect()->back()->with('success', 'Point added successfully');
    }

    public function destroyPoint($id)
    {
        $this->aboutService->deletePoint($id);
        return redirect()->back()->with('success', 'Point deleted successfully');
    }
}
