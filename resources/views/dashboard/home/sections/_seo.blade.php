<form method="POST" action="{{ route('admin.home.seo.update') }}" data-track-dirty>
    @csrf @method('PUT')

    <section class="card" style="margin-bottom:16px">
        <div class="card__head">
            <div><h2>إعدادات SEO للصفحة الرئيسية</h2><p>تظهر في نتائج البحث وعند مشاركة الرابط.</p></div>
        </div>
        <div class="card__body">
            <div class="form-grid">
                <div class="field field--full">
                    <label for="meta_title">عنوان الصفحة (Meta title)</label>
                    <input type="text" id="meta_title" name="meta_title"
                           value="{{ old('meta_title', $seoSetting->meta_title) }}"
                           class="{{ $errors->has('meta_title') ? 'is-invalid' : '' }}">
                    <span class="hint">يُفضّل أقل من 60 حرفًا. يُستخدم «mas Cool | معدات التبريد الصناعي» إن تُرك فارغًا.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'meta_title'])
                </div>
                <div class="field field--full">
                    <label for="meta_description">وصف الصفحة (Meta description)</label>
                    <textarea id="meta_description" name="meta_description" rows="3"
                              class="{{ $errors->has('meta_description') ? 'is-invalid' : '' }}">{{ old('meta_description', $seoSetting->meta_description) }}</textarea>
                    <span class="hint">يُفضّل بين 120 و160 حرفًا.</span>
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'meta_description'])
                </div>
                <div class="field">
                    <label for="canonical_url">الرابط الأساسي (Canonical)</label>
                    <input type="text" id="canonical_url" name="canonical_url" dir="ltr"
                           value="{{ old('canonical_url', $seoSetting->canonical_url) }}"
                           class="{{ $errors->has('canonical_url') ? 'is-invalid' : '' }}">
                    @include('dashboard.mascool.partials.field-errors', ['name' => 'canonical_url'])
                </div>
                <div class="field">
                    <label for="robots">توجيهات محركات البحث (Robots)</label>
                    <input type="text" id="robots" name="robots" dir="ltr"
                           value="{{ old('robots', $seoSetting->robots) }}" placeholder="index, follow">
                </div>
            </div>
        </div>
    </section>

    <div class="save-row">
        <button class="btn btn--primary" type="submit">حفظ إعدادات SEO</button>
        <span class="dirty-flag" id="dirtyFlag">تغييرات غير محفوظة</span>
    </div>
</form>
