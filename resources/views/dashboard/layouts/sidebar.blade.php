<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ route('dashboard') }}" class="header-logo">
            <img src="{{ asset('assets/images/brand-logos/logo-light.png')}}" alt="logo" style="width: 80px !important; height: 80px !important;"
                class="desktop-logo">
            <img src="{{ asset('assets/images/brand-logos/logo-light.png')}}" alt="logo" style="width: 80px !important; height: 80px !important;"
                class="toggle-logo">
            <img src="{{ asset('assets/images/brand-logos/logo-light.png')}}" alt="logo" style="width: 80px !important; height: 80px !important;"
                class="desktop-dark">
            <img src="{{ asset('assets/images/brand-logos/logo-light.png')}}" alt="logo" style="width: 80px !important; height: 80px !important;"
                class="toggle-dark">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- لوحة التحكم -->
                <li class="slide">
                    <a href="{{ route('dashboard') }}" class="side-menu__item text-capitalize">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">لوحة التحكم</span>
                    </a>
                </li>
                <!-- العنوان الرئيسي (Hero) -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-landscape side-menu__icon"></i>
                        <span class="side-menu__label">العنوان الرئيسي</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.hero.edite') }}" class="side-menu__item text-capitalize">
                                تعديل العنوان
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- المميزات -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-star side-menu__icon"></i>
                        <span class="side-menu__label">المميزات</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('features.index') }}" class="side-menu__item text-capitalize">
                                كافة المميزات
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- المشاريع -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-building side-menu__icon"></i>
                        <span class="side-menu__label">المشاريع</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('projects.index') }}" class="side-menu__item text-capitalize">
                                كافة المشاريع
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- الخدمات -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-wrench side-menu__icon"></i>
                        <span class="side-menu__label">الخدمات</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('section_services.index') }}" class="side-menu__item text-capitalize">
                                كافة الخدمات
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- آراء العملاء -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-message-square-dots side-menu__icon"></i>
                        <span class="side-menu__label">آراء العملاء</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('section_testimonials.index') }}" class="side-menu__item text-capitalize">
                                كافة الآراء
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- المؤشرات (الأرقام البارزة) -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-stats side-menu__icon"></i>
                        <span class="side-menu__label">الأرقام البارزة</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.counters.index') }}" class="side-menu__item text-capitalize">
                                تعديل المؤشرات
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- المدونة -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-news side-menu__icon"></i>
                        <span class="side-menu__label">المقالات</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.posts.index') }}" class="side-menu__item text-capitalize">
                                كافة المقالات
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.blog.section.edit') }}" class="side-menu__item text-capitalize">
                                إعدادات القسم
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- من نحن (About) -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-info-circle side-menu__icon"></i>
                        <span class="side-menu__label">من نحن</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.about.edit') }}" class="side-menu__item text-capitalize">
                                تعديل قسم من نحن
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- الدعوة للعمل (CTA) -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-bullhorn side-menu__icon"></i>
                        <span class="side-menu__label">الدعوة للعمل</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.cta.edit') }}" class="side-menu__item text-capitalize">
                                تعديل قسم الدعوة
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- العملاء (Clients) -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-world side-menu__icon"></i>
                        <span class="side-menu__label">العملاء</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.clients.index') }}" class="side-menu__item text-capitalize">
                                شعارات العملاء
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- التواصل -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="bx bx-phone side-menu__icon"></i>
                        <span class="side-menu__label">بيانات التواصل</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.contact-settings.edit') }}" class="side-menu__item text-capitalize">
                                تعديل قسم التواصل
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- إعدادات SEO -->
                <li class="slide">
                    <a href="{{ route('admin.seo.edit') }}" class="side-menu__item text-capitalize">
                        <i class="bx bx-search-alt side-menu__icon"></i>
                        <span class="side-menu__label">إعدادات SEO</span>
                    </a>
                </li>

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->