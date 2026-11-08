<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') — mas Cool</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ===== mas Cool admin — same tokens as the public home page ===== */
        :root{
            --navy:#062b39;--navy-deep:#031d27;--navy-mid:#0a3d4e;--ink:#082d3b;
            --muted:#5c737e;--muted-soft:#7e939d;
            --lime:#d4f83f;--lime-hover:#c6ef28;--lime-deep:#7c941a;--lime-soft:#f1ffc4;
            --ice:#f1f6f8;--paper:#f8fbfb;--line:#dce7eb;--line-soft:#e8eff2;--white:#fff;
            --danger:#b3261e;--danger-soft:#fdecea;
            --shadow-sm:0 2px 8px rgba(5,43,57,.04);
            --shadow:0 10px 30px rgba(5,43,57,.07);
            --shadow-lg:0 22px 54px rgba(3,29,39,.16);
            --r-sm:8px;--r-md:14px;--r-lg:20px;--r-pill:999px;
            --sidebar-w:264px;--header-h:76px;
        }
        *{box-sizing:border-box}
        html,body{max-width:100%;overflow-x:clip}
        body{margin:0;background:var(--paper);color:var(--ink);font-family:"Cairo",Tahoma,Arial,sans-serif;font-size:15px;line-height:1.8}
        a{color:inherit;text-decoration:none}
        button,input,select,textarea{font:inherit}
        h1,h2,h3,p{margin:0}
        img{display:block;max-width:100%}
        :focus-visible{outline:3px solid var(--lime-deep);outline-offset:2px;border-radius:4px}
        .visually-hidden{position:absolute;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap;border:0}

        /* ---------- shell ---------- */
        .shell{display:grid;grid-template-columns:var(--sidebar-w) 1fr;min-height:100vh}
        /* grid column 1 resolves to the right-hand side under dir="rtl" */
        .sidebar{grid-column:1;background:var(--navy-deep);color:#fff;display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow-y:auto}
        .main{grid-column:2;min-width:0;display:flex;flex-direction:column}

        /* ---------- brand ---------- */
        .brand{display:flex;align-items:center;gap:10px;padding:18px 20px;border-bottom:1px solid rgba(255,255,255,.08)}
        .brand__mark{width:38px;height:38px;padding:7px;border-radius:10px;color:var(--lime);background:rgba(255,255,255,.07);flex:none}
        .brand__word{font-family:Arial,sans-serif;font-size:21px;line-height:1.1;font-weight:800;letter-spacing:-1.1px;direction:ltr}
        .brand__tag{font-size:10px;line-height:1.5;color:#8ca3ac}

        /* ---------- sidebar nav ---------- */
        .nav{padding:14px 12px 24px;flex:1}
        .nav__group{margin-bottom:18px}
        .nav__label{display:block;padding:0 10px 8px;font-size:11px;font-weight:800;letter-spacing:.06em;color:#7e939d}
        .nav__link{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:var(--r-sm);color:#c3d4da;font-size:14px;font-weight:600;transition:background .18s ease,color .18s ease}
        .nav__link:hover{background:rgba(255,255,255,.06);color:#fff}
        .nav__link.is-active{background:var(--lime);color:var(--navy);font-weight:800}
        .nav__link .ic{width:18px;height:18px;flex:none;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
        .nav__count{margin-inline-start:auto;font-size:11px;font-weight:700;background:rgba(255,255,255,.1);padding:1px 7px;border-radius:var(--r-pill)}
        .nav__link.is-active .nav__count{background:rgba(6,43,57,.15)}
        details.nav__group>summary{list-style:none;cursor:pointer;display:flex;align-items:center;gap:8px;padding:0 10px 8px;font-size:11px;font-weight:800;letter-spacing:.06em;color:#7e939d}
        details.nav__group>summary::-webkit-details-marker{display:none}
        details.nav__group>summary:after{content:"▾";margin-inline-start:auto;font-size:12px}

        /* ---------- header ---------- */
        .topbar{position:sticky;top:0;z-index:30;height:var(--header-h);display:flex;align-items:center;gap:14px;padding:0 clamp(16px,2.4vw,28px);background:rgba(248,251,251,.92);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}
        .topbar__titles{min-width:0;flex:1}
        .topbar__crumb{font-size:12px;color:var(--muted);line-height:1.6}
        .topbar__crumb a:hover{color:var(--navy)}
        .topbar__title{font-size:19px;font-weight:800;line-height:1.4;letter-spacing:-.4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .topbar__actions{display:flex;align-items:center;gap:8px;flex:none}
        .menu-toggle{display:none;width:44px;height:44px;border:1px solid var(--line);border-radius:var(--r-sm);background:#fff;color:var(--navy);font-size:19px}

        .account{position:relative}
        .account__btn{display:flex;align-items:center;gap:8px;height:42px;padding:0 12px;border:1px solid var(--line);border-radius:var(--r-sm);background:#fff;font-size:13px;font-weight:700;color:var(--ink)}
        .account__avatar{width:26px;height:26px;border-radius:50%;background:var(--navy);color:var(--lime);display:grid;place-items:center;font-size:12px;font-weight:800}
        .account__menu{position:absolute;inset-inline-end:0;top:calc(100% + 6px);min-width:190px;background:#fff;border:1px solid var(--line);border-radius:var(--r-md);box-shadow:var(--shadow);padding:6px;display:none;z-index:40}
        .account__menu.open{display:block}
        .account__menu a,.account__menu button{display:flex;width:100%;align-items:center;gap:8px;padding:9px 10px;border:0;border-radius:var(--r-sm);background:none;font-size:13.5px;color:var(--ink);text-align:start;cursor:pointer}
        .account__menu a:hover,.account__menu button:hover{background:var(--ice)}
        .account__menu .is-danger{color:var(--danger)}

        /* ---------- content ---------- */
        .content{padding:clamp(18px,2.4vw,28px);flex:1}
        .page-head{display:flex;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:20px;flex-wrap:wrap}
        .page-head__text{min-width:0}
        .page-head h1{font-size:clamp(21px,2.2vw,27px);font-weight:800;line-height:1.35;letter-spacing:-.6px}
        .page-head p{font-size:14px;color:var(--muted);margin-top:4px}

        /* ---------- buttons ---------- */
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;min-height:44px;padding:9px 18px;border:1px solid transparent;border-radius:var(--r-sm);font-size:14px;font-weight:700;cursor:pointer;transition:background .18s ease,border-color .18s ease,color .18s ease,opacity .18s ease}
        .btn--primary{background:var(--lime);color:var(--navy);font-weight:800}
        .btn--primary:hover{background:var(--lime-hover)}
        .btn--dark{background:var(--navy);color:#fff}
        .btn--dark:hover{background:var(--navy-mid)}
        .btn--outline{background:#fff;border-color:var(--line);color:var(--ink)}
        .btn--outline:hover{border-color:var(--navy);background:var(--ice)}
        .btn--danger{background:#fff;border-color:#e6c4c1;color:var(--danger)}
        .btn--danger:hover{background:var(--danger-soft)}
        .btn--sm{min-height:36px;padding:5px 12px;font-size:13px}
        .btn[disabled],.btn.is-loading{opacity:.6;pointer-events:none}
        .btn.is-loading:after{content:"";width:13px;height:13px;border:2px solid currentColor;border-top-color:transparent;border-radius:50%;animation:spin .7s linear infinite}
        @keyframes spin{to{transform:rotate(360deg)}}

        /* ---------- cards ---------- */
        .card{background:#fff;border:1px solid var(--line-soft);border-radius:var(--r-lg);box-shadow:var(--shadow-sm)}
        .card__head{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:16px 18px;border-bottom:1px solid var(--line-soft)}
        .card__head h2{font-size:16px;font-weight:800;line-height:1.5}
        .card__head p{font-size:12.5px;color:var(--muted)}
        .card__body{padding:18px}
        .grid{display:grid;gap:16px}
        .grid--stats{grid-template-columns:repeat(auto-fit,minmax(210px,1fr))}
        .grid--2{grid-template-columns:repeat(auto-fit,minmax(320px,1fr))}

        /* ---------- stat ---------- */
        .stat{background:#fff;border:1px solid var(--line-soft);border-radius:var(--r-lg);padding:16px 18px;box-shadow:var(--shadow-sm)}
        .stat__label{display:flex;align-items:center;gap:8px;font-size:12.5px;font-weight:700;color:var(--muted)}
        .stat__label .ic{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:1.8;color:var(--lime-deep)}
        .stat__value{font-size:30px;font-weight:800;line-height:1.3;letter-spacing:-1px;margin-top:4px}
        .stat__hint{font-size:12px;color:var(--muted-soft)}

        /* ---------- forms ---------- */
        .form-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px}
        .field{min-width:0}
        .field--full{grid-column:1/-1}
        .field label{display:block;font-size:13px;font-weight:700;margin-bottom:6px}
        .field .hint{font-size:12px;color:var(--muted-soft);margin-top:4px}
        .field input[type=text],.field input[type=number],.field input[type=email],.field input[type=url],.field input[type=file],.field select,.field textarea{
            width:100%;min-height:46px;border:1px solid #d3e0e5;border-radius:var(--r-sm);background:#fff;padding:10px 13px;color:var(--ink);font-size:14px;outline:0;
            transition:border-color .18s ease,box-shadow .18s ease}
        .field textarea{min-height:100px;resize:vertical;line-height:1.8}
        .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--lime-deep);box-shadow:0 0 0 3px rgba(212,248,63,.3)}
        .field .is-invalid,.field input.is-invalid,.field textarea.is-invalid,.field select.is-invalid{border-color:var(--danger);box-shadow:0 0 0 3px rgba(179,38,30,.1)}
        .field .error{display:block;font-size:12.5px;color:var(--danger);margin-top:5px;font-weight:600}
        .custom-select{position:relative;width:100%;min-width:0}
        .custom-select__native{position:absolute!important;width:1px!important;height:1px!important;padding:0!important;margin:-1px!important;overflow:hidden!important;clip:rect(0 0 0 0)!important;white-space:nowrap!important;border:0!important;opacity:0!important;pointer-events:none!important}
        .custom-select__button{width:100%;min-height:46px;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:10px 13px;border:1px solid #d3e0e5;border-radius:var(--r-sm);background:#fff;color:var(--ink);font-size:14px;text-align:start;cursor:pointer;outline:0;transition:border-color .18s ease,box-shadow .18s ease,background .18s ease}
        .custom-select__button:hover{border-color:#afc4cc;background:#fcfefe}
        .custom-select__button:focus-visible,.custom-select.is-open .custom-select__button{border-color:var(--lime-deep);box-shadow:0 0 0 3px rgba(212,248,63,.3)}
        .custom-select.is-invalid .custom-select__button{border-color:var(--danger);box-shadow:0 0 0 3px rgba(179,38,30,.1)}
        .custom-select__button[disabled]{background:var(--ice);color:var(--muted-soft);cursor:not-allowed}
        .custom-select__value{min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
        .custom-select__chevron{width:8px;height:8px;border-inline-end:2px solid currentColor;border-bottom:2px solid currentColor;transform:rotate(45deg);transition:transform .18s ease;flex:none;margin-inline-end:2px}
        .custom-select.is-open .custom-select__chevron{transform:rotate(225deg);margin-top:5px}
        .custom-select__menu{position:fixed;z-index:1000;padding:6px;background:#fff;border:1px solid var(--line);border-radius:12px;box-shadow:var(--shadow-lg);overflow-y:auto;overscroll-behavior:contain}
        .custom-select__menu[hidden]{display:none}
        .custom-select__option{width:100%;display:flex;align-items:center;justify-content:space-between;gap:10px;min-height:40px;padding:8px 10px;border:0;border-radius:8px;background:transparent;color:var(--ink);font-size:13.5px;text-align:start;cursor:pointer}
        .custom-select__option:hover,.custom-select__option.is-active{background:var(--ice)}
        .custom-select__option[aria-selected="true"]{background:var(--lime-soft);color:var(--navy);font-weight:800}
        .custom-select__option[aria-selected="true"]:after{content:"✓";font-size:12px;color:var(--lime-deep);flex:none}
        .custom-select__option[disabled]{opacity:.45;cursor:not-allowed}
        .switch{display:inline-flex;align-items:center;gap:9px;cursor:pointer;font-size:13.5px;font-weight:700;min-height:44px}
        .switch input{position:absolute;opacity:0;width:0;height:0}
        .switch__track{width:42px;height:24px;border-radius:var(--r-pill);background:#cbd9de;position:relative;transition:background .18s ease;flex:none}
        .switch__track:after{content:"";position:absolute;top:3px;inset-inline-start:3px;width:18px;height:18px;border-radius:50%;background:#fff;transition:transform .18s ease}
        .switch input:checked+.switch__track{background:var(--lime-deep)}
        .switch input:checked+.switch__track:after{transform:translateX(-18px)}
        .switch input:focus-visible+.switch__track{outline:3px solid var(--lime-deep);outline-offset:2px}

        /* image preview */
        .media-preview{display:flex;align-items:center;gap:14px;padding:12px;border:1px solid var(--line);border-radius:var(--r-md);background:var(--ice);flex-wrap:wrap}
        .media-preview__img{width:140px;height:88px;border-radius:var(--r-sm);background:#ecf5fc;object-fit:contain;padding:6px;flex:none}
        .media-preview__meta{font-size:12.5px;color:var(--muted);min-width:0}
        .media-preview__meta code{font-size:11.5px;word-break:break-all;color:var(--navy-mid)}

        /* ---------- tables ---------- */
        .table-wrap{overflow-x:auto}
        table.tbl{width:100%;border-collapse:collapse;min-width:720px}
        table.tbl th,table.tbl td{padding:11px 12px;text-align:start;border-bottom:1px solid var(--line-soft);font-size:13.5px;vertical-align:middle}
        table.tbl th{font-size:12px;font-weight:800;color:var(--muted);background:var(--ice);white-space:nowrap}
        table.tbl tbody tr:hover{background:var(--paper)}
        .thumb{width:62px;height:42px;border-radius:6px;background:#ecf5fc;object-fit:contain;padding:3px}
        .row-actions{display:flex;gap:6px;flex-wrap:wrap}

        /* ---------- badges ---------- */
        .badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:var(--r-pill);font-size:11.5px;font-weight:700;line-height:1.7;white-space:nowrap}
        .badge--on{background:var(--lime-soft);color:var(--lime-deep)}
        .badge--off{background:var(--ice);color:var(--muted)}
        .badge--navy{background:rgba(6,43,57,.08);color:var(--navy)}
        .badge--star{background:#fff5d6;color:#916c05}

        /* ---------- filters ---------- */
        .filterbar{display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end}
        .filterbar .field{flex:1 1 170px}
        .filterbar input,.filterbar select{min-height:42px}
        .filterbar .custom-select__button{min-height:42px;padding-block:8px}

        /* ---------- flash ---------- */
        .flash{display:flex;align-items:flex-start;gap:10px;padding:12px 15px;border-radius:var(--r-md);font-size:13.5px;font-weight:600;margin-bottom:16px;border:1px solid}
        .flash--ok{background:var(--lime-soft);border-color:#cbe47f;color:#44600a}
        .flash--err{background:var(--danger-soft);border-color:#e6c4c1;color:var(--danger)}

        /* ---------- empty ---------- */
        .empty{text-align:center;padding:42px 20px;color:var(--muted)}
        .empty h3{font-size:16px;font-weight:800;color:var(--ink);margin-bottom:4px}
        .empty p{font-size:13.5px;margin-bottom:14px}

        /* ---------- pagination ---------- */
        .pager{display:flex;gap:6px;flex-wrap:wrap;justify-content:center;margin-top:16px}
        .pager a,.pager span{min-width:38px;height:38px;display:grid;place-items:center;padding:0 10px;border:1px solid var(--line);border-radius:var(--r-sm);background:#fff;font-size:13px;font-weight:700}
        .pager .is-current{background:var(--navy);border-color:var(--navy);color:#fff}
        .pager .is-disabled{opacity:.45}

        /* ---------- scrim / drawer ---------- */
        .scrim{position:fixed;inset:0;z-index:50;background:rgba(3,29,39,.5);opacity:0;visibility:hidden;transition:opacity .22s ease}
        .scrim.open{opacity:1;visibility:visible}
        body.locked{overflow:hidden}

        /* ---------- responsive ---------- */
        @media(max-width:1024px){
            .shell{grid-template-columns:1fr}
            .main{grid-column:1}
            .sidebar{grid-column:1}
            .sidebar{position:fixed;inset:0 0 0 auto;z-index:60;width:min(84vw,290px);transform:translateX(100%);visibility:hidden;transition:transform .24s ease;height:100dvh}
            .sidebar.open{transform:none;visibility:visible}
            .menu-toggle{display:grid;place-items:center}
            .sidebar__close{display:grid!important}
        }
        .sidebar__close{display:none;width:38px;height:38px;place-items:center;border:1px solid rgba(255,255,255,.18);border-radius:var(--r-sm);background:transparent;color:#fff;font-size:18px;margin-inline-start:auto}
        @media(max-width:640px){
            :root{--header-h:66px}
            .topbar__title{font-size:16px}
            .page-head{align-items:stretch}
            .page-head .btn{width:100%}
            .form-grid{grid-template-columns:1fr}
            .card__body{padding:14px}
            .content{padding:14px}
            .custom-select__button{min-height:44px;padding:8px 10px;font-size:13px}
            .custom-select__menu{padding:5px;border-radius:11px}
            .custom-select__option{min-height:42px;font-size:13px}
            /* tables become stacked cards */
            table.tbl{min-width:0}
            table.tbl thead{display:none}
            table.tbl tr{display:block;border:1px solid var(--line-soft);border-radius:var(--r-md);padding:10px;margin-bottom:10px;background:#fff}
            table.tbl td{display:flex;justify-content:space-between;gap:12px;border:0;padding:5px 2px}
            table.tbl td:before{content:attr(data-label);font-size:12px;font-weight:800;color:var(--muted);flex:none}
            .row-actions{justify-content:flex-end}
        }
        @media(prefers-reduced-motion:reduce){*{transition:none!important;animation:none!important}}
    </style>
    @stack('styles')
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true"><defs>
    <symbol id="i-snow" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M24 3v42M6 13l36 22M6 35l36-22M19 7l5 5 5-5M19 41l5-5 5 5M8 19l7 2-2-7M40 29l-7-2 2 7M13 34l2-7-7 2M35 14l-2 7 7-2"/></g></symbol>
    <symbol id="i-grid" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></symbol>
    <symbol id="i-star" viewBox="0 0 24 24"><path d="m12 3 2.7 5.6 6.3.9-4.5 4.4 1 6.1-5.5-3-5.5 3 1-6.1L3 9.5l6.3-.9z"/></symbol>
    <symbol id="i-layers" viewBox="0 0 24 24"><path d="m12 3 9 5-9 5-9-5z"/><path d="m3 13 9 5 9-5"/></symbol>
    <symbol id="i-box" viewBox="0 0 24 24"><path d="M21 8 12 3 3 8v8l9 5 9-5z"/><path d="m3 8 9 5 9-5M12 13v8"/></symbol>
    <symbol id="i-eye" viewBox="0 0 24 24"><path d="M2 12s3.6-6 10-6 10 6 10 6-3.6 6-10 6-10-6-10-6z"/><circle cx="12" cy="12" r="2.6"/></symbol>
    <symbol id="i-steps" viewBox="0 0 24 24"><path d="M4 18h5v-5h5V8h6"/><circle cx="4" cy="18" r="1.6"/><circle cx="20" cy="8" r="1.6"/></symbol>
    <symbol id="i-help" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9.5 9.2a2.6 2.6 0 1 1 3.4 2.5c-.6.2-.9.8-.9 1.5M12 17h.01"/></symbol>
    <symbol id="i-chat" viewBox="0 0 24 24"><path d="M21 12a8 8 0 0 1-11.6 7.1L3 21l1.9-6.4A8 8 0 1 1 21 12z"/></symbol>
    <symbol id="i-seo" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m16 16 5 5"/></symbol>
    <symbol id="i-spark" viewBox="0 0 24 24"><path d="M12 3v6M12 15v6M3 12h6M15 12h6"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="m8 12 3 3 5-6"/></symbol>
</defs></svg>

<div class="scrim" id="scrim" hidden></div>

<div class="shell">
    @include('dashboard.mascool.layouts.sidebar')

    <div class="main">
        <header class="topbar">
            <button class="menu-toggle" type="button" id="menuToggle" aria-expanded="false" aria-controls="adminSidebar" aria-label="فتح القائمة">☰</button>
            <div class="topbar__titles">
                <nav class="topbar__crumb" aria-label="مسار التنقل">
                    <a href="{{ route('dashboard') }}">لوحة التحكم</a>
                    @hasSection('breadcrumb') <span aria-hidden="true">/</span> @yield('breadcrumb') @endif
                </nav>
                <div class="topbar__title">@yield('title', 'لوحة التحكم')</div>
            </div>
            <div class="topbar__actions">
                <a class="btn btn--outline btn--sm" href="{{ route('landing') }}" target="_blank" rel="noopener">
                    <svg class="ic" width="16" height="16" aria-hidden="true"><use href="#i-eye"/></svg> معاينة الموقع
                </a>
                <div class="account">
                    <button class="account__btn" type="button" id="accountBtn" aria-expanded="false" aria-haspopup="true">
                        <span class="account__avatar" aria-hidden="true">{{ mb_substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                        <span class="visually-hidden">حساب المستخدم</span>
                        <span aria-hidden="true">▾</span>
                    </button>
                    <div class="account__menu" id="accountMenu" role="menu">
                        <a href="{{ route('landing') }}" target="_blank" rel="noopener" role="menuitem">عرض الموقع</a>
                        <a href="{{ route('admin.contact-settings.edit') }}" role="menuitem">إعدادات التواصل</a>
                        <a class="is-danger" href="{{ route('dashboard.logout') }}" role="menuitem">تسجيل الخروج</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="content">
            @if(session('success'))
                <div class="flash flash--ok" role="status">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="flash flash--err" role="alert">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="flash flash--err" role="alert">يوجد {{ $errors->count() }} خطأ في البيانات المُدخلة. راجع الحقول المظللة بالأحمر.</div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script>
'use strict';
(function(){
    const sidebar=document.getElementById('adminSidebar');
    const toggle=document.getElementById('menuToggle');
    const scrim=document.getElementById('scrim');
    const closeBtn=document.getElementById('sidebarClose');
    const desktop=matchMedia('(min-width:1025px)');
    let open=false;

    function setSidebar(next){
        if(open===next)return;
        open=next;
        sidebar.classList.toggle('open',next);
        scrim.classList.toggle('open',next);
        scrim.hidden=!next;
        document.body.classList.toggle('locked',next);
        toggle.setAttribute('aria-expanded',String(next));
        if(next){
            const first=sidebar.querySelector('a,button');
            if(first)first.focus({preventScroll:true});
        }else{
            toggle.focus({preventScroll:true});
        }
    }
    toggle.addEventListener('click',()=>setSidebar(!open));
    scrim.addEventListener('click',()=>setSidebar(false));
    if(closeBtn)closeBtn.addEventListener('click',()=>setSidebar(false));
    // choosing a route closes the drawer
    sidebar.addEventListener('click',e=>{if(e.target.closest('a'))setSidebar(false);});
    // never leave a stale drawer behind after a resize to desktop
    desktop.addEventListener('change',e=>{if(e.matches)setSidebar(false);});
    addEventListener('keydown',e=>{
        if(e.key==='Escape'&&open){e.preventDefault();setSidebar(false);}
    });

    const accBtn=document.getElementById('accountBtn');
    const accMenu=document.getElementById('accountMenu');
    accBtn.addEventListener('click',e=>{
        e.stopPropagation();
        const next=!accMenu.classList.contains('open');
        accMenu.classList.toggle('open',next);
        accBtn.setAttribute('aria-expanded',String(next));
    });
    document.addEventListener('click',()=>{accMenu.classList.remove('open');accBtn.setAttribute('aria-expanded','false');});
    addEventListener('keydown',e=>{if(e.key==='Escape')accMenu.classList.remove('open');});

    // confirm + loading state for destructive submits
    document.addEventListener('submit',e=>{
        const form=e.target.closest('form[data-confirm]');
        if(form&&!confirm(form.dataset.confirm)){e.preventDefault();return;}
        const btn=e.target.querySelector('button[type=submit]');
        if(btn&&!e.defaultPrevented)btn.classList.add('is-loading');
    });

    // live preview when picking a replacement image
    document.querySelectorAll('input[type=file][data-preview]').forEach(input=>{
        input.addEventListener('change',()=>{
            const img=document.querySelector(input.dataset.preview);
            const file=input.files&&input.files[0];
            if(img&&file)img.src=URL.createObjectURL(file);
        });
    });

    // Accessible custom select — keeps the native value for forms, but never
    // exposes the browser/OS dropdown UI to the administrator.
    const customSelects=[];
    let customSelectId=0;

    function closeCustomSelects(except=null){
        customSelects.forEach(instance=>{if(instance!==except)instance.close();});
    }

    function enhanceSelect(select){
        if(select.dataset.customSelectReady==='true'||select.multiple)return;
        select.dataset.customSelectReady='true';

        if(!select.id)select.id=`mas-select-${++customSelectId}`;
        const wrapper=document.createElement('div');
        wrapper.className='custom-select';
        if(select.classList.contains('is-invalid'))wrapper.classList.add('is-invalid');

        const button=document.createElement('button');
        button.type='button';
        button.className='custom-select__button';
        button.setAttribute('role','combobox');
        button.setAttribute('aria-haspopup','listbox');
        button.setAttribute('aria-expanded','false');
        button.disabled=select.disabled;

        const value=document.createElement('span');
        value.className='custom-select__value';
        const chevron=document.createElement('span');
        chevron.className='custom-select__chevron';
        chevron.setAttribute('aria-hidden','true');
        button.append(value,chevron);

        const menu=document.createElement('div');
        menu.className='custom-select__menu';
        menu.id=`${select.id}-listbox`;
        menu.setAttribute('role','listbox');
        menu.hidden=true;
        menu.dir=getComputedStyle(select).direction||'rtl';
        button.setAttribute('aria-controls',menu.id);

        const labels=Array.from(document.querySelectorAll('label')).filter(label=>label.htmlFor===select.id);
        const accessibleLabel=labels.map(label=>label.textContent.trim()).filter(Boolean).join('، ')||select.getAttribute('aria-label')||'اختر من القائمة';
        button.setAttribute('aria-label',accessibleLabel);

        const optionButtons=Array.from(select.options).map((option,index)=>{
            const item=document.createElement('button');
            item.type='button';
            item.className='custom-select__option';
            item.id=`${menu.id}-option-${index}`;
            item.setAttribute('role','option');
            item.dataset.index=String(index);
            item.textContent=option.textContent.trim();
            item.disabled=option.disabled;
            item.tabIndex=-1;
            menu.appendChild(item);
            return item;
        });

        select.parentNode.insertBefore(wrapper,select);
        wrapper.append(select,button);
        select.classList.add('custom-select__native');
        select.tabIndex=-1;
        select.setAttribute('aria-hidden','true');
        document.body.appendChild(menu);

        let activeIndex=Math.max(0,select.selectedIndex);
        let typeahead='';
        let typeaheadTimer=0;

        function sync(){
            const selected=select.options[select.selectedIndex];
            value.textContent=selected?.textContent.trim()||'اختر من القائمة';
            optionButtons.forEach((item,index)=>item.setAttribute('aria-selected',String(index===select.selectedIndex)));
            button.disabled=select.disabled;
        }

        function positionMenu(){
            const rect=button.getBoundingClientRect();
            const gap=6;
            const below=window.innerHeight-rect.bottom-gap;
            const above=rect.top-gap;
            const openAbove=below<180&&above>below;
            const space=Math.max(110,Math.min(280,(openAbove?above:below)-6));
            menu.style.left=`${rect.left}px`;
            menu.style.width=`${rect.width}px`;
            menu.style.maxHeight=`${space}px`;
            menu.style.top=openAbove?'auto':`${rect.bottom+gap}px`;
            menu.style.bottom=openAbove?`${window.innerHeight-rect.top+gap}px`:'auto';
        }

        function setActive(index){
            if(!optionButtons.length)return;
            let next=Math.max(0,Math.min(index,optionButtons.length-1));
            const step=next>=activeIndex?1:-1;
            while(optionButtons[next]?.disabled&&next>=0&&next<optionButtons.length)next+=step;
            if(next<0||next>=optionButtons.length)return;
            activeIndex=next;
            optionButtons.forEach((item,itemIndex)=>item.classList.toggle('is-active',itemIndex===activeIndex));
            button.setAttribute('aria-activedescendant',optionButtons[activeIndex].id);
            optionButtons[activeIndex].scrollIntoView({block:'nearest'});
        }

        function open(){
            if(button.disabled)return;
            closeCustomSelects(instance);
            wrapper.classList.add('is-open');
            button.setAttribute('aria-expanded','true');
            menu.hidden=false;
            positionMenu();
            setActive(Math.max(0,select.selectedIndex));
        }

        function close(){
            wrapper.classList.remove('is-open');
            button.setAttribute('aria-expanded','false');
            button.removeAttribute('aria-activedescendant');
            menu.hidden=true;
        }

        function choose(index){
            if(!select.options[index]||select.options[index].disabled)return;
            select.selectedIndex=index;
            select.dispatchEvent(new Event('input',{bubbles:true}));
            select.dispatchEvent(new Event('change',{bubbles:true}));
            wrapper.classList.remove('is-invalid');
            sync();
            close();
            button.focus();
        }

        const instance={select,wrapper,button,menu,open,close,sync};
        customSelects.push(instance);

        button.addEventListener('click',()=>menu.hidden?open():close());
        button.addEventListener('keydown',event=>{
            if(event.key==='ArrowDown'||event.key==='ArrowUp'){
                event.preventDefault();
                if(menu.hidden)open();
                setActive(activeIndex+(event.key==='ArrowDown'?1:-1));
            }else if(event.key==='Home'&&!menu.hidden){
                event.preventDefault();setActive(0);
            }else if(event.key==='End'&&!menu.hidden){
                event.preventDefault();setActive(optionButtons.length-1);
            }else if((event.key==='Enter'||event.key===' ')&&!menu.hidden){
                event.preventDefault();choose(activeIndex);
            }else if(event.key==='Enter'||event.key===' '){
                event.preventDefault();open();
            }else if(event.key==='Escape'&&!menu.hidden){
                event.preventDefault();close();
            }else if(event.key==='Tab'){
                close();
            }else if(event.key.length===1&&!event.ctrlKey&&!event.metaKey&&!event.altKey){
                clearTimeout(typeaheadTimer);
                typeahead+=event.key.toLocaleLowerCase('ar');
                typeaheadTimer=setTimeout(()=>{typeahead='';},650);
                const match=Array.from(select.options).findIndex(option=>!option.disabled&&option.textContent.trim().toLocaleLowerCase('ar').startsWith(typeahead));
                if(match>=0){if(menu.hidden)open();setActive(match);}
            }
        });

        optionButtons.forEach((item,index)=>item.addEventListener('click',()=>choose(index)));
        labels.forEach(label=>label.addEventListener('click',event=>{
            event.preventDefault();
            button.focus();
        }));
        select.addEventListener('change',sync);
        select.addEventListener('invalid',()=>{
            wrapper.classList.add('is-invalid');
            setTimeout(()=>button.focus(),0);
        });
        select.form?.addEventListener('reset',()=>setTimeout(sync,0));
        sync();
    }

    document.querySelectorAll('select:not([multiple])').forEach(enhanceSelect);
    document.addEventListener('click',event=>{
        if(!customSelects.some(instance=>instance.wrapper.contains(event.target)||instance.menu.contains(event.target)))closeCustomSelects();
    });
    addEventListener('resize',()=>closeCustomSelects());
    addEventListener('scroll',event=>{
        if(!event.target?.closest?.('.custom-select__menu'))closeCustomSelects();
    },true);

    new MutationObserver(mutations=>{
        mutations.forEach(mutation=>mutation.addedNodes.forEach(node=>{
            if(!(node instanceof Element))return;
            if(node.matches('select:not([multiple])'))enhanceSelect(node);
            node.querySelectorAll?.('select:not([multiple])').forEach(enhanceSelect);
        }));
    }).observe(document.body,{childList:true,subtree:true});
})();
</script>
@stack('scripts')
</body>
</html>
