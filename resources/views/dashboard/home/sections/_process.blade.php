@php use App\Support\HomeMedia; @endphp
<div class="form-grid">
    <p class="hint" style="grid-column:1/-1;margin-bottom:4px">قسم خطوات العمل. الخطوات تُدار كمكرّرات بالأسفل.</p>
                <div class="field">
                    <label for="eyebrow">النص التمهيدي</label>
                    <input type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $section->eyebrow) }}">
                </div>
                <div class="field">
                    <label for="title">العنوان</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}">
                </div>
                <div class="field field--full">
                    <label for="description">الوصف</label>
                    <textarea id="description" name="description" rows="2" class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $section->description) }}</textarea>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'description'])
                </div>
</div>
