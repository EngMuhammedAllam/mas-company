@extends('dashboard.mascool.layouts.app')
@section('title', $product->exists ? 'تعديل معدة' : 'إضافة معدة')
@section('breadcrumb', 'المعدات')

@push('styles')
    <style>
        .product-form-head__status{display:none}
        .product-editor{display:grid;grid-template-columns:minmax(0,1.45fr) minmax(300px,.7fr);gap:16px;align-items:start}
        .product-card{overflow:hidden}
        .product-card__heading{display:flex;align-items:center;gap:10px}
        .product-card__icon{width:38px;height:38px;border-radius:10px;display:grid;place-items:center;background:var(--lime-soft);color:var(--navy);font-weight:800;flex:none}
        .product-card__heading p{font-size:12px;color:var(--muted)}
        .product-card .card__body{padding:18px}
        .product-description{min-height:118px}
        .product-publish{position:sticky;top:calc(var(--header-h) + 20px)}
        .product-upload{padding:14px;border:1px dashed #c9d9df;border-radius:var(--r-md);background:var(--paper)}
        .product-upload input[type=file]{background:#fff}
        .product-upload input[type=file]::file-selector-button{border:0;border-radius:7px;background:var(--lime-soft);color:var(--navy);padding:7px 11px;margin-inline-end:8px;font:inherit;font-weight:700;cursor:pointer}
        .product-availability{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:14px;padding:12px 13px;border:1px solid var(--line-soft);border-radius:var(--r-md);background:var(--ice)}
        .product-availability strong{display:block;font-size:13px}
        .product-availability p{font-size:11px;color:var(--muted)}
        .auto-note{display:flex;align-items:flex-start;gap:8px;margin-top:14px;padding:10px 12px;border-radius:var(--r-sm);background:var(--lime-soft);color:#526613;font-size:11.5px;line-height:1.7}
        .auto-note i{width:7px;height:7px;border-radius:50%;background:var(--lime-deep);margin-top:7px;flex:none}
        .product-form-actions{display:flex;justify-content:flex-start;gap:10px;margin-top:16px;flex-wrap:wrap}

        @media(max-width:900px){.product-editor{grid-template-columns:1fr}.product-publish{position:static}}

        @media(max-width:640px){
            .topbar{gap:8px;padding-inline:12px}
            .topbar__titles{display:none}
            .topbar__actions{margin-inline-start:auto}
            .topbar__actions>.btn{width:44px;padding:0;font-size:0}
            .topbar__actions>.btn svg{width:18px;height:18px}
            .account__btn{width:44px;padding:0;justify-content:center}
            .account__btn>span:last-child{display:none}
            .content{padding:12px}

            .product-form-head{position:relative;overflow:hidden;display:flex;align-items:center;padding:14px 15px;margin-bottom:12px;border-radius:18px;background:linear-gradient(145deg,var(--navy-mid),var(--navy-deep));color:#fff;box-shadow:0 12px 28px rgba(3,29,39,.14)}
            .product-form-head:after{content:"";position:absolute;width:115px;height:115px;border:26px solid rgba(212,248,63,.07);border-radius:50%;inset-inline-end:-68px;bottom:-78px;pointer-events:none}
            .product-form-head__status{position:relative;z-index:1;display:inline-flex;align-items:center;gap:6px;color:#d8e5e9;font-size:10px;font-weight:700;margin-bottom:3px}
            .product-form-head__status i{width:6px;height:6px;border-radius:50%;background:var(--lime)}
            .product-form-head .page-head__text{position:relative;z-index:1;flex:1}
            .product-form-head h1{font-size:19px;color:#fff}
            .product-form-head p{font-size:10.5px;line-height:1.55;color:#b8cbd1}
            .product-form-head .btn{position:relative;z-index:1;width:auto;min-height:37px;padding:6px 10px;background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.16);color:#fff;font-size:11.5px}

            .product-form{padding-bottom:74px}
            .product-editor{gap:10px}
            .product-card{border-radius:16px;box-shadow:none}
            .product-card .card__head{padding:11px 12px}
            .product-card .card__body{padding:12px}
            .product-card__icon{width:32px;height:32px;border-radius:9px;font-size:12px}
            .product-card__heading{gap:8px}
            .product-card__heading h2{font-size:14.5px}
            .product-card__heading p{display:none}
            .product-card .form-grid{gap:11px}
            .field label{font-size:12px;margin-bottom:4px}
            .field .hint{font-size:10px;line-height:1.5;margin-top:3px}
            .field input[type=text],.field input[type=file],.field select{min-height:43px;padding:8px 10px;font-size:13px}
            .field textarea{min-height:78px;padding:9px 10px;font-size:13px;line-height:1.65}
            .product-upload{padding:10px}
            .product-upload input[type=file]{padding:5px}
            .product-upload input[type=file]::file-selector-button{padding:6px 8px;font-size:11px}
            .media-preview{padding:8px;gap:9px;margin-bottom:10px!important}
            .media-preview__img{width:86px;height:60px}
            .media-preview__meta{font-size:10px;max-width:calc(100% - 95px)}
            .media-preview__meta code{font-size:9px;display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
            .product-availability{margin-top:10px;padding:10px 11px}
            .auto-note{margin-top:10px;padding:8px 10px;font-size:10px}
            .product-form-actions{position:fixed;z-index:25;inset-inline:12px;bottom:calc(8px + env(safe-area-inset-bottom));display:grid;grid-template-columns:1fr 1.6fr;gap:8px;margin:0;padding:8px;border:1px solid rgba(220,231,235,.9);border-radius:15px;background:rgba(248,251,251,.94);backdrop-filter:blur(14px);box-shadow:0 12px 34px rgba(3,29,39,.18)}
            .product-form-actions .btn{width:100%;min-height:44px}
        }
    </style>
@endpush

@section('content')
@php use App\Support\HomeMedia; @endphp

<div class="page-head product-form-head">
    <div class="page-head__text">
        <span class="product-form-head__status"><i aria-hidden="true"></i>{{ $product->exists ? 'تعديل بيانات معدة' : 'معدة جديدة' }}</span>
        <h1>{{ $product->exists ? 'تعديل المعدة' : 'إضافة معدة جديدة' }}</h1>
        <p>أدخل المعلومات الأساسية فقط، وسنضبط التفاصيل التقنية تلقائيًا.</p>
    </div>
    <a class="btn btn--outline" href="{{ route('admin.equipment.products.index') }}">رجوع</a>
</div>

<form class="product-form" method="POST" enctype="multipart/form-data"
      action="{{ $product->exists ? route('admin.equipment.products.update', $product) : route('admin.equipment.products.store') }}">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <div class="product-editor">
        <section class="card product-card">
            <div class="card__head">
                <div class="product-card__heading"><span class="product-card__icon">01</span><div><h2>بيانات المعدة</h2><p>المعلومات التي يراها العميل في بطاقة المنتج.</p></div></div>
            </div>
            <div class="card__body">
                <div class="form-grid">
                    <div class="field">
                        <label for="name">اسم المعدة *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                        @include('dashboard.mascool.partials.field-errors', ['name' => 'name'])
                    </div>
                    <div class="field">
                        <label for="equipment_category_id">التصنيف *</label>
                        <select id="equipment_category_id" name="equipment_category_id" class="{{ $errors->has('equipment_category_id') ? 'is-invalid' : '' }}" required>
                            <option value="">اختر التصنيف</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('equipment_category_id', $product->equipment_category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @include('dashboard.mascool.partials.field-errors', ['name' => 'equipment_category_id'])
                    </div>
                    <div class="field field--full">
                        <label for="description">وصف مختصر *</label>
                        <textarea class="product-description {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                        <span class="hint">اكتب أهم معلومة يحتاجها العميل في سطرين.</span>
                        @include('dashboard.mascool.partials.field-errors', ['name' => 'description'])
                    </div>
                </div>
            </div>
        </section>

        <aside class="card product-card product-publish">
            <div class="card__head">
                <div class="product-card__heading"><span class="product-card__icon">02</span><div><h2>الصورة والحالة</h2><p>صورة المعدة وإمكانية معاينتها.</p></div></div>
            </div>
            <div class="card__body">
                @if($product->image)
                    <div class="media-preview" style="margin-bottom:12px">
                        <img class="media-preview__img" id="imgPreview" src="{{ HomeMedia::url($product->image) }}" alt="{{ $product->image_alt ?: $product->name }}">
                        <div class="media-preview__meta"><strong>الصورة الحالية</strong><code>{{ $product->image }}</code></div>
                    </div>
                @endif
                <div class="field product-upload">
                    <label for="image">{{ $product->exists ? 'استبدال الصورة' : 'صورة المعدة *' }}</label>
                    <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp" data-preview="#imgPreview"
                           class="{{ $errors->has('image') ? 'is-invalid' : '' }}" @unless($product->exists) required @endunless>
                    <span class="hint">PNG أو JPG أو WEBP — حتى 4 ميجابايت.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'image'])
                </div>
                <div class="product-availability">
                    <div><strong>متاح للمعاينة</strong><p>يظهر شريط التوافر على بطاقة المعدة.</p></div>
                    <label class="switch" aria-label="متاح للمعاينة"><input type="checkbox" name="is_available" value="1" @checked(old('is_available', $product->is_available))><span class="switch__track"></span></label>
                </div>
                <div class="auto-note"><i aria-hidden="true"></i><span>المعرّف، شكل الصورة، نصها البديل، ترتيب العرض ورسائل واتساب تُنشأ تلقائيًا.</span></div>
            </div>
        </aside>
    </div>

    <div class="product-form-actions">
        <a class="btn btn--outline" href="{{ route('admin.equipment.products.index') }}">إلغاء</a>
        <button class="btn btn--primary" type="submit">{{ $product->exists ? 'حفظ التعديلات' : 'إضافة المعدة' }}</button>
    </div>
</form>
@endsection
