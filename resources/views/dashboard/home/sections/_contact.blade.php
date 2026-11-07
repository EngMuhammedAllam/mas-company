@php use App\Support\HomeMedia; @endphp
<div class="form-grid">
    <p class="hint" style="grid-column:1/-1;margin-bottom:4px">قسم التواصل ونموذج واتساب.</p>
                <div class="field">
                    <label for="eyebrow">النص التمهيدي</label>
                    <input type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $section->eyebrow) }}">
                </div>
                <div class="field">
                    <label for="title">العنوان</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}">
                </div>
                <div class="field">
                    <label for="highlighted_text">النص المميز (ليموني)</label>
                    <input type="text" id="highlighted_text" name="highlighted_text" value="{{ old('highlighted_text', $section->highlighted_text) }}">
                </div>
                <div class="field field--full">
                    <label for="description">الوصف</label>
                    <textarea id="description" name="description" rows="2" class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $section->description) }}</textarea>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'description'])
                </div>
                <div class="field">
                    <label for="button_text">نص زر الإرسال</label>
                    <input type="text" id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
                </div>
                <div class="field">
                    <label for="set-form_note">الملاحظة أسفل النموذج</label>
                    <input type="text" id="set-form_note" name="settings[form_note]" value="{{ old('settings.form_note', $section->setting('form_note')) }}">
                </div>
                <div class="field">
                    <label for="set-other_option_label">خيار «أحتاج مساعدة»</label>
                    <input type="text" id="set-other_option_label" name="settings[other_option_label]" value="{{ old('settings.other_option_label', $section->setting('other_option_label')) }}">
                </div>
                <div class="field field--full"><a class="btn btn--outline btn--sm" href="{{ route('admin.contact-settings.edit') }}">إعدادات رقم واتساب ←</a></div>
</div>
