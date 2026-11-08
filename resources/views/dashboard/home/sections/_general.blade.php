@php use App\Support\HomeMedia; @endphp
<div class="form-grid">
    <p class="hint" style="grid-column:1/-1;margin-bottom:4px">إعدادات عامة تظهر في الهيدر والفوتر وقائمة التنقل.</p>
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
                    <label for="set-brand_word">كلمة العلامة (إنجليزي)</label>
                    <input type="text" id="set-brand_word" name="settings[brand_word]" value="{{ old('settings.brand_word', $section->setting('brand_word')) }}">
                </div>
                <div class="field">
                    <label for="set-brand_tag">وصف العلامة</label>
                    <input type="text" id="set-brand_tag" name="settings[brand_tag]" value="{{ old('settings.brand_tag', $section->setting('brand_tag')) }}">
                </div>
                <div class="field">
                    <label for="set-nav_home">رابط: الرئيسية</label>
                    <input type="text" id="set-nav_home" name="settings[nav_home]" value="{{ old('settings.nav_home', $section->setting('nav_home')) }}">
                </div>
                <div class="field">
                    <label for="set-nav_equipment">رابط: المعدات</label>
                    <input type="text" id="set-nav_equipment" name="settings[nav_equipment]" value="{{ old('settings.nav_equipment', $section->setting('nav_equipment')) }}">
                </div>
                <div class="field">
                    <label for="set-nav_about">رابط: لماذا mas Cool</label>
                    <input type="text" id="set-nav_about" name="settings[nav_about]" value="{{ old('settings.nav_about', $section->setting('nav_about')) }}">
                </div>
                <div class="field">
                    <label for="set-nav_contact">رابط: تواصل معنا</label>
                    <input type="text" id="set-nav_contact" name="settings[nav_contact]" value="{{ old('settings.nav_contact', $section->setting('nav_contact')) }}">
                </div>
                <div class="field">
                    <label for="set-skip_link">رابط تخطي المحتوى</label>
                    <input type="text" id="set-skip_link" name="settings[skip_link]" value="{{ old('settings.skip_link', $section->setting('skip_link')) }}">
                </div>
</div>
