<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Title -->
  <title>@yield('title', $seo->meta_title ?? 'Default Title')</title>

  <!-- Basic Meta Tags -->
  <meta name="description" content="@yield('meta_description', $seo->meta_description ?? '')">
  <meta name="keywords" content="@yield('meta_keywords', $seo->meta_keywords ?? '')">

  @if(!empty($seo->author))
    <meta name="author" content="{{ $seo->author }}">
  @endif

  <!-- Canonical URL -->
  <link rel="canonical" href="@yield('canonical', $seo->canonical_url ?? url()->current())">

  <!-- Robots Meta -->
  <meta name="robots" content="{{ $seo->robots ?? 'index,follow' }}">

  <!-- Open Graph -->
  <meta property="og:type" content="@yield('og_type', $seo->og_type ?? 'website')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('og_title', $seo->meta_title ?? '')">
  <meta property="og:description" content="@yield('og_description', $seo->meta_description ?? '')">
  <meta property="og:locale" content="ar_EG">

  @if(!empty($seo->og_site_name))
    <meta property="og:site_name" content="{{ $seo->og_site_name }}">
  @endif

  @if(!empty($seo->og_image))
    <meta property="og:image" content="{{ asset('storage/' . $seo->og_image) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
  @endif

  <!-- Twitter -->
  <meta name="twitter:card" content="{{ $seo->twitter_card_type ?? 'summary_large_image' }}">
  <meta name="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="@yield('twitter_title', $seo->meta_title ?? '')">
  <meta name="twitter:description" content="@yield('twitter_description', $seo->meta_description ?? '')">

  @if(!empty($seo->twitter_handle))
    <meta name="twitter:site" content="{{ $seo->twitter_handle }}">
    <meta name="twitter:creator" content="{{ $seo->twitter_handle }}">
  @endif

  @if(!empty($seo->og_image))
    <meta name="twitter:image" content="{{ asset('storage/' . $seo->og_image) }}">
  @endif

  <!-- Custom Header Scripts -->
  {!! $seo->header_code ?? '' !!}

  <!-- ================= Schema.org ================= -->

  <!-- Organization -->
  <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'Organization',
      'name' => $seo->meta_title ?? config('app.name'),
      'url' => url('/'),
      'logo' => asset('land/images/logo.png'),
      'description' => $seo->meta_description ?? '',
      'contactPoint' => [
        '@type' => 'ContactPoint',
        'telephone' => optional(\App\Models\Setting\ContactSetting::first())->phone,
        'contactType' => 'customer service',
        'areaServed' => 'EG',
        'availableLanguage' => ['Arabic', 'English']
      ],
      'sameAs' => array_filter([
        optional(\App\Models\Setting\ContactSetting::first())->facebook,
        optional(\App\Models\Setting\ContactSetting::first())->twitter,
        optional(\App\Models\Setting\ContactSetting::first())->linkedin,
        optional(\App\Models\Setting\ContactSetting::first())->instagram,
      ])
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>

  <!-- WebSite -->
  <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'WebSite',
      'name' => $seo->og_site_name ?? $seo->meta_title ?? config('app.name'),
      'url' => url('/'),
      'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => [
          '@type' => 'EntryPoint',
          'urlTemplate' => url('/') . '?q={search_term_string}'
        ],
        'query-input' => 'required name=search_term_string'
      ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
  </script>

  <!-- Breadcrumbs -->
  @php
    $breadcrumbs = [
      [
        '@type' => 'ListItem',
        'position' => 1,
        'name' => 'Home',
        'item' => url('/')
      ]
    ];

    if (request()->segment(1)) {
      $breadcrumbs[] = [
        '@type' => 'ListItem',
        'position' => 2,
        'name' => ucfirst(request()->segment(1)),
        'item' => url(request()->segment(1))
      ];
    }

    if (request()->segment(2)) {
      $breadcrumbs[] = [
        '@type' => 'ListItem',
        'position' => 3,
        'name' => ucfirst(request()->segment(2)),
        'item' => url(request()->segment(1) . '/' . request()->segment(2))
      ];
    }
  @endphp

  @if(count($breadcrumbs) > 1)
    <script type="application/ld+json">
      {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumbs
      ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
  @endif

  <!-- Favicon -->
  @if(!empty($seo->favicon))
    <link rel="icon" href="{{ asset('storage/' . $seo->favicon) }}">
  @else
    <link rel="icon" href="{{ asset('favicon.ico') }}">
  @endif

  <link href="{{ secure_asset('land/style.css') }}" rel="stylesheet">

  <!-- Extra Head Scripts -->
  @stack('head_scripts')
</head>

<body
  x-data="{ page: {{ json_encode($page) }}, darkMode: true, stickyMenu: false, navigationOpen: false, scrollTop: false }"
  x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))"
  :class="{ 'b eh': darkMode }">
