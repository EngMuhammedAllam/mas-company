<style>
    /* SHIRAA-Style Premium Header */
    /* Scroll Behavior - Performance Optimized */
    .shiraa-header-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        direction: rtl;
        font-family: 'Inter', 'Segoe UI', Tahoma, sans-serif;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        will-change: transform;
    }

    /* Top Bar */
    .shiraa-topbar {
        background: #071522;
        color: #ffffff;
        padding: 0 5%;
        font-size: 0.85rem;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 40px;
    }

    .eh .shiraa-topbar {
        background: #071522;
    }

    .shiraa-topbar__side {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .shiraa-topbar__item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .shiraa-topbar__item svg {
        width: 14px;
        height: 14px;
    }

    .shiraa-topbar a {
        color: #ffffff;
        text-decoration: none;
        opacity: 0.9;
        transition: opacity 0.2s;
    }

    .shiraa-topbar a:hover {
        opacity: 1;
    }

    /* Main Navbar */
    .shiraa-navbar {
        background: #ffffff;
        box-shadow: 0 12px 32px rgba(9, 21, 38, 0.08);
        height: 78px;
        border-bottom: 1px solid #e7eef5;
        transition: box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .eh .shiraa-navbar {
        background: #0f172a;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.5);
        border-bottom: 1px solid #1e293b;
    }

    /* Scroll States */
    .shiraa-header-wrapper.scrolled {
        transform: translateY(-40px);
        /* Moves entire wrapper up using GPU instead of margin-top */
    }

    .shiraa-header-wrapper.scrolled .shiraa-navbar {
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    .shiraa-navbar__inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
        padding: 0 32px;
        max-width: 1180px;
        margin: 0 auto;
    }

    /* Logo */
    .shiraa-logo img {
        height: 58px;
        object-fit: contain;
    }

    .shiraa-logo .logo-light {
        display: none;
    }

    .shiraa-logo .logo-dark {
        display: block;
    }

    .eh .shiraa-logo .logo-light {
        display: block;
    }

    .eh .shiraa-logo .logo-dark {
        display: none;
    }

    /* Navigation Links */
    .shiraa-nav ul {
        display: flex;
        align-items: center;
        gap: 2rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .shiraa-nav a {
        color: #1e293b;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        padding: 0.5rem 0;
        position: relative;
        transition: color 0.2s;
    }

    .eh .shiraa-nav a {
        color: #f1f5f9;
    }

    .shiraa-nav a:hover,
    .shiraa-nav a.active {
        color: #087db8;
    }

    /* Active Underline like SHIRAA */
    .shiraa-nav a.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #087db8;
    }

    /* Actions (Circular Icons) */
    .shiraa-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .shiraa-icon-btn {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        padding: 0;
    }

    .eh .shiraa-icon-btn {
        background: #1e293b;
        border-color: #334155;
        color: #94a3b8;
    }

    .shiraa-icon-btn:hover {
        background: #f8fafc;
        border-color: #087db8;
        color: #087db8;
        transform: translateY(-2px);
    }

    .shiraa-icon-btn svg {
        width: 18px;
        height: 18px;
    }

    /* Mobile Toggle */
    .shiraa-mobile-toggle {
        display: none;
        background: none;
        border: none;
        color: #0f172a;
        cursor: pointer;
        padding: 0;
        margin-right: 0.5rem;
    }

    .eh .shiraa-mobile-toggle {
        color: white;
    }

    .shiraa-mobile-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: white;
        padding: 1.5rem;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        border-top: 1px solid #f1f5f9;
        display: none;
        flex-direction: column;
        gap: 1rem;
    }

    .eh .shiraa-mobile-menu {
        background: #0f172a;
        border-color: #1e293b;
    }

    .shiraa-mobile-menu.active {
        display: flex;
    }

    @media (max-width: 992px) {
        .shiraa-topbar {
            display: none;
        }

        .shiraa-header-wrapper.scrolled {
            transform: translateY(0);
        }

        .shiraa-header-wrapper.scrolled .shiraa-topbar {
            margin-top: 0;
        }

        .shiraa-nav {
            display: none;
        }

        .shiraa-actions {
            display: flex;
            gap: 0.25rem;
            margin-right: auto;
            /* Pushes everything to the left, next to the menu */
            margin-left: 0.5rem;
        }

        /* Hide Search and Auth on mobile navbar to de-clutter */
        .shiraa-actions .shiraa-icon-btn:not(:first-child) {
            display: none;
        }

        .shiraa-icon-btn {
            width: 40px;
            height: 40px;
            background: transparent !important;
            /* Force transparency */
            border: none !important;
            color: #475569;
        }

        .eh .shiraa-icon-btn {
            color: #f1f5f9;
            background: transparent !important;
        }

        .shiraa-icon-btn:hover,
        .shiraa-icon-btn:active {
            background: rgba(0, 0, 0, 0.05) !important;
            border-radius: 50%;
        }

        .eh .shiraa-icon-btn:hover,
        .eh .shiraa-icon-btn:active {
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .shiraa-icon-btn svg {
            width: 22px;
            height: 22px;
        }

        .shiraa-mobile-toggle {
            display: block;
        }
    }

    .shiraa-nav__link {
        color: #1e293b;
        font-weight: 600;
        text-decoration: none;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
        transition: color 0.2s;
    }

    .eh .shiraa-nav__link {
        color: #f1f5f9;
        border-color: #1e293b;
    }

    .shiraa-nav__link:last-child {
        border-bottom: none;
    }

    .shiraa-nav__link.active,
    .shiraa-nav__link:hover {
        color: #0284c7;
    }
</style>

<div class="shiraa-header-wrapper" :class="{ 'scrolled' : stickyMenu }"
    @scroll.window.throttle.50ms="stickyMenu = (window.pageYOffset > 20) ? true : false">

    <!-- Top Bar -->
    <div class="shiraa-topbar">
        <div class="shiraa-topbar__side">
            <span class="shiraa-topbar__item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                {{ optional(\App\Models\Setting\ContactSetting::first())->address ?? 'القاهرة، مصر' }}
            </span>
            <span class="shiraa-topbar__item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                {{ optional(\App\Models\Setting\ContactSetting::first())->email ?? 'info@mas-cooling.com' }}
            </span>
        </div>
        <div class="shiraa-topbar__side">
            <a href="#">سياسة الخصوصية</a>
            <span>|</span>
            <a href="#">شروط الاستخدام</a>
            <span class="shiraa-topbar__item" style="margin-right: 1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
                العربية
            </span>
        </div>
    </div>

    <!-- Main Navbar -->
    <header class="shiraa-navbar">
        <div class="shiraa-navbar__inner">
            <!-- Right Side: Logo and Nav -->
            <div style="display: flex; align-items: center; gap: 2.5rem;">
                <!-- Logo -->
                <a href="{{ route('landing') }}" class="shiraa-logo">
                    <img src="{{ secure_asset('land/images/logo-light-opt.png') }}" width="70" height="70" alt="Mas Cooling Logo" class="logo-dark" />
                    <img src="{{ secure_asset('land/images/logo-dark-opt.png') }}" width="70" height="70" alt="Mas Cooling Logo" class="logo-light" />
                </a>

                <!-- Navigation Links -->
                <nav class="shiraa-nav">
                    <ul>
                        <li><a href="{{ route('landing') }}" class="active">الرئيسية</a></li>
                        <li><a href="#about">من نحن</a></li>
                        <li><a href="#projects">المشاريع</a></li>
                        <li><a href="#news">أحدث المقالات</a></li>
                        <li><a href="#contact">اتصل بنا</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Left Side: Actions and Mobile Toggle -->
            <div style="display: flex; align-items: center;">
                <!-- Actions (Minimalist Icons) -->
                <div class="shiraa-actions" style="display: flex; gap: 0.25rem; align-items: center;">
                    <!-- User/Auth -->
                    @if (Auth::check())
                    <a href="{{ route('dashboard') }}" class="shiraa-icon-btn" title="{{ Auth::user()->name }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                    @else
                    <a href="{{ route('loginform') }}" class="shiraa-icon-btn" title="تسجيل الدخول">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                            <polyline points="10 17 15 12 10 7"></polyline>
                            <line x1="15" y1="12" x2="3" y2="12"></line>
                        </svg>
                    </a>
                    @endif
                </div>

                <!-- Mobile Toggle -->
                <button class="shiraa-mobile-toggle" @click="navigationOpen = !navigationOpen" aria-label="القائمة">
                    <svg x-show="!navigationOpen" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                    <svg x-show="navigationOpen" x-cloak xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="shiraa-mobile-menu" :class="{ 'active' : navigationOpen }">
        <a href="{{ route('landing') }}" class="shiraa-nav__link active">الرئيسية</a>
        <a href="#about" class="shiraa-nav__link">من نحن</a>
        <a href="#projects" class="shiraa-nav__link">المشاريع</a>
        <a href="#news" class="shiraa-nav__link">أحدث المقالات</a>
        <a href="#contact" class="shiraa-nav__link">اتصل بنا</a>
        @if (Auth::check())
        <a href="{{ route('dashboard') }}" class="shiraa-nav__link" style="color: #0ea5e9;">لوحة التحكم ({{ Auth::user()->name }})</a>
        @else
        <a href="{{ route('loginform') }}" class="shiraa-nav__link" style="color: #0ea5e9;">تسجيل الدخول</a>
        @endif
    </div>
</div>
