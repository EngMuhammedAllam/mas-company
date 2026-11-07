<?php

namespace App\Http\Controllers\Dashboard\Counter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Counter\StoreCounterRequest;
use App\Http\Requests\Dashboard\Counter\UpdateCounterRequest;
use App\Models\Counter\Counter;
use App\Services\Dashboard\Counter\CounterService;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    protected $counterService;

    public function __construct(CounterService $counterService)
    {
        $this->counterService = $counterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counters = $this->counterService->getAllCounters();
        return view('dashboard.counters.index', compact('counters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.counters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCounterRequest $request)
    {
        $this->counterService->createCounter($request->validated());

        return redirect()->route('admin.counters.index')->with('success', 'Counter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Counter $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $counter = Counter::findOrFail($request->id);
        return view('dashboard.counters.edit', compact('counter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCounterRequest $request)
    {
        $counter = Counter::findOrFail($request->id);

        $this->counterService->updateCounter($counter, $request->validated());

        return redirect()->route('admin.counters.index')->with('success', 'Counter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $counter = Counter::findOrFail($request->id);
        $this->counterService->deleteCounter($counter);
        return redirect()->route('admin.counters.index')->with('success', 'Counter deleted successfully.');
    }
}
