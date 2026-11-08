{{-- Inline repeater for a section's items. Never gets its own dashboard page. --}}
@php
    use App\Models\HomePage\HomeSectionItem;

    $items = $section->items->where('type', $type)->values();
    $limit = HomeSectionItem::TYPE_LIMITS[$type] ?? null;
    $activeCount = $items->where('is_active', true)->count();
    $overLimit = $limit !== null && $activeCount > $limit;

    // per-type field labels so one partial serves five different repeaters
    $copy = [
        'hero_proof'    => ['title' => 'نص الميزة', 'desc' => null, 'label' => null, 'icon' => false],
        'trust_item'    => ['title' => 'العنوان', 'desc' => 'الوصف', 'label' => null, 'icon' => true],
        'advice_point'  => ['title' => 'العنوان', 'desc' => 'الوصف', 'label' => 'الرقم المعروض', 'icon' => false],
        'process_step'  => ['title' => 'عنوان الخطوة', 'desc' => 'وصف الخطوة', 'label' => 'رقم الخطوة', 'icon' => true],
        'faq_item'      => ['title' => 'السؤال', 'desc' => 'الإجابة', 'label' => null, 'icon' => false],
    ][$type];
@endphp

<section class="card">
    <div class="card__head">
        <div>
            <h2>{{ HomeSectionItem::TYPE_LABELS[$type] }}</h2>
            <p>{{ $items->count() }} عنصر — {{ $activeCount }} ظاهر</p>
        </div>
    </div>
    <div class="card__body">
        @if($limit)
            <p class="limit-note {{ $overLimit ? 'is-over' : '' }}">
                التصميم يستوعب {{ $limit }} عناصر ظاهرة.
                @if($overLimit) لديك {{ $activeCount }} عنصر ظاهر — قد يتأثر شكل الصفحة. @endif
            </p>
        @endif

        @forelse($items as $i => $item)
            <div class="rep">
                <div class="rep__head">
                    <span class="rep__index">{{ $i + 1 }}</span>
                    <span class="rep__title">{{ $item->title }}</span>
                    <span class="rep__tools">
                        {{-- reorder --}}
                        <form method="POST" action="{{ route('admin.home.items.reorder', [$section->key, $item]) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="direction" value="up">
                            <button class="icon-btn" type="submit" aria-label="تحريك لأعلى" @disabled($i === 0)>↑</button>
                        </form>
                        <form method="POST" action="{{ route('admin.home.items.reorder', [$section->key, $item]) }}">
                            @csrf @method('PATCH')
                            <input type="hidden" name="direction" value="down">
                            <button class="icon-btn" type="submit" aria-label="تحريك لأسفل" @disabled($i === $items->count() - 1)>↓</button>
                        </form>
                        {{-- active toggle --}}
                        <form method="POST" action="{{ route('admin.home.items.toggle', [$section->key, $item]) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="badge {{ $item->is_active ? 'badge--on' : 'badge--off' }}"
                                    style="border:0;cursor:pointer;min-height:32px">{{ $item->is_active ? 'ظاهر' : 'مخفي' }}</button>
                        </form>
                        {{-- delete --}}
                        <form method="POST" action="{{ route('admin.home.items.destroy', [$section->key, $item]) }}"
                              data-confirm="سيتم حذف «{{ $item->title }}» نهائيًا. هل أنت متأكد؟">
                            @csrf @method('DELETE')
                            <button class="icon-btn" type="submit" aria-label="حذف العنصر" style="color:#b3261e">✕</button>
                        </form>
                    </span>
                </div>

                <form method="POST" action="{{ route('admin.home.items.update', [$section->key, $item]) }}" class="rep__body">
                    @csrf @method('PUT')
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="hidden" name="is_active" value="{{ $item->is_active ? 1 : 0 }}">
                    <div class="form-grid">
                        <div class="field {{ $copy['desc'] ? '' : 'field--full' }}">
                            <label for="t-{{ $item->id }}">{{ $copy['title'] }} *</label>
                            <input type="text" id="t-{{ $item->id }}" name="title" value="{{ $item->title }}" required>
                        </div>
                        @if($copy['label'])
                            <div class="field">
                                <label for="l-{{ $item->id }}">{{ $copy['label'] }}</label>
                                <input type="text" id="l-{{ $item->id }}" name="label" value="{{ $item->label }}" dir="ltr">
                            </div>
                        @endif
                        @if($copy['icon'])
                            <div class="field">
                                <label for="i-{{ $item->id }}">الأيقونة</label>
                                <select id="i-{{ $item->id }}" name="icon_key">
                                    <option value="">بدون</option>
                                    @foreach($iconKeys as $key)
                                        <option value="{{ $key }}" @selected($item->icon_key === $key)>{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if($copy['desc'])
                            <div class="field field--full">
                                <label for="d-{{ $item->id }}">{{ $copy['desc'] }}</label>
                                <textarea id="d-{{ $item->id }}" name="description" rows="2">{{ $item->description }}</textarea>
                            </div>
                        @endif
                        @if($type === 'process_step')
                            <div class="field field--full">
                                <label class="switch">
                                    <input type="checkbox" name="is_final" value="1" @checked($item->isFinal())>
                                    <span class="switch__track"></span> خطوة ختامية (تأخذ اللون الليموني)
                                </label>
                            </div>
                        @endif
                    </div>
                    <button class="btn btn--outline btn--sm" type="submit" style="margin-top:10px">حفظ العنصر</button>
                </form>
            </div>
        @empty
            <div class="empty">
                <h3>لا توجد عناصر بعد</h3>
                <p>أضف أول عنصر من النموذج بالأسفل.</p>
            </div>
        @endforelse

        {{-- add new --}}
        <form method="POST" action="{{ route('admin.home.items.store', $section->key) }}" class="rep-add">
            @csrf
            <input type="hidden" name="type" value="{{ $type }}">
            <input type="hidden" name="is_active" value="1">
            <strong style="display:block;font-size:13.5px;margin-bottom:10px">إضافة عنصر جديد</strong>
            <div class="form-grid">
                <div class="field {{ $copy['desc'] ? '' : 'field--full' }}">
                    <label for="new-title-{{ $type }}">{{ $copy['title'] }} *</label>
                    <input type="text" id="new-title-{{ $type }}" name="title" value="{{ old('title') }}"
                           class="{{ $errors->has('title') ? 'is-invalid' : '' }}" required>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'title'])
                </div>
                @if($copy['label'])
                    <div class="field">
                        <label for="new-label-{{ $type }}">{{ $copy['label'] }}</label>
                        <input type="text" id="new-label-{{ $type }}" name="label" value="{{ old('label') }}" dir="ltr">
                    </div>
                @endif
                @if($copy['icon'])
                    <div class="field">
                        <label for="new-icon-{{ $type }}">الأيقونة</label>
                        <select id="new-icon-{{ $type }}" name="icon_key">
                            <option value="">بدون</option>
                            @foreach($iconKeys as $key)<option value="{{ $key }}">{{ $key }}</option>@endforeach
                        </select>
                    </div>
                @endif
                @if($copy['desc'])
                    <div class="field field--full">
                        <label for="new-desc-{{ $type }}">{{ $copy['desc'] }}</label>
                        <textarea id="new-desc-{{ $type }}" name="description" rows="2">{{ old('description') }}</textarea>
                    </div>
                @endif
            </div>
            <button class="btn btn--primary btn--sm" type="submit" style="margin-top:10px">إضافة</button>
        </form>
    </div>
</section>
