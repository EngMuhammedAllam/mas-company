@php use App\Support\HomeMedia; @endphp
<div class="form-grid">
    <p class="hint" style="grid-column:1/-1;margin-bottom:4px">القسم الأول الذي يراه الزائر.</p>
                <div class="field">
                    <label for="eyebrow">النص التمهيدي</label>
                    <input type="text" id="eyebrow" name="eyebrow" value="{{ old('eyebrow', $section->eyebrow) }}">
                </div>
                <div class="field">
                    <label for="title">العنوان الرئيسي</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $section->title) }}">
                </div>
                <div class="field">
                    <label for="highlighted_text">النص المميز (ليموني)</label>
                    <input type="text" id="highlighted_text" name="highlighted_text" value="{{ old('highlighted_text', $section->highlighted_text) }}">
                </div>
                <div class="field field--full">
                    <label for="description">النص التعريفي</label>
                    <textarea id="description" name="description" rows="3" class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', $section->description) }}</textarea>
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
                    <label for="set-primary_button_href">رابط الزر الأساسي</label>
                    <input type="text" id="set-primary_button_href" name="settings[primary_button_href]" value="{{ old('settings.primary_button_href', $section->setting('primary_button_href')) }}">
                </div>
                <div class="field">
                    <label for="set-tag">شارة أعلى الصورة</label>
                    <input type="text" id="set-tag" name="settings[tag]" value="{{ old('settings.tag', $section->setting('tag')) }}">
                </div>
                <div class="field">
                    <label for="set-badge">شارة أسفل الصورة</label>
                    <input type="text" id="set-badge" name="settings[badge]" value="{{ old('settings.badge', $section->setting('badge')) }}">
                </div>
                <div class="field field--full">
                    <label>الصورة الحالية</label>
                    @if($section->image)
                        <div class="media-preview">
                            <img class="media-preview__img" id="imgPreview" src="{{ HomeMedia::url($section->image) }}" alt="{{ $section->image_alt }}">
                            <div class="media-preview__meta">
                                <code>{{ $section->image }}</code><br>
                                @if(HomeMedia::isBundled($section->image))
                                    <span class="badge badge--navy" style="margin-top:6px">صورة معتمدة أصلية</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <p class="hint">لا توجد صورة لهذا القسم.</p>
                    @endif
                </div>
                <div class="field">
                    <label for="image">استبدال الصورة (اختياري)</label>
                    <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp"
                           data-preview="#imgPreview" class="{{ $errors->has('image') ? 'is-invalid' : '' }}">
                    <span class="hint">اتركه فارغًا للإبقاء على الصورة المعتمدة.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'image'])
                </div>
                <div class="field">
                    <label for="image_alt">النص البديل للصورة</label>
                    <input type="text" id="image_alt" name="image_alt" value="{{ old('image_alt', $section->image_alt) }}">
                </div>
</div>
