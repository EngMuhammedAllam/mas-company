@extends('dashboard.mascool.layouts.app')
@section('title', $product->exists ? 'تعديل معدة: '.$product->name : 'إضافة معدة')
@section('breadcrumb', '<a href="'.route('admin.equipment.products.index').'">المعدات</a>')

@section('content')
@php
    use App\Models\HomePage\EquipmentProduct;
    use App\Support\HomeMedia;
    $specs = old('specifications', $product->specifications ?? []);
    if (count($specs) < 3) { $specs = array_pad($specs, 3, ['label' => '', 'value' => '']); }
@endphp

<div class="page-head">
    <div class="page-head__text">
        <h1>{{ $product->exists ? 'تعديل المعدة' : 'إضافة معدة جديدة' }}</h1>
        <p>{{ $product->exists ? 'الصورة الحالية محفوظة — ارفع صورة جديدة فقط إذا أردت استبدالها.' : 'املأ البيانات التي ستظهر في بطاقة المعدة على الصفحة الرئيسية.' }}</p>
    </div>
    <a class="btn btn--outline" href="{{ route('admin.equipment.products.index') }}">رجوع</a>
</div>

<form method="POST" enctype="multipart/form-data"
      action="{{ $product->exists ? route('admin.equipment.products.update', $product) : route('admin.equipment.products.store') }}">
    @csrf
    @if($product->exists) @method('PUT') @endif

    <section class="card" style="margin-bottom:16px">
        <div class="card__head"><div><h2>البيانات الأساسية</h2></div></div>
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
                <div class="field">
                    <label for="slug">المعرّف (slug)</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" dir="ltr" class="{{ $errors->has('slug') ? 'is-invalid' : '' }}">
                    <span class="hint">يُنشأ تلقائيًا من الاسم إذا تُرك فارغًا.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'slug'])
                </div>
                <div class="field">
                    <label for="kicker">التصنيف الفرعي (فوق الاسم)</label>
                    <input type="text" id="kicker" name="kicker" value="{{ old('kicker', $product->kicker) }}">
                    <span class="hint">مثال: «مكثفات هوائية»</span>
                </div>
                <div class="field field--full">
                    <label for="description">الوصف *</label>
                    <textarea id="description" name="description" rows="3" class="{{ $errors->has('description') ? 'is-invalid' : '' }}" required>{{ old('description', $product->description) }}</textarea>
                    <span class="hint">يظهر سطرين فقط في البطاقة — اجعله مختصرًا.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'description'])
                </div>
            </div>
        </div>
    </section>

    <section class="card" style="margin-bottom:16px">
        <div class="card__head"><div><h2>الصورة</h2><p>صور المعدات المعتمدة محفوظة ولا تتغير إلا عند رفع بديل.</p></div></div>
        <div class="card__body">
            @if($product->image)
                <div class="media-preview" style="margin-bottom:14px">
                    <img class="media-preview__img" id="imgPreview" src="{{ HomeMedia::url($product->image) }}" alt="{{ $product->image_alt }}">
                    <div class="media-preview__meta">
                        <strong>الصورة الحالية</strong><br>
                        <code>{{ $product->image }}</code><br>
                        @if(HomeMedia::isBundled($product->image))
                            <span class="badge badge--navy" style="margin-top:6px">صورة معتمدة أصلية</span>
                        @endif
                    </div>
                </div>
            @endif
            <div class="form-grid">
                <div class="field">
                    <label for="image">{{ $product->exists ? 'استبدال الصورة (اختياري)' : 'صورة المعدة *' }}</label>
                    <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp"
                           data-preview="#imgPreview" class="{{ $errors->has('image') ? 'is-invalid' : '' }}" @unless($product->exists) required @endunless>
                    <span class="hint">PNG أو JPG أو WEBP — بحد أقصى 4 ميجابايت.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'image'])
                </div>
                <div class="field">
                    <label for="image_alt">النص البديل للصورة</label>
                    <input type="text" id="image_alt" name="image_alt" value="{{ old('image_alt', $product->image_alt) }}">
                    <span class="hint">مهم لقارئات الشاشة ومحركات البحث.</span>
                </div>
                <div class="field">
                    <label for="media_shape">شكل الصورة *</label>
                    <select id="media_shape" name="media_shape" required>
                        @foreach(EquipmentProduct::SHAPE_LABELS as $value => $label)
                            <option value="{{ $value }}" @selected(old('media_shape', $product->media_shape) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <span class="hint">يضبط تكبير الصورة داخل البطاقة ليتساوى حجم المعدات بصريًا.</span>
                </div>
            </div>
        </div>
    </section>

    <section class="card" style="margin-bottom:16px">
        <div class="card__head"><div><h2>التوافر والحالة</h2></div></div>
        <div class="card__body">
            <div class="form-grid">
                <div class="field">
                    <label for="availability_label">نص حالة التوافر</label>
                    <input type="text" id="availability_label" name="availability_label" value="{{ old('availability_label', $product->availability_label) }}">
                    <span class="hint">يظهر كشارة صغيرة أعلى البطاقة.</span>
                </div>
                <div class="field">
                    <label for="sort_order">الترتيب</label>
                    <input type="number" id="sort_order" name="sort_order" min="0" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                    <span class="hint">الأصغر يظهر أولًا.</span>
                </div>
                <div class="field">
                    <label>خيارات</label>
                    <div style="display:flex;flex-wrap:wrap;gap:18px">
                        <label class="switch"><input type="checkbox" name="is_available" value="1" @checked(old('is_available', $product->is_available))><span class="switch__track"></span> متاح للمعاينة</label>
                        <label class="switch"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))><span class="switch__track"></span> مميّز</label>
                        <label class="switch"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))><span class="switch__track"></span> ظاهر في الصفحة</label>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="card" style="margin-bottom:16px">
        <div class="card__head"><div><h2>المواصفات</h2><p>اتركها فارغة إن لم تكن مطلوبة.</p></div></div>
        <div class="card__body">
            @foreach($specs as $i => $spec)
                <div class="form-grid" style="margin-bottom:10px">
                    <div class="field">
                        <label for="spec-l-{{ $i }}">المواصفة {{ $i + 1 }}</label>
                        <input type="text" id="spec-l-{{ $i }}" name="specifications[{{ $i }}][label]" value="{{ $spec['label'] ?? '' }}" placeholder="مثال: القدرة">
                    </div>
                    <div class="field">
                        <label for="spec-v-{{ $i }}">القيمة</label>
                        <input type="text" id="spec-v-{{ $i }}" name="specifications[{{ $i }}][value]" value="{{ $spec['value'] ?? '' }}" placeholder="مثال: 10 حصان">
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="card" style="margin-bottom:16px">
        <div class="card__head"><div><h2>رسائل واتساب</h2><p>الرسالة الجاهزة التي تُفتح عند الضغط على كل زر.</p></div></div>
        <div class="card__body">
            <div class="form-grid">
                <div class="field field--full">
                    <label for="whatsapp_price_message">زر «استفسر عن السعر»</label>
                    <textarea id="whatsapp_price_message" name="whatsapp_price_message" rows="2">{{ old('whatsapp_price_message', $product->whatsapp_price_message) }}</textarea>
                </div>
                <div class="field">
                    <label for="whatsapp_details_message">زر «التفاصيل»</label>
                    <textarea id="whatsapp_details_message" name="whatsapp_details_message" rows="2">{{ old('whatsapp_details_message', $product->whatsapp_details_message) }}</textarea>
                </div>
                <div class="field">
                    <label for="whatsapp_specs_message">زر «المواصفات»</label>
                    <textarea id="whatsapp_specs_message" name="whatsapp_specs_message" rows="2">{{ old('whatsapp_specs_message', $product->whatsapp_specs_message) }}</textarea>
                </div>
            </div>
        </div>
    </section>

    <div style="display:flex;gap:10px;flex-wrap:wrap">
        <button class="btn btn--primary" type="submit">{{ $product->exists ? 'حفظ التعديلات' : 'إضافة المعدة' }}</button>
        <a class="btn btn--outline" href="{{ route('admin.equipment.products.index') }}">إلغاء</a>
    </div>
</form>
@endsection
