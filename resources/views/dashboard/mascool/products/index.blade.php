@extends('dashboard.mascool.layouts.app')
@section('title', 'المعدات')
@section('breadcrumb', 'المعدات')

@section('content')
@php use App\Support\HomeMedia; @endphp

<div class="page-head">
    <div class="page-head__text">
        <h1>المعدات</h1>
        <p>{{ $products->total() }} معدة — ترتيب العرض على الصفحة الرئيسية يتبع حقل «الترتيب».</p>
    </div>
    <a class="btn btn--primary" href="{{ route('admin.equipment.products.create') }}">إضافة معدة</a>
</div>

<section class="card" style="margin-bottom:16px">
    <div class="card__body">
        <form method="GET" action="{{ route('admin.equipment.products.index') }}" class="filterbar">
            <div class="field">
                <label for="f-q">بحث</label>
                <input type="text" id="f-q" name="q" value="{{ $filters['q'] ?? '' }}" placeholder="اسم المعدة أو الوصف">
            </div>
            <div class="field">
                <label for="f-cat">التصنيف</label>
                <select id="f-cat" name="category">
                    <option value="">كل التصنيفات</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(($filters['category'] ?? '') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="f-av">التوافر</label>
                <select id="f-av" name="availability">
                    <option value="">الكل</option>
                    <option value="available" @selected(($filters['availability'] ?? '') === 'available')>متاح للمعاينة</option>
                    <option value="unavailable" @selected(($filters['availability'] ?? '') === 'unavailable')>غير متاح</option>
                </select>
            </div>
            <div class="field">
                <label for="f-st">الحالة</label>
                <select id="f-st" name="status">
                    <option value="">الكل</option>
                    <option value="active" @selected(($filters['status'] ?? '') === 'active')>ظاهر</option>
                    <option value="inactive" @selected(($filters['status'] ?? '') === 'inactive')>مخفي</option>
                </select>
            </div>
            <div class="field">
                <label for="f-ft">مميّز</label>
                <select id="f-ft" name="featured">
                    <option value="">الكل</option>
                    <option value="yes" @selected(($filters['featured'] ?? '') === 'yes')>مميّز</option>
                    <option value="no" @selected(($filters['featured'] ?? '') === 'no')>غير مميّز</option>
                </select>
            </div>
            <div class="field" style="flex:0 0 auto">
                <button class="btn btn--dark" type="submit">تصفية</button>
            </div>
            @if(array_filter($filters))
                <div class="field" style="flex:0 0 auto">
                    <a class="btn btn--outline" href="{{ route('admin.equipment.products.index') }}">إلغاء</a>
                </div>
            @endif
        </form>
    </div>
</section>

<section class="card">
    <div class="table-wrap">
        <table class="tbl">
            <thead>
            <tr>
                <th>الصورة</th><th>الاسم</th><th>التصنيف</th><th>التوافر</th><th>الحالة</th>
                <th>مميّز</th><th>الترتيب</th><th>آخر تحديث</th><th>إجراءات</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td data-label="الصورة"><img class="thumb" src="{{ HomeMedia::url($product->image) }}" alt="{{ $product->image_alt ?: $product->name }}" loading="lazy"></td>
                    <td data-label="الاسم"><strong>{{ $product->name }}</strong><br><span style="font-size:11.5px;color:var(--muted)">{{ $product->kicker }}</span></td>
                    <td data-label="التصنيف">{{ $product->category?->name ?? '—' }}</td>
                    <td data-label="التوافر">
                        <span class="badge {{ $product->is_available ? 'badge--on' : 'badge--off' }}">{{ $product->is_available ? ($product->availability_label ?: 'متاح') : 'غير متاح' }}</span>
                    </td>
                    <td data-label="الحالة">
                        @include('dashboard.mascool.partials.toggle-form', [
                            'action' => route('admin.equipment.products.toggle', $product),
                            'active' => $product->is_active,
                        ])
                    </td>
                    <td data-label="مميّز">@if($product->is_featured)<span class="badge badge--star">مميّز</span>@else<span style="color:var(--muted-soft)">—</span>@endif</td>
                    <td data-label="الترتيب">{{ $product->sort_order }}</td>
                    <td data-label="آخر تحديث"><span style="font-size:12px;color:var(--muted)">{{ $product->updated_at?->format('Y-m-d') }}</span></td>
                    <td data-label="إجراءات">
                        <div class="row-actions">
                            <a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.products.edit', $product) }}">تعديل</a>
                            <a class="btn btn--outline btn--sm" href="{{ route('landing') }}#equipment" target="_blank" rel="noopener">معاينة</a>
                            <form method="POST" action="{{ route('admin.equipment.products.destroy', $product) }}"
                                  data-confirm="سيتم حذف «{{ $product->name }}» نهائيًا. هل أنت متأكد؟">
                                @csrf @method('DELETE')
                                <button class="btn btn--danger btn--sm" type="submit">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9">
                    <div class="empty">
                        <h3>لا توجد معدات مطابقة</h3>
                        <p>جرّب تعديل عوامل التصفية، أو أضف معدة جديدة.</p>
                        <a class="btn btn--primary" href="{{ route('admin.equipment.products.create') }}">إضافة معدة</a>
                    </div>
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>

@if($products->hasPages())
    <nav class="pager" aria-label="تنقل الصفحات">
        {{ $products->links('dashboard.mascool.partials.pagination') }}
    </nav>
@endif
@endsection
