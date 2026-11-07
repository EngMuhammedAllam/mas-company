@php
    $mainNav = [
        ['route' => 'dashboard', 'label' => 'نظرة عامة', 'icon' => 'i-grid'],
        ['route' => 'admin.home.editor', 'label' => 'محرر الصفحة الرئيسية', 'icon' => 'i-spark'],
        ['route' => 'admin.equipment.products.index', 'label' => 'المعدات', 'icon' => 'i-box'],
        ['route' => 'admin.equipment.categories.index', 'label' => 'تصنيفات المعدات', 'icon' => 'i-layers'],
        ['route' => 'admin.contact-settings.edit', 'label' => 'التواصل وواتساب', 'icon' => 'i-chat'],
    ];

    // everything from the previous landing page — kept, but out of the way
    $legacyNav = [
        ['route' => 'dashboard.legacy', 'label' => 'إحصائيات قديمة'],
        ['route' => 'admin.hero.edite', 'label' => 'الهيرو القديم'],
        ['route' => 'features.index', 'label' => 'المميزات القديمة'],
        ['route' => 'projects.index', 'label' => 'المشاريع'],
        ['route' => 'services.index', 'label' => 'الخدمات'],
        ['route' => 'testimonials.index', 'label' => 'آراء العملاء'],
        ['route' => 'admin.posts.index', 'label' => 'المدونة'],
        ['route' => 'admin.clients.index', 'label' => 'العملاء'],
        ['route' => 'admin.counters.index', 'label' => 'العدادات'],
        ['route' => 'admin.about.edit', 'label' => 'من نحن'],
        ['route' => 'admin.cta.edit', 'label' => 'دعوة لاتخاذ إجراء'],
        ['route' => 'admin.contact.index', 'label' => 'رسائل التواصل'],
        ['route' => 'admin.seo.edit', 'label' => 'SEO العام'],
    ];

    $legacyOpen = collect($legacyNav)->contains(fn ($i) => request()->routeIs($i['route']));
@endphp

<aside class="sidebar" id="adminSidebar" aria-label="القائمة الجانبية">
    <div class="brand">
        <svg class="brand__mark" aria-hidden="true"><use href="#i-snow"/></svg>
        <div>
            <div class="brand__word">mas Cool</div>
            <div class="brand__tag">لوحة التحكم</div>
        </div>
        <button class="sidebar__close" type="button" id="sidebarClose" aria-label="إغلاق القائمة">×</button>
    </div>

    <nav class="nav">
        <div class="nav__group">
            <span class="nav__label">إدارة الموقع</span>
            @foreach($mainNav as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp
                <a class="nav__link {{ $isActive ? 'is-active' : '' }}" href="{{ route($item['route']) }}"
                   @if($isActive) aria-current="page" @endif>
                    <svg class="ic" aria-hidden="true"><use href="#{{ $item['icon'] }}"/></svg>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
            <a class="nav__link" href="{{ route('landing') }}" target="_blank" rel="noopener">
                <svg class="ic" aria-hidden="true"><use href="#i-eye"/></svg>
                <span>معاينة الموقع</span>
            </a>
        </div>

        <details class="nav__group" @if($legacyOpen) open @endif>
            <summary>محتوى قديم (Legacy)</summary>
            @foreach($legacyNav as $item)
                <a class="nav__link {{ request()->routeIs($item['route']) ? 'is-active' : '' }}" href="{{ route($item['route']) }}">
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </details>
    </nav>
</aside>
