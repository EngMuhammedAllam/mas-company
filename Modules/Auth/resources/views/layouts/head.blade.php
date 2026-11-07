<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Title -->
  <title>@yield('title', 'تسجيل الدخول | Mas Cooling')</title>

  <!-- Canonical URL -->
  <link rel="canonical" href="{{ url()->current() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ secure_asset('land/images/favicon.png') }}">

  <style>
    /* Minimal critical CSS for above-the-fold rendering */
    body{margin:0;font-family:ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;font-size:16px;line-height:26px;position:relative;z-index:1;color:#79808a}
    h1,h2,h3,h4,h5,h6{font-family:Outfit,"Segoe UI",sans-serif;font-size:inherit;font-weight:inherit}
    *,::before,::after{box-sizing:border-box;border-width:0;border-style:solid;border-color:currentColor}
    img,svg,video{display:block;vertical-align:middle;max-width:100%;height:auto}
    a{color:inherit;text-decoration:inherit}
    ul,ol,menu{list-style:none;margin:0;padding:0}
    button{cursor:pointer}
    [x-cloak]{display:none!important}
    .b{--tw-bg-opacity:1;background-color:rgb(18 24 38/var(--tw-bg-opacity))}
    .eh{color-scheme:dark}
    /* Header critical styles */
    .shiraa-header-wrapper{position:fixed;top:0;left:0;width:100%;z-index:1000;direction:rtl;font-family:'Inter','Segoe UI',sans-serif}
    .shiraa-topbar{background:#075985;color:#fff;padding:0 5%;font-size:.85rem;display:flex;justify-content:space-between;align-items:center;height:40px}
    .shiraa-navbar{background:#fff;box-shadow:0 2px 15px rgba(0,0,0,.05);height:85px}
    .eh .shiraa-navbar{background:#0f172a;box-shadow:0 2px 15px rgba(0,0,0,.5)}
    .shiraa-navbar__inner{display:flex;justify-content:space-between;align-items:center;height:100%;padding:0 5%;max-width:1400px;margin:0 auto}
    .shiraa-logo img{height:70px;object-fit:contain}
    .shiraa-actions{display:flex;gap:.75rem;align-items:center}
    .shiraa-icon-btn{width:42px;height:42px;border-radius:50%;background:#fff;border:1px solid #e2e8f0;display:flex;align-items:center;justify-content:center;color:#475569;text-decoration:none;padding:0}
    .eh .shiraa-icon-btn{background:#1e293b;border-color:#334155;color:#94a3b8}
    .shiraa-mobile-toggle{display:none}
    @media(max-width:992px){.shiraa-topbar{display:none}.shiraa-actions{display:flex}.shiraa-mobile-toggle{display:block}}
  </style>

  <!-- ============ Main CSS ============ -->
  <link rel="preload" href="{{ secure_asset('land/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link href="{{ secure_asset('land/style.css') }}" rel="stylesheet"></noscript>

  <!-- ============ Google Fonts ============ -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Outfit:wght@700&display=swap" rel="stylesheet" media="print" onload="this.media='all'">

  <!-- ============ FontAwesome ============ -->
  <script>
    window.addEventListener('load', function() {
      setTimeout(function() {
        var fa = document.createElement('link');
        fa.rel = 'stylesheet';
        fa.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
        document.head.appendChild(fa);
      }, 50);
    });
  </script>
</head>

<body
  x-data='{ page: @json($page ?? "login"), darkMode: true, stickyMenu: false, navigationOpen: false, scrollTop: false }'
  x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))"
  :class="{ 'b eh': darkMode }">