<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HomePage\EquipmentCategoryRequest;
use App\Models\HomePage\EquipmentCategory;
use App\Services\Dashboard\HomePage\HomePageContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EquipmentCategoryController extends Controller
{
    public function __construct(private readonly HomePageContentService $content)
    {
    }

    public function index(): View
    {
        return view('dashboard.mascool.categories.index', [
            'categories' => EquipmentCategory::withCount('products')->ordered()->get(),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.mascool.categories.form', [
            'category' => new EquipmentCategory(['is_active' => true, 'media_shape' => 'wide', 'sort_order' => 0]),
        ]);
    }

    public function store(EquipmentCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = $this->content->uniqueSlug('equipment_categories', $data['slug'] ?? null, $data['name']);

        $this->content->save(new EquipmentCategory(), $data, $request->file('image'), 'categories');

        return redirect()->route('admin.equipment.categories.index')->with('success', 'تمت إضافة التصنيف بنجاح.');
    }

    public function edit(EquipmentCategory $category): View
    {
        return view('dashboard.mascool.categories.form', compact('category'));
    }

    public function update(EquipmentCategoryRequest $request, EquipmentCategory $category): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['slug'] = $this->content->uniqueSlug('equipment_categories', $data['slug'] ?? $category->slug, $data['name'], $category->id);

        $this->content->save($category, $data, $request->file('image'), 'categories');

        return redirect()->route('admin.equipment.categories.index')->with('success', 'تم تحديث التصنيف بنجاح.');
    }

    public function destroy(EquipmentCategory $category): RedirectResponse
    {
        if ($category->products()->exists()) {
            return back()->with('error', 'لا يمكن حذف تصنيف يحتوي على معدات. انقل المعدات أولًا أو احذفها.');
        }

        $this->content->delete($category);

        return redirect()->route('admin.equipment.categories.index')->with('success', 'تم حذف التصنيف.');
    }

    public function toggle(EquipmentCategory $category): RedirectResponse
    {
        $category->update(['is_active' => ! $category->is_active]);
        $this->content->flushCache();

        return back()->with('success', $category->is_active ? 'تم تفعيل التصنيف.' : 'تم إخفاء التصنيف.');
    }
}
