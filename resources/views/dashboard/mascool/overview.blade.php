@extends('dashboard.mascool.layouts.app')
@section('title', 'نظرة عامة')

@section('content')
@php use App\Support\HomeMedia; @endphp

<div class="page-head">
    <div class="page-head__text">
        <h1>نظرة عامة</h1>
        <p>حالة الصفحة الرئيسية لموقع mas Cool.</p>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap">
        <a class="btn btn--primary" href="{{ route('admin.home.editor') }}">محرر الصفحة الرئيسية</a>
        <a class="btn btn--dark" href="{{ route('admin.equipment.products.create') }}">إضافة معدة</a>
        <a class="btn btn--outline" href="{{ route('landing') }}" target="_blank" rel="noopener">معاينة الموقع</a>
    </div>
</div>

<div class="grid grid--stats" style="margin-bottom:18px">
    <div class="stat">
        <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-layers"/></svg> تصنيفات نشطة</span>
        <div class="stat__value">{{ $stats['categories'] }}</div>
        <div class="stat__hint"><a href="{{ route('admin.equipment.categories.index') }}">إدارة التصنيفات</a></div>
    </div>
    <div class="stat">
        <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-box"/></svg> إجمالي المعدات</span>
        <div class="stat__value">{{ $stats['products'] }}</div>
        <div class="stat__hint"><a href="{{ route('admin.equipment.products.index') }}">إدارة المعدات</a></div>
    </div>
    <div class="stat">
        <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-check"/></svg> متاح للمعاينة</span>
        <div class="stat__value">{{ $stats['available'] }}</div>
        <div class="stat__hint">معدات ظاهرة وقابلة للمعاينة</div>
    </div>
    <div class="stat">
        <span class="stat__label"><svg class="ic" aria-hidden="true"><use href="#i-spark"/></svg> أقسام ظاهرة</span>
        <div class="stat__value">{{ $stats['sections'] }}<span style="font-size:16px;color:var(--muted-soft)"> / {{ $stats['sectionsTotal'] }}</span></div>
        <div class="stat__hint"><a href="{{ route('admin.home.editor') }}">تعديل الأقسام</a></div>
    </div>
</div>

<div class="grid grid--2">
    <section class="card">
        <div class="card__head"><div><h2>آخر تحديثات المعدات</h2></div><a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.products.index') }}">عرض الكل</a></div>
        <div class="card__body">
            @forelse($recent as $product)
                <div style="display:flex;align-items:center;gap:12px;padding:8px 0;border-bottom:1px solid var(--line-soft)">
                    <img class="thumb" src="{{ HomeMedia::url($product->image) }}" alt="{{ $product->image_alt }}" loading="lazy">
                    <div style="flex:1;min-width:0">
                        <div style="font-size:13.5px;font-weight:700">{{ $product->name }}</div>
                        <div style="font-size:11.5px;color:var(--muted)">{{ $product->category?->name }} · {{ $product->updated_at?->diffForHumans() }}</div>
                    </div>
                    <a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.products.edit', $product) }}">تعديل</a>
                </div>
            @empty
                <div class="empty"><h3>لا توجد معدات</h3><p>ابدأ بإضافة أول معدة.</p>
                    <a class="btn btn--primary" href="{{ route('admin.equipment.products.create') }}">إضافة معدة</a></div>
            @endforelse
        </div>
    </section>

    <section class="card">
        <div class="card__head"><div><h2>توزيع المعدات حسب التصنيف</h2><p>المعدات النشطة</p></div></div>
        <div class="card__body">
            @php $total = max(1, $byCategory->sum('products_count')); @endphp
            @forelse($byCategory as $category)
                <div style="margin-bottom:12px">
                    <div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700;margin-bottom:5px">
                        <span>{{ $category->name }}</span><span>{{ $category->products_count }}</span>
                    </div>
                    <div style="height:9px;border-radius:var(--r-pill);background:var(--ice);overflow:hidden">
                        <div style="height:100%;width:{{ round($category->products_count / $total * 100) }}%;background:var(--navy);border-radius:var(--r-pill)"></div>
                    </div>
                </div>
            @empty
                <div class="empty"><p>لا توجد تصنيفات بعد.</p></div>
            @endforelse
            <p class="hint" style="margin-top:12px">تفاعلات واتساب خلال 30 يومًا: <strong>{{ $stats['whatsapp30'] }}</strong></p>
        </div>
    </section>
</div>
@endsection
