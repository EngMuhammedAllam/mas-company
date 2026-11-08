<?php

namespace App\Http\Controllers\Dashboard\HomePage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\HomePage\HomeSectionItemRequest;
use App\Http\Requests\Dashboard\HomePage\ReorderItemsRequest;
use App\Models\HomePage\HomeSection;
use App\Models\HomePage\HomeSectionItem;
use App\Services\Dashboard\HomePage\HomePageContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * Inline repeater rows (hero proofs, trust items, advice points,
 * process steps, FAQs). Always returns to the editor tab it came from.
 */
class HomeSectionItemController extends Controller
{
    public function __construct(private readonly HomePageContentService $content)
    {
    }

    public function store(HomeSectionItemRequest $request, HomeSection $section): RedirectResponse
    {
        $data = $this->payload($request);
        $data['home_section_id'] = $section->id;
        $data['sort_order'] = $data['sort_order']
            ?? ((int) $section->items()->max('sort_order') + 1);

        HomeSectionItem::create($data);
        $this->content->flushCache();

        return $this->back($section, 'تمت إضافة العنصر بنجاح.');
    }

    public function update(HomeSectionItemRequest $request, HomeSection $section, HomeSectionItem $item): RedirectResponse
    {
        abort_unless($item->home_section_id === $section->id, 404);

        $item->update($this->payload($request));
        $this->content->flushCache();

        return $this->back($section, 'تم تحديث العنصر بنجاح.');
    }

    public function destroy(HomeSection $section, HomeSectionItem $item): RedirectResponse
    {
        abort_unless($item->home_section_id === $section->id, 404);

        $item->delete();
        $this->content->flushCache();

        return $this->back($section, 'تم حذف العنصر.');
    }

    public function toggle(HomeSection $section, HomeSectionItem $item): RedirectResponse
    {
        abort_unless($item->home_section_id === $section->id, 404);

        $item->update(['is_active' => ! $item->is_active]);
        $this->content->flushCache();

        return $this->back($section, $item->is_active ? 'تم تفعيل العنصر.' : 'تم إخفاء العنصر.');
    }

    /** Move one row up or down, swapping sort_order with its neighbour. */
    public function reorder(ReorderItemsRequest $request, HomeSection $section, HomeSectionItem $item): RedirectResponse
    {
        abort_unless($item->home_section_id === $section->id, 404);

        $direction = $request->validated('direction');

        DB::transaction(function () use ($section, $item, $direction) {
            $siblings = $section->items()->where('type', $item->type)->get()->values();
            $index = $siblings->search(fn ($row) => $row->id === $item->id);
            $target = $direction === 'up' ? $index - 1 : $index + 1;

            if ($index === false || $target < 0 || $target >= $siblings->count()) {
                return;
            }

            // rewrite the whole list so gaps and duplicates cannot accumulate
            $reordered = $siblings->all();
            [$reordered[$index], $reordered[$target]] = [$reordered[$target], $reordered[$index]];

            foreach ($reordered as $position => $row) {
                $row->update(['sort_order' => $position + 1]);
            }
        });

        $this->content->flushCache();

        return $this->back($section, 'تم تغيير الترتيب.');
    }

    /** @return array<string, mixed> */
    private function payload(HomeSectionItemRequest $request): array
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        if ($request->has('is_final')) {
            $data['settings'] = array_replace($data['settings'] ?? [], ['is_final' => $request->boolean('is_final')]);
        }

        return $data;
    }

    private function back(HomeSection $section, string $message): RedirectResponse
    {
        return redirect()
            ->route('admin.home.editor', ['section' => $section->key])
            ->with('success', $message);
    }
}
