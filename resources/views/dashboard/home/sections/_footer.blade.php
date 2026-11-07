@php use App\Support\HomeMedia; @endphp
<div class="form-grid">
    <p class="hint" style="grid-column:1/-1;margin-bottom:4px">محتوى الفوتر وأزرار واتساب فيه.</p>
                <div class="field">
                    <label for="title">اسم العلامة</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}">
                </div>
                <div class="field field--full">
                    <label for="description">الوصف المختصر</label>
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
                    <label for="set-header_cta_text">نص زر الهيدر</label>
                    <input type="text" id="set-header_cta_text" name="settings[header_cta_text]" value="{{ old('settings.header_cta_text', $section->setting('header_cta_text')) }}">
                </div>
                <div class="field">
                    <label for="set-quick_links_title">عنوان: روابط سريعة</label>
                    <input type="text" id="set-quick_links_title" name="settings[quick_links_title]" value="{{ old('settings.quick_links_title', $section->setting('quick_links_title')) }}">
                </div>
                <div class="field">
                    <label for="set-equipment_title">عنوان: المعدات</label>
                    <input type="text" id="set-equipment_title" name="settings[equipment_title]" value="{{ old('settings.equipment_title', $section->setting('equipment_title')) }}">
                </div>
                <div class="field">
                    <label for="set-start_title">عنوان: ابدأ معنا</label>
                    <input type="text" id="set-start_title" name="settings[start_title]" value="{{ old('settings.start_title', $section->setting('start_title')) }}">
                </div>
                <div class="field">
                    <label for="set-copyright">نص حقوق النشر</label>
                    <input type="text" id="set-copyright" name="settings[copyright]" value="{{ old('settings.copyright', $section->setting('copyright')) }}">
                </div>
                <div class="field">
                    <label for="set-floating_message">رسالة زر واتساب العائم</label>
                    <input type="text" id="set-floating_message" name="settings[floating_message]" value="{{ old('settings.floating_message', $section->setting('floating_message')) }}">
                </div>
</div>
