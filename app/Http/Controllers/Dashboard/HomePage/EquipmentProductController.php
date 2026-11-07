<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HomePage\EquipmentProductRequest;
use App\Models\HomePage\EquipmentCategory;
use App\Models\HomePage\EquipmentProduct;
use App\Services\Dashboard\HomePage\HomePageContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipmentProductController extends Controller
{
    public function __construct(private readonly HomePageContentService $content)
    {
    }

    public function index(Request $request): View
    {
        $products = EquipmentProduct::query()
            ->with('category:id,name')
            ->when($request->filled('q'), fn ($q) => $q->where(function ($w) use ($request) {
                $term = '%'.$request->string('q').'%';
                $w->where('name', 'like', $term)->orWhere('kicker', 'like', $term)->orWhere('description', 'like', $term);
            }))
            ->when($request->filled('category'), fn ($q) => $q->where('equipment_category_id', $request->integer('category')))
            ->when($request->filled('availability'), fn ($q) => $q->where('is_available', $request->get('availability') === 'available'))
            ->when($request->filled('status'), fn ($q) => $q->where('is_active', $request->get('status') === 'active'))
            ->when($request->filled('featured'), fn ($q) => $q->where('is_featured', $request->get('featured') === 'yes'))
            ->ordered()
            ->paginate(12)
            ->withQueryString();

        return view('dashboard.mascool.products.index', [
            'products' => $products,
            'categories' => EquipmentCategory::ordered()->get(),
            'filters' => $request->only(['q', 'category', 'availability', 'status', 'featured']),
        ]);
    }

    public function create(): View
    {
        return view('dashboard.mascool.products.form', [
            'product' => new EquipmentProduct([
                'is_active' => true,
                'is_available' => true,
                'is_featured' => false,
                'media_shape' => EquipmentProduct::SHAPE_WIDE,
                'availability_label' => 'متاح للمعاينة',
                'sort_order' => 0,
            ]),
            'categories' => EquipmentCategory::ordered()->get(),
        ]);
    }

    public function store(EquipmentProductRequest $request): RedirectResponse
    {
        $data = $this->payload($request);
        $data['slug'] = $this->content->uniqueSlug('equipment_products', $data['slug'] ?? null, $data['name']);

        $this->content->save(new EquipmentProduct(), $data, $request->file('image'), 'products');

        return redirect()->route('admin.equipment.products.index')->with('success', 'تمت إضافة المعدة بنجاح.');
    }

    public function edit(EquipmentProduct $product): View
    {
        return view('dashboard.mascool.products.form', [
            'product' => $product,
            'categories' => EquipmentCategory::ordered()->get(),
        ]);
    }

    public function update(EquipmentProductRequest $request, EquipmentProduct $product): RedirectResponse
    {
        $data = $this->payload($request);
        $data['slug'] = $this->content->uniqueSlug('equipment_products', $data['slug'] ?? $product->slug, $data['name'], $product->id);

        // no file on the request means the approved image stays untouched
        $this->content->save($product, $data, $request->file('image'), 'products');

        return redirect()->route('admin.equipment.products.index')->with('success', 'تم تحديث المعدة بنجاح.');
    }

    public function destroy(EquipmentProduct $product): RedirectResponse
    {
        $this->content->delete($product);

        return redirect()->route('admin.equipment.products.index')->with('success', 'تم حذف المعدة.');
    }

    public function toggle(EquipmentProduct $product): RedirectResponse
    {
        $product->update(['is_active' => ! $product->is_active]);
        $this->content->flushCache();

        return back()->with('success', $product->is_active ? 'تم تفعيل المعدة.' : 'تم إخفاء المعدة من الصفحة.');
    }

    /** @return array<string, mixed> */
    private function payload(EquipmentProductRequest $request): array
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');
        $data['is_available'] = $request->boolean('is_available');
        $data['is_featured'] = $request->boolean('is_featured');

        // drop blank specification rows
        $data['specifications'] = collect($data['specifications'] ?? [])
            ->filter(fn ($row) => filled($row['label'] ?? null) || filled($row['value'] ?? null))
            ->values()
            ->all() ?: null;

        return $data;
    }
}
