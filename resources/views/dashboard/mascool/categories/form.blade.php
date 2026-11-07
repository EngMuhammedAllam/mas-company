@extends('dashboard.mascool.layouts.app')
@section('title', $category->exists ? 'تعديل تصنيف: '.$category->name : 'إضافة تصنيف')
@section('breadcrumb', '<a href="'.route('admin.equipment.categories.index').'">التصنيفات</a>')

@section('content')
@php use App\Support\HomeMedia; @endphp

<div class="page-head">
    <div class="page-head__text">
        <h1>{{ $category->exists ? 'تعديل التصنيف' : 'إضافة تصنيف جديد' }}</h1>
        @if($category->exists)<p>الصورة الحالية محفوظة — ارفع بديلًا فقط عند الحاجة.</p>@endif
    </div>
    <a class="btn btn--outline" href="{{ route('admin.equipment.categories.index') }}">رجوع</a>
</div>

<form method="POST" enctype="multipart/form-data"
      action="{{ $category->exists ? route('admin.equipment.categories.update', $category) : route('admin.equipment.categories.store') }}">
    @csrf
    @if($category->exists) @method('PUT') @endif

    <section class="card" style="margin-bottom:16px">
        <div class="card__body">
            <div class="form-grid">
                <div class="field">
                    <label for="name">اسم التصنيف *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" required>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'name'])
                </div>
                <div class="field">
                    <label for="slug">المعرّف (slug)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" dir="ltr" class="{{ $errors->has('slug') ? 'is-invalid' : '' }}">
                    <span class="hint">يُستخدم في تصفية المعدات على الصفحة الرئيسية.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'slug'])
                </div>
                <div class="field">
                    <label for="short_description">الوصف المختصر</label>
                    <input type="text" id="short_description" name="short_description" value="{{ old('short_description', $category->short_description) }}">
                </div>
                <div class="field">
                    <label for="media_shape">شكل الصورة *</label>
                    <select id="media_shape" name="media_shape" required>
                        <option value="sq" @selected(old('media_shape', $category->media_shape) === 'sq')>مربّع (كباسات)</option>
                        <option value="wide" @selected(old('media_shape', $category->media_shape) === 'wide')>عريض (كويلات وكوندنسرات)</option>
                        <option value="xwide" @selected(old('media_shape', $category->media_shape) === 'xwide')>عريض جدًا</option>
                    </select>
                </div>
                <div class="field">
                    <label for="sort_order">الترتيب</label>
                    <input type="number" id="sort_order" name="sort_order" min="0" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                </div>
                <div class="field">
                    <label>الحالة</label>
                    <label class="switch"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))><span class="switch__track"></span> ظاهر في الصفحة</label>
                </div>
            </div>
        </div>
    </section>

    <section class="card" style="margin-bottom:16px">
        <div class="card__head"><div><h2>الصورة</h2></div></div>
        <div class="card__body">
            @if($category->image)
                <div class="media-preview" style="margin-bottom:14px">
                    <img class="media-preview__img" id="imgPreview" src="{{ HomeMedia::url($category->image) }}" alt="{{ $category->image_alt }}">
                    <div class="media-preview__meta">
                        <strong>الصورة الحالية</strong><br><code>{{ $category->image }}</code><br>
                        @if(HomeMedia::isBundled($category->image))<span class="badge badge--navy" style="margin-top:6px">صورة معتمدة أصلية</span>@endif
                    </div>
                </div>
            @endif
            <div class="form-grid">
                <div class="field">
                    <label for="image">{{ $category->exists ? 'استبدال الصورة (اختياري)' : 'صورة التصنيف *' }}</label>
                    <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp" data-preview="#imgPreview"
                           class="{{ $errors->has('image') ? 'is-invalid' : '' }}" @unless($category->exists) required @endunless>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'image'])
                </div>
                <div class="field">
                    <label for="image_alt">النص البديل للصورة</label>
                    <input type="text" id="image_alt" name="image_alt" value="{{ old('image_alt', $category->image_alt) }}">
                </div>
            </div>
        </div>
    </section>

    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn btn--primary" type="submit">{{ $category->exists ? 'حفظ التعديلات' : 'إضافة التصنيف' }}</button>
        <a class="btn btn--outline" href="{{ route('admin.equipment.categories.index') }}">إلغاء</a>
    </div>
</form>
@endsection
