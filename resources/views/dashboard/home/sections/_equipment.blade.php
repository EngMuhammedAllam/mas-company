@php use App\Support\HomeMedia; @endphp
<div class="form-grid">
    <p class="hint" style="grid-column:1/-1;margin-bottom:4px">عناوين وأزرار قسم المعدات. البطاقات نفسها تُدار من صفحة المعدات.</p>
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
                <div class="field">
                    <label for="button_text">نص الزر الأساسي</label>
                    <input type="text" id="button_text" name="button_text" value="{{ old('button_text', $section->button_text) }}">
                </div>
                <div class="field">
                    <label for="secondary_button_text">نص الزر الثانوي</label>
                    <input type="text" id="secondary_button_text" name="secondary_button_text" value="{{ old('secondary_button_text', $section->secondary_button_text) }}">
                </div>
                <div class="field">
                    <label for="whatsapp_message">رسالة واتساب للزر الأساسي</label>
                    <textarea id="whatsapp_message" name="whatsapp_message" rows="2">{{ old('whatsapp_message', $section->whatsapp_message) }}</textarea>
                </div>
                <div class="field">
                    <label for="secondary_whatsapp_message">رسالة واتساب للزر الثانوي</label>
                    <textarea id="secondary_whatsapp_message" name="secondary_whatsapp_message" rows="2">{{ old('secondary_whatsapp_message', $section->secondary_whatsapp_message) }}</textarea>
                </div>
                <div class="field">
                    <label for="set-filter_all_label">نص زر «الكل»</label>
                    <input type="text" id="set-filter_all_label" name="settings[filter_all_label]" value="{{ old('settings.filter_all_label', $section->setting('filter_all_label')) }}">
                </div>
                <div class="field field--full"><a class="btn btn--outline btn--sm" href="{{ route('admin.equipment.products.index') }}">إدارة المعدات ←</a></div>
</div>
