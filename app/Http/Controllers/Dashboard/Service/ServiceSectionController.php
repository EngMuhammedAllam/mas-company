<?php

namespace App\Http\Controllers\Dashboard\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\UpdateServiceSectionRequest;
use App\Services\Dashboard\Service\ServiceSectionService;

class ServiceSectionController extends Controller
{
    protected $serviceSectionService;

    public function __construct(ServiceSectionService $serviceSectionService)
    {
        $this->serviceSectionService = $serviceSectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceSection = $this->serviceSectionService->getServiceSection();
        $services = $this->serviceSectionService->getServices($serviceSection);

        return view('dashboard.services.index', get_defined_vars());
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $serviceSection = $this->serviceSectionService->getServiceSectionById($id);
        return view('dashboard.services.section-service-edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceSectionRequest $request, $id)
    {
        $serviceSection = $this->serviceSectionService->getServiceSectionById($id);

        $this->serviceSectionService->updateServiceSection($serviceSection, $request->validated());

        return redirect()->route('section_services.index')->with('success', 'تم تحديث قسم الخدمات بنجاح.');
    }
}
