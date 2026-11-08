@extends('dashboard.mascool.layouts.app')
@section('title', 'تصنيفات المعدات')

@section('content')
@php use App\Support\HomeMedia; @endphp

<div class="page-head">
    <div class="page-head__text">
        <h1>تصنيفات المعدات</h1>
        <p>تظهر كبطاقات في قسم «تصفح حسب النوع» وكأزرار تصفية في قسم المعدات.</p>
    </div>
    <a class="btn btn--primary" href="{{ route('admin.equipment.categories.create') }}">إضافة تصنيف</a>
</div>

<section class="card">
    <div class="table-wrap">
        <table class="tbl">
            <thead><tr><th>الصورة</th><th>الاسم</th><th>المعرّف</th><th>عدد المعدات</th><th>الحالة</th><th>الترتيب</th><th>إجراءات</th></tr></thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td data-label="الصورة"><img class="thumb" src="{{ HomeMedia::url($category->image) }}" alt="{{ $category->image_alt }}" loading="lazy"></td>
                    <td data-label="الاسم"><strong>{{ $category->name }}</strong><br><span style="font-size:11.5px;color:var(--muted)">{{ $category->short_description }}</span></td>
                    <td data-label="المعرّف"><code>{{ $category->slug }}</code></td>
                    <td data-label="عدد المعدات"><span class="badge badge--navy">{{ $category->products_count }}</span></td>
                    <td data-label="الحالة">
                        @include('dashboard.mascool.partials.toggle-form', [
                            'action' => route('admin.equipment.categories.toggle', $category),
                            'active' => $category->is_active,
                        ])
                    </td>
                    <td data-label="الترتيب">{{ $category->sort_order }}</td>
                    <td data-label="إجراءات">
                        <div class="row-actions">
                            <a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.categories.edit', $category) }}">تعديل</a>
                            <form method="POST" action="{{ route('admin.equipment.categories.destroy', $category) }}"
                                  data-confirm="سيتم حذف تصنيف «{{ $category->name }}». هل أنت متأكد؟">
                                @csrf @method('DELETE')
                                <button class="btn btn--danger btn--sm" type="submit">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7"><div class="empty"><h3>لا توجد تصنيفات</h3><p>أضف أول تصنيف للمعدات.</p>
                    <a class="btn btn--primary" href="{{ route('admin.equipment.categories.create') }}">إضافة تصنيف</a></div></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
