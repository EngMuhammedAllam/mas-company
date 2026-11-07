<?php

namespace App\Http\Controllers\Dashboard\Feature;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Feature\StoreFeatureRequest;
use App\Http\Requests\Dashboard\Feature\UpdateFeatureRequest;
use App\Services\Dashboard\Feature\FeatureService;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    protected $featureService;

    public function __construct(FeatureService $featureService)
    {
        $this->featureService = $featureService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = $this->featureService->getAllFeatures();
        return view('dashboard.features.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        $this->featureService->createFeature($request->validated(), $request->file('image'));
        return redirect()->route('features.index')->with('success', 'تم إضافة الميزة بنجاح');
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
    public function edit(Request $request)
    {
        $feature = $this->featureService->getFeatureById($request->id);
        return view('dashboard.features.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, $id)
    {
        $this->featureService->updateFeature($id, $request->validated(), $request->file('image'));
        return redirect()->route('features.index')->with('success', 'تم تعديل الميزة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->featureService->deleteFeature($request->id);
        return redirect()->route('features.index')->with('success', 'تم حذف الميزة بنجاح');
    }
}
