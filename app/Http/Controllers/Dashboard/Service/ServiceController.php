<?php

namespace App\Http\Controllers\Dashboard\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;
use App\Services\Dashboard\Service\ServiceService;

class ServiceController extends Controller
{
    protected $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $this->serviceService->createService(
            $request->validated(),
            $request->file('icon')
        );

        return redirect()->route('section_services.index')->with('success', 'تم اضافة الخدمة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = $this->serviceService->getServiceById($id);
        return view('dashboard.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, $id)
    {
        $service = $this->serviceService->getServiceById($id);

        $this->serviceService->updateService(
            $service,
            $request->validated(),
            $request->file('icon')
        );

        return redirect()->route('section_services.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = $this->serviceService->getServiceById($id);
        $this->serviceService->deleteService($service);

        return redirect()->route('section_services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
