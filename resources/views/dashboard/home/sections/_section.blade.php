{{-- Dispatches to the right field set, then renders the repeater the section owns. --}}
@php
    $partials = [
        'general' => '_general', 'hero' => '_hero', 'hero_benefits' => '_benefits',
        'trust' => '_trust', 'categories' => '_categories', 'equipment' => '_equipment',
        'visit' => '_visit', 'advice' => '_advice', 'process' => '_process',
        'faq' => '_faq', 'contact' => '_contact', 'footer' => '_footer',
    ];
    $partial = 'dashboard.home.sections.'.($partials[$section->key] ?? '_general');
    $itemType = $section->itemType();
@endphp

<form method="POST" enctype="multipart/form-data"
      action="{{ route('admin.home.sections.update', $section->key) }}" data-track-dirty>
    @csrf @method('PUT')

    <section class="card" style="margin-bottom:16px">
        <div class="card__head">
            <div>
                <h2>{{ $section->label() }}</h2>
                <p>المعرّف: <code>{{ $section->key }}</code></p>
            </div>
            <label class="switch">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $section->is_active))>
                <span class="switch__track"></span> ظاهر
            </label>
        </div>
        <div class="card__body">
            @include($partial, ['section' => $section])
        </div>
    </section>

    <div class="save-row">
        <button class="btn btn--primary" type="submit">حفظ القسم</button>
        <span class="dirty-flag" id="dirtyFlag">تغييرات غير محفوظة</span>
    </div>
</form>

@if($itemType)
    @include('dashboard.home.sections._repeater', [
        'section' => $section,
        'type' => $itemType,
    ])
@endif
