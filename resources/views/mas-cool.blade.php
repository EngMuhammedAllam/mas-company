@php
    use App\Support\HomeMedia;

    /** Safe fallbacks so the page still renders if the CMS tables are empty. */
    $sections   = $sections   ?? collect();
    $items      = $items      ?? collect();
    $categories = $categories ?? collect();
    $products   = $products   ?? collect();
    $seoSetting = $seoSetting ?? null;

    $section = fn (string $key) => $sections->get($key);
    /** repeater rows for a given item type */
    $placed  = fn (string $type) => $items->get($type, collect());

    $heroProofs   = $placed('hero_proof');
    $trustItems   = $placed('trust_item');
    $advicePoints = $placed('advice_point');
    $processSteps = $placed('process_step');
    $faqs         = $placed('faq_item');

    $heroS     = $section('hero');
    $catS      = $section('categories');
    $equipS    = $section('equipment');
    $visitS    = $section('visit');
    $adviceS   = $section('advice');
    $processS  = $section('process');
    $faqS      = $section('faq');
    $contactS  = $section('contact');
    $footerS   = $section('footer');
    $generalS  = $section('general');
    $benefitsS = $section('hero_benefits');
    $trustS    = $section('trust');

    /** preview mode renders the real page but neutralises outbound WhatsApp links */
    $isPreview = request()->boolean('preview');

    $contactSetting = $contactSetting ?? null;
    $whatsappSource = $contactSetting?->whatsapp_number ?: $contactSetting?->phone;
    $whatsappNumber = $whatsappNumber ?? preg_replace('/\D+/', '', (string) $whatsappSource);
    $whatsappUrl = $whatsappNumber !== '' ? 'https://wa.me/'.$whatsappNumber : '#contact';

    /** wa.me link carrying a prefilled message. */
    $wa = function (?string $message) use ($whatsappNumber) {
        if ($whatsappNumber === '') {
            return '#contact';
        }
        return 'https://wa.me/'.$whatsappNumber.($message ? '?text='.rawurlencode($message) : '');
    };

    $metaDescription = $seoSetting?->meta_description
        ?: 'mas Cool لمعدات التبريد الصناعي. معدات مستوردة ومعاينة قبل الشراء.';
    $metaTitle = $seoSetting?->meta_title ?: 'mas Cool | معدات التبريد الصناعي';
    $heroImage = HomeMedia::url($heroS?->image, '/mas-cool-assets/hero-compressor.png');
    $visitImage = HomeMedia::url($visitS?->image, '/mas-cool-assets/fan-closeup.png');
    $adviceImage = HomeMedia::url($adviceS?->image, '/mas-cool-assets/fan-closeup.png');
@endphp
<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="theme-color" content="#062b39">
    <title>{{ $metaTitle }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="{{ $heroImage }}" fetchpriority="high">
    <style>
        /* ============================================================
           1. DESIGN TOKENS
           ============================================================ */
        :root{
            /* brand */
            --navy:#062b39;--navy-deep:#031d27;--navy-mid:#0a3d4e;
            --ink:#082d3b;--muted:#5c737e;--muted-soft:#7e939d;
            --lime:#d4f83f;--lime-deep:#7c941a;--lime-soft:#f1ffc4;
            --ice:#f1f6f8;--paper:#f8fbfb;--line:#dce7eb;--line-soft:#e8eff2;
            /* photo backdrop baked into the product PNGs — media wells match it exactly */
            --media-bg:#ecf5fc;
            /* elevation — restrained */
            --shadow-sm:0 2px 8px rgba(5,43,57,.04);
            --shadow:0 10px 30px rgba(5,43,57,.07);
            --shadow-lg:0 22px 54px rgba(3,29,39,.16);
            /* radii — three steps only */
            --r-sm:8px;--r-md:14px;--r-lg:20px;--r-pill:999px;
            /* layout */
            --container:1300px;--gutter:clamp(18px,3.2vw,44px);
            --header-h:80px;
            /* vertical rhythm */
            --sec-y:clamp(54px,6vw,88px);
            --sec-y-compact:clamp(40px,4.4vw,60px);
            /* type scale */
            --fs-h1:clamp(36px,4.3vw,54px);
            --fs-h2:clamp(28px,3vw,40px);
            --fs-h3:clamp(19px,1.5vw,23px);
            --fs-body:clamp(15px,1vw,16px);
            /* controls */
            --btn-h:50px;--btn-h-sm:40px;
            /* per-shape product zoom, set by media modifier classes */
            --zoom:1;
        }

        /* ============================================================
           2. BASE
           ============================================================ */
        *{box-sizing:border-box}
        html{scroll-behavior:smooth;-webkit-text-size-adjust:100%}
        html,body{max-width:100%;overflow-x:clip}
        body{margin:0;background:var(--paper);color:var(--ink);font-family:"Cairo",Tahoma,Arial,sans-serif;font-size:var(--fs-body);line-height:1.8}
        button,input,select,textarea{font:inherit}
        button,a{color:inherit}a{text-decoration:none}button{cursor:pointer}
        img{display:block;max-width:100%}
        h1,h2,h3,p{margin:0}
        :focus-visible{outline:3px solid #10819e;outline-offset:3px;border-radius:4px}
        /* every anchored section clears the sticky header */
        [id]{scroll-margin-top:calc(var(--header-h) + 18px)}
        .container{width:min(var(--container),100% - var(--gutter) * 2);margin-inline:auto}
        .section{padding:var(--sec-y) 0}
        .section--compact{padding:var(--sec-y-compact) 0}
        .skip-link{position:fixed;z-index:200;top:-80px;right:20px;background:var(--lime);color:var(--navy);font-weight:700;padding:10px 18px;border-radius:var(--r-sm)}
        .skip-link:focus{top:12px}
        .hidden{display:none!important}
        .visually-hidden{position:absolute;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap;border:0}

        /* editorial heading block — eyebrow sits tight above the title */
        .eyebrow-label{display:flex;align-items:center;gap:9px;font-size:11.5px;font-weight:800;letter-spacing:.08em;color:var(--lime-deep);line-height:1.6}
        .eyebrow-label:before{content:"";width:18px;height:2px;background:currentColor;flex:none}
        .section-title{font-size:var(--fs-h2);line-height:1.3;letter-spacing:-1px;margin-top:8px;text-wrap:balance}
        .section-desc{font-size:15px;line-height:1.8;color:var(--muted);max-width:52ch;margin-top:7px}
        .section-head{display:flex;align-items:flex-end;justify-content:space-between;gap:28px;margin-bottom:28px}
        .section-head__text{max-width:62ch}

        /* buttons */
        .btn{min-height:var(--btn-h);padding:10px 22px;border-radius:var(--r-sm);border:1px solid transparent;display:inline-flex;align-items:center;justify-content:center;gap:12px;font-weight:700;font-size:14px;line-height:1.4;transition:background .2s ease,border-color .2s ease,color .2s ease,box-shadow .2s ease}
        .btn .arrow{font-size:17px;line-height:1;transition:transform .2s ease}
        .btn:hover .arrow{transform:translateX(-3px)}
        .btn--lime{background:var(--lime);color:var(--navy);font-weight:800}
        .btn--lime:hover{background:#c6ef28}
        .btn--dark{background:var(--navy);color:#fff}
        .btn--dark:hover{background:var(--navy-mid)}
        .btn--outline{background:transparent;border-color:#b3c5cc;color:inherit}
        .btn--outline:hover{border-color:var(--navy);background:rgba(255,255,255,.7)}
        .btn--ghost{background:transparent;border-color:transparent;color:var(--muted);font-weight:700}
        .btn--ghost:hover{color:var(--navy);background:var(--ice)}
        .btn--sm{min-height:var(--btn-h-sm);padding:7px 14px;font-size:13px}
        .icon{width:24px;height:24px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}

        .scroll-progress{position:fixed;top:0;right:0;left:0;height:2px;z-index:120;pointer-events:none}
        .scroll-progress span{display:block;width:0;height:100%;background:var(--lime)}

        /* ============================================================
           3. HEADER — three zones inside the page container
           ============================================================ */
        .header{position:sticky;top:0;z-index:60;height:var(--header-h);display:flex;align-items:center;background:rgba(248,251,251,.92);backdrop-filter:blur(16px);border-bottom:1px solid transparent;transition:border-color .2s ease,box-shadow .2s ease}
        .header.is-stuck{border-bottom-color:var(--line);box-shadow:0 2px 14px rgba(5,43,57,.05)}
        .header__inner{display:grid;grid-template-columns:minmax(220px,1fr) auto minmax(220px,1fr);align-items:center;gap:24px;width:min(var(--container),100% - var(--gutter) * 2);margin-inline:auto}
        .brand{display:flex;align-items:center;gap:10px;grid-column:1;justify-self:right}
        .brand__mark{width:38px;height:38px;padding:7px;border-radius:10px;color:var(--lime);background:var(--navy);flex:none}
        .brand__word{font-family:Arial,sans-serif;font-size:23px;line-height:1.1;font-weight:800;letter-spacing:-1.1px;direction:ltr}
        .brand__tag{font-size:10px;line-height:1.4;color:var(--muted-soft)}
        /* nav: quiet by default, a thin lime rule marks the active section */
        .nav{display:flex;grid-column:2;align-items:center;justify-content:center;gap:4px;font-size:14px;font-weight:700;justify-self:center}
        .nav a{position:relative;padding:9px 14px;border-radius:var(--r-sm);color:#44616d;white-space:nowrap;transition:color .2s ease,background .2s ease}
        .nav a:after{content:"";position:absolute;right:14px;left:14px;bottom:3px;height:2px;border-radius:2px;background:var(--lime);transform:scaleX(0);transition:transform .2s ease}
        .nav a:hover{color:var(--navy);background:var(--ice)}
        .nav a.active{color:var(--navy)}
        .nav a.active:after{transform:scaleX(1)}
        .header__cta{grid-column:3;justify-self:left;min-height:42px;padding:8px 18px;font-size:13px}
        .menu-toggle{display:none;width:42px;height:42px;border:1px solid var(--line);border-radius:var(--r-sm);background:#fff;color:var(--navy);font-size:19px}
        .nav__head,.nav__cta,.nav-scrim{display:none}

        @media(min-width:1024px){
            .menu-toggle,.nav__head,.nav__cta,.nav-scrim{display:none}
        }

        /* ============================================================
           4. HERO — copy and equipment share one dark field
           ============================================================ */
        .hero{position:relative;color:#fff;background:linear-gradient(135deg,#04222e 0%,#073a4a 58%,#052a37 100%);overflow:hidden}
        /* blueprint grid, fading away from the headline */
        .hero:before{content:"";position:absolute;inset:0;opacity:.1;background-image:linear-gradient(rgba(255,255,255,.18) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.18) 1px,transparent 1px);background-size:58px 58px;mask-image:radial-gradient(ellipse 70% 90% at 30% 50%,#000,transparent)}
        .hero__grid{position:relative;z-index:1;display:grid;grid-template-columns:1.02fr 1fr;align-items:center;gap:clamp(24px,3.4vw,52px);padding:clamp(40px,4.6vw,60px) 0 clamp(34px,4vw,48px)}
        .hero__copy{max-width:36em}
        .eyebrow{display:inline-flex;align-items:center;gap:9px;font-size:11.5px;font-weight:800;letter-spacing:.07em;color:var(--lime);line-height:1.6}
        .eyebrow:before{content:"";width:18px;height:2px;background:currentColor;flex:none}
        .hero h1{font-size:var(--fs-h1);line-height:1.2;letter-spacing:-1.8px;margin:14px 0 12px;text-wrap:balance}
        .hero h1 span{display:block;color:var(--lime)}
        .hero__lead{max-width:44ch;color:#c5d5dc;font-size:16px;line-height:1.85;margin-bottom:24px}
        .hero__actions{display:flex;flex-wrap:wrap;gap:10px}
        .hero__actions .btn--lime{min-width:188px}
        .hero__actions .btn--outline{color:#dfe9ec;border-color:rgba(255,255,255,.26);background:transparent}
        .hero__actions .btn--outline:hover{border-color:rgba(255,255,255,.6);background:rgba(255,255,255,.07)}
        .hero__proof{display:flex;flex-wrap:wrap;align-items:center;gap:8px 22px;margin-top:24px;padding-top:18px;border-top:1px solid rgba(255,255,255,.12)}
        .hero__proof-item{display:flex;align-items:center;gap:7px;color:#b9cbd2;font-size:12.5px}
        .hero__proof-item i{width:15px;height:15px;display:grid;place-items:center;border-radius:50%;background:rgba(212,248,63,.16);color:var(--lime);font-style:normal;font-weight:800;font-size:9px;flex:none}
        /* the photo already carries a dark navy backdrop — feather it into the hero instead of framing it */
        .hero__visual{position:relative;aspect-ratio:16/11;max-height:430px;justify-self:stretch;background:var(--hero-image) 34% center/cover no-repeat;mask-image:radial-gradient(ellipse 78% 86% at 42% 50%,#000 58%,transparent 100%)}
        .hero__frame{position:absolute;inset:6% 16% 6% 4%;border:1px solid rgba(212,248,63,.2);border-radius:var(--r-md);pointer-events:none}
        .hero__frame:before,.hero__frame:after{content:"";position:absolute;width:12px;height:12px;border:2px solid var(--lime);opacity:.65}
        .hero__frame:before{top:-1px;right:-1px;border-left:0;border-bottom:0;border-radius:0 3px 0 0}
        .hero__frame:after{bottom:-1px;left:-1px;border-right:0;border-top:0;border-radius:0 0 0 3px}
        .hero__tag{position:absolute;right:6%;top:9%;z-index:2;background:var(--lime);color:var(--navy);padding:6px 12px;border-radius:var(--r-sm);font-size:11.5px;font-weight:800}
        .hero__badge{position:absolute;right:6%;bottom:9%;z-index:2;display:inline-flex;align-items:center;gap:8px;border:1px solid rgba(255,255,255,.18);border-radius:var(--r-sm);padding:8px 13px;font-size:12px;font-weight:700;background:rgba(3,29,39,.72)}
        .hero__badge i{width:7px;height:7px;border-radius:50%;background:var(--lime);flex:none}
        /* trust row lives inside the hero field — no floating white slab */
        .hero__trust{position:relative;z-index:1;border-top:1px solid rgba(255,255,255,.1)}
        .hero__trust-grid{display:grid;grid-template-columns:repeat(3,1fr)}
        .trust__item{display:flex;align-items:center;gap:13px;padding:18px 26px;min-height:0}
        .trust__item+.trust__item{border-right:1px solid rgba(255,255,255,.1)}
        .trust__item .icon{width:22px;height:22px;color:var(--lime);flex:none}
        .trust__item strong{display:block;font-size:14px;line-height:1.6;color:#fff}
        .trust__item p{font-size:12px;line-height:1.6;color:#9fb5bd}

        /* ============================================================
           5. PRODUCT MEDIA — one well, per-shape zoom
           The PNGs ship with an opaque pale backdrop, so the well is
           painted the same colour and the photo bleeds edge to edge.
           Zoom equalises perceived product size across shapes.
           ============================================================ */
        /* max-height caps the well so a 2-column tablet grid cannot inflate the artwork */
        .media{position:relative;display:block;aspect-ratio:16/10;max-height:250px;border-radius:var(--r-md);background:var(--media-bg);overflow:hidden}
        .media img{width:100%;height:100%;object-fit:contain;transform:scale(var(--zoom));transition:transform .35s ease}
        .media--sq{--zoom:1.24}      /* compressors: product fills only ~70% of its canvas */
        .media--wide{--zoom:1.04}    /* coils, condensers, condensing units */
        .media--xwide{--zoom:1}      /* four-fan coil: already spans its canvas */

        /* ============================================================
           6. CATEGORIES
           ============================================================ */
        .categories{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;counter-reset:category}
        .category-card{position:relative;display:flex;flex-direction:column;gap:0;border:1px solid var(--line-soft);background:#fff;border-radius:var(--r-lg);padding:8px;text-align:right;transition:border-color .2s ease,transform .2s ease,box-shadow .2s ease}
        .category-card:before{content:counter(category,decimal-leading-zero);counter-increment:category;position:absolute;top:18px;right:18px;z-index:2;color:var(--navy);opacity:.4;font:800 11px/1.6 Arial,sans-serif}
        .category-card:hover{border-color:#b9ccd4;transform:translateY(-3px);box-shadow:var(--shadow)}
        .category-card:hover .media img{transform:scale(calc(var(--zoom) * 1.02))}
        .category-card__body{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-top:auto;padding:13px 8px 5px}
        .cat-title{display:block;font-size:18px;line-height:1.5;font-weight:700}
        .cat-sub{display:block;font-size:12.5px;line-height:1.6;color:var(--muted)}
        .round-arrow{width:32px;height:32px;flex:none;border-radius:50%;border:1px solid var(--line);display:grid;place-items:center;font-size:15px;color:var(--navy);transition:background .2s ease,border-color .2s ease,transform .2s ease}
        .category-card:hover .round-arrow{background:var(--lime);border-color:var(--lime);transform:translateX(-2px)}

        /* ============================================================
           7. EQUIPMENT
           ============================================================ */
        .equipment{padding-block:64px;background:linear-gradient(180deg,#eaf2f4 0%,var(--paper) 62%)}
        .equipment__panel{margin-bottom:24px;padding:28px 30px 0;border:1px solid var(--line);border-radius:var(--r-lg);background:rgba(255,255,255,.72);box-shadow:var(--shadow-sm)}
        .equipment .section-head{align-items:center;margin-bottom:22px}
        .equipment .section-head .btn{flex:none;background:var(--navy);border-color:var(--navy);color:#fff}
        .equipment .section-head .btn:hover{background:var(--navy-mid);border-color:var(--navy-mid)}
        .equipment__toolbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin:0;padding:12px 0 14px;border-top:1px solid var(--line)}
        .filters{display:flex;align-items:center;gap:2px;min-width:0;overflow-x:auto;scrollbar-width:none}
        .filters::-webkit-scrollbar{display:none}
        .filter{flex:none;min-height:36px;padding:6px 14px;border:0;border-radius:var(--r-sm);background:transparent;font-size:13px;font-weight:700;color:var(--muted);white-space:nowrap;transition:background .2s ease,color .2s ease}
        .filter:hover{background:#e4eef1;color:var(--navy)}
        .filter[aria-pressed="true"]{background:var(--navy);color:#fff}
        .results{flex:none;font-size:12.5px;color:var(--muted)}

        .products{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}
        .product{position:relative;display:flex;flex-direction:column;border:1px solid var(--line-soft);border-radius:var(--r-lg);padding:8px;background:#fff;transition:border-color .2s ease,transform .2s ease,box-shadow .2s ease}
        .product:hover{border-color:#b9ccd4;transform:translateY(-3px);box-shadow:var(--shadow)}
        .product:hover .media img{transform:scale(calc(var(--zoom) * 1.02))}
        .product__flag{position:absolute;top:18px;right:18px;z-index:2;display:inline-flex;align-items:center;gap:6px;color:var(--navy);font-size:10.5px;font-weight:700;line-height:1.7}
        .product__flag:before{content:"";width:6px;height:6px;border-radius:50%;background:var(--lime-deep)}
        .product__body{display:flex;flex-direction:column;flex:1;padding:14px 8px 4px}
        .product__kicker{font-size:11.5px;line-height:1.6;color:var(--muted-soft);font-weight:700;letter-spacing:.03em}
        .product h3{font-size:var(--fs-h3);line-height:1.45;margin-top:1px}
        .product__desc{font-size:13.5px;line-height:1.7;color:var(--muted);margin:5px 0 14px;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
        .product__actions{margin-top:auto;display:flex;align-items:center;gap:6px}
        .product__actions .btn--dark{flex:1}
        .product__actions .btn--ghost{flex:none;padding:7px 10px;font-size:12.5px;border:1px solid var(--line)}
        .products-more{display:flex;justify-content:center;margin-top:26px}

        /* ============================================================
           8. VISIT BANNER — one composition, gradient blend
           ============================================================ */
        .visit{position:relative;color:#fff;background:var(--navy-deep);overflow:hidden}
        .visit__media{position:absolute;inset:0;background:var(--visit-image) 20% 42%/cover no-repeat}
        /* copy side stays fully dark, photo fades in across the middle */
        .visit__media:after{content:"";position:absolute;inset:0;background:linear-gradient(270deg,var(--navy-deep) 0%,var(--navy-deep) 40%,rgba(3,29,39,.82) 58%,rgba(3,29,39,.3) 84%,rgba(3,29,39,.18) 100%)}
        .visit__inner{position:relative;z-index:1;display:grid;grid-template-columns:58% 42%;padding:clamp(40px,4.4vw,56px) 0}
        .visit__copy h2{font-size:var(--fs-h2);line-height:1.3;letter-spacing:-1px;max-width:18ch}
        .visit__copy h2 span{color:var(--lime)}
        .visit__copy p{color:#b8c9d0;font-size:15px;margin:10px 0 20px;max-width:46ch}
        .visit__note{display:inline-flex;align-items:center;gap:8px;margin-top:16px;color:#9fb5bd;font-size:12.5px}
        .visit__note i{width:6px;height:6px;border-radius:50%;background:var(--lime);flex:none}

        /* ============================================================
           9. WHY MAS COOL
           ============================================================ */
        .advice{background:var(--paper)}
        .advice__grid{display:grid;grid-template-columns:45fr 55fr;align-items:center;gap:clamp(28px,4vw,60px)}
        .advice__figure{position:relative;margin:0}
        .advice__image{aspect-ratio:4/3.1;border-radius:var(--r-lg);background:var(--advice-image) 34% center/cover no-repeat}
        /* badge sits on the frame edge rather than pasted in the middle of the photo */
        .advice__caption{position:absolute;right:0;bottom:0;display:inline-flex;align-items:center;gap:8px;background:var(--lime);color:var(--navy);padding:10px 16px;border-radius:var(--r-md) 0 var(--r-lg) 0;font-weight:800;font-size:12px}
        .advice h2 span{color:var(--lime-deep)}
        .advice__lead{font-size:15px;line-height:1.8;color:var(--muted);margin:10px 0 22px;max-width:50ch}
        /* numbered benefit list on a single technical rule */
        .advice-list{display:grid;gap:0;border-right:2px solid var(--line);padding-right:0}
        .advice-point{position:relative;display:grid;grid-template-columns:auto 1fr;align-items:baseline;gap:14px;padding:14px 22px 14px 0}
        .advice-point:before{content:"";position:absolute;right:-2px;top:14px;bottom:14px;width:2px;background:transparent;transition:background .2s ease}
        .advice-point:hover:before{background:var(--lime)}
        .advice-point__num{font:800 12px/1.6 Arial,sans-serif;color:var(--lime-deep);letter-spacing:.06em}
        .advice-point h3{font-size:16.5px;line-height:1.5}
        .advice-point p{font-size:13.5px;line-height:1.7;color:var(--muted);margin-top:2px}

        /* ============================================================
           10. PROCESS — RTL flow 01 → 02 → 03, right to left
           ============================================================ */
        .process{overflow:hidden;background:linear-gradient(180deg,#fff 0%,#f1f6f8 100%)}
        .process__head{max-width:720px;margin-inline:auto;text-align:center}
        .process__head .eyebrow-label{justify-content:center}
        .process__head .section-desc{margin-inline:auto}
        .steps{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:42px}
        .steps:before{display:none}
        .step{position:relative;min-height:168px;border:1px solid var(--line);border-radius:var(--r-lg);background:rgba(255,255,255,.9);padding:30px 24px 24px;text-align:right;box-shadow:var(--shadow-sm);transition:border-color .2s ease,transform .2s ease,box-shadow .2s ease}
        .step:hover{transform:translateY(-3px);box-shadow:var(--shadow);border-color:#b9ccd4}
        .step:not(:last-child):after{content:"←";position:absolute;z-index:2;left:-29px;top:calc(50% - 16px);width:32px;height:32px;border:1px solid var(--line);border-radius:50%;display:grid;place-items:center;background:var(--paper);color:var(--lime-deep);font-size:15px;font-weight:800}
        .step__number{position:absolute;z-index:1;top:-18px;right:24px;width:38px;height:38px;border-radius:50%;background:var(--navy);border:3px solid var(--paper);display:grid;place-items:center;margin:0;font-weight:800;font-size:11px;color:#fff;box-shadow:0 0 0 1px var(--line)}
        .step__body{display:grid;grid-template-columns:52px 1fr;grid-template-rows:auto auto;align-items:center;gap:2px 15px}
        .step__icon{grid-column:1;grid-row:1/3;width:52px;height:52px;border-radius:var(--r-md);background:var(--ice);display:grid;place-items:center;margin:0;color:var(--navy)}
        .step h3{grid-column:2;font-size:18px;line-height:1.5}
        .step p{grid-column:2;font-size:13.5px;line-height:1.7;color:var(--muted);max-width:32ch;margin:2px 0 0}
        .step--final{border-color:var(--navy);background:var(--navy);color:#fff}
        .step--final .step__number{background:var(--lime);border-color:var(--paper);color:var(--navy);box-shadow:0 0 0 1px var(--lime)}
        .step--final .step__icon{background:var(--lime);color:var(--navy)}
        .step--final p{color:#c5d5dc}

        /* ============================================================
           11. FAQ
           ============================================================ */
        .faq{background:var(--ice)}
        .faq__grid{display:grid;grid-template-columns:34fr 66fr;gap:clamp(26px,3.6vw,56px);align-items:start}
        .faq__intro h2{font-size:var(--fs-h2);line-height:1.3;letter-spacing:-1px;margin-top:8px}
        .faq__intro p{font-size:14px;line-height:1.75;color:var(--muted);margin-top:12px;max-width:34ch}
        .faq__list{display:grid;gap:8px}
        .faq details{background:#fff;border:1px solid var(--line-soft);border-right:2px solid var(--line-soft);border-radius:var(--r-md);padding:0 18px;transition:border-color .2s ease}
        .faq details:hover{border-color:#c3d3d9}
        /* only the open item carries the accent */
        .faq details[open]{border-right-color:var(--lime)}
        .faq summary{cursor:pointer;list-style:none;display:flex;align-items:center;justify-content:space-between;gap:16px;font-size:14.5px;font-weight:700;line-height:1.6;padding:15px 0}
        .faq summary::-webkit-details-marker{display:none}
        .faq summary:after{content:"+";width:24px;height:24px;flex:none;border-radius:50%;background:var(--ice);display:grid;place-items:center;font-size:16px;font-weight:400;line-height:1;transition:background .2s ease,color .2s ease}
        .faq details[open] summary:after{content:"−";background:var(--navy);color:#fff}
        .faq__answer{overflow:hidden}
        .faq details p{font-size:13.5px;line-height:1.8;color:var(--muted);max-width:68ch;padding:0 0 15px}
        @keyframes faq-open{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:none}}
        .faq details[open] .faq__answer{animation:faq-open .22s ease}

        /* ============================================================
           12. CONTACT
           ============================================================ */
        .contact{position:relative;color:#fff;background:linear-gradient(135deg,#04222e 0%,#073a4a 62%,#052a37 100%);overflow:hidden}
        .contact:before{content:"";position:absolute;inset:0;opacity:.08;background-image:linear-gradient(rgba(255,255,255,.18) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.18) 1px,transparent 1px);background-size:58px 58px;mask-image:radial-gradient(ellipse 60% 90% at 78% 50%,#000,transparent)}
        .contact__grid{position:relative;display:grid;grid-template-columns:38fr 62fr;gap:clamp(26px,3.6vw,56px);align-items:center}
        .contact__copy h2{font-size:var(--fs-h2);line-height:1.25;letter-spacing:-1.2px;margin-top:10px;max-width:14ch}
        .contact__copy h2 span{color:var(--lime)}
        .contact__copy p{font-size:15px;color:#b8c9d0;margin-top:10px;max-width:38ch}
        .form{background:#fff;color:var(--ink);padding:clamp(20px,2.2vw,28px);border-radius:var(--r-lg)}
        .form__grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .field label{display:block;font-size:12.5px;font-weight:700;margin-bottom:6px}
        .field input,.field select,.field textarea{width:100%;min-height:46px;border:1px solid #d3e0e5;border-radius:var(--r-sm);background:#fff;padding:10px 13px;color:var(--ink);font-size:14px;outline:0;transition:border-color .2s ease,box-shadow .2s ease}
        .field input::placeholder,.field textarea::placeholder{color:#9aaeb6}
        .field input:focus,.field select:focus,.field textarea:focus{border-color:var(--lime-deep);box-shadow:0 0 0 3px rgba(212,248,63,.3)}
        .field input:user-invalid,.field select:user-invalid,.field textarea:user-invalid{border-color:#c0392b;box-shadow:0 0 0 3px rgba(192,57,43,.1)}
        .field textarea{height:88px;resize:vertical}
        .field--full{grid-column:1/-1}
        .form .btn{width:100%;margin-top:14px}
        .form__note{font-size:11px;line-height:1.7;color:var(--muted);text-align:center;margin-top:9px}

        /* persistent WhatsApp contact entry point */
        .whatsapp-float{position:fixed;z-index:70;right:20px;bottom:max(20px,env(safe-area-inset-bottom));width:52px;height:52px;border:3px solid #fff;border-radius:50%;display:grid;place-items:center;background:#25d366;color:#fff;box-shadow:0 8px 24px rgba(3,29,39,.24);transition:transform .2s ease,background-color .2s ease,box-shadow .2s ease}
        .whatsapp-float:hover{transform:translateY(-3px) scale(1.03);background:#20bd5a;box-shadow:0 12px 30px rgba(3,29,39,.3)}
        .whatsapp-float:focus-visible{outline:3px solid rgba(37,211,102,.35);outline-offset:3px}
        .whatsapp-float svg{display:block;width:27px;height:27px;fill:currentColor}
        .whatsapp-float__label{position:absolute;right:calc(100% + 11px);width:max-content;max-width:190px;padding:7px 11px;border-radius:var(--r-sm);background:var(--navy);color:#fff;font-size:11.5px;font-weight:700;opacity:0;visibility:hidden;transform:translateX(6px);transition:opacity .2s ease,transform .2s ease,visibility .2s ease}
        .whatsapp-float:hover .whatsapp-float__label,.whatsapp-float:focus-visible .whatsapp-float__label{opacity:1;visibility:visible;transform:none}

        /* ============================================================
           13. FOOTER
           ============================================================ */
        .footer{background:var(--navy-deep);color:#fff;padding:clamp(34px,3.4vw,46px) 0 18px;border-top:1px solid rgba(255,255,255,.07)}
        .footer__grid{display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:clamp(22px,3vw,44px)}
        .footer .brand__mark{background:rgba(255,255,255,.07);color:#fff}
        .footer .brand__tag{color:#8ca3ac}
        .footer__title{font-size:13px;line-height:1.6;margin-bottom:8px;color:#fff}
        .footer__links a{display:block;width:max-content;color:#a9bfc7;font-size:13px;line-height:1.6;margin:5px 0;transition:color .2s ease}
        .footer__links a:hover{color:var(--lime)}
        .footer__bottom{border-top:1px solid rgba(255,255,255,.08);margin-top:26px;padding-top:14px;display:flex;flex-wrap:wrap;gap:10px;justify-content:space-between;color:#8ca3ac;font-size:12px}

        /* ============================================================
           14. DIALOG
           ============================================================ */
        .dialog{width:min(540px,calc(100% - 32px));border:0;border-radius:var(--r-lg);padding:26px;color:var(--ink);box-shadow:var(--shadow-lg)}
        .dialog::backdrop{background:rgba(2,22,31,.78)}
        .dialog h2{font-size:21px;line-height:1.5}
        .dialog p{color:var(--muted);font-size:13.5px}
        .dialog textarea{width:100%;height:160px;margin:14px 0;border:1px solid var(--line);border-radius:var(--r-sm);padding:13px;resize:vertical}
        .dialog__actions{display:flex;flex-wrap:wrap;gap:9px}
        .status{font-size:12.5px;margin-top:8px;min-height:20px}

        /* ============================================================
           15. RESPONSIVE
           ============================================================ */
        @media(max-width:1180px){
            .nav a{padding:9px 11px}
            .visit__inner{grid-template-columns:62% 38%}
        }
        @media(max-width:1024px){
            .products{grid-template-columns:repeat(2,1fr)}
            /* four categories read better as 2x2 than as a 3+1 orphan row */
            .categories{grid-template-columns:repeat(2,1fr)}
            .hero__grid{gap:28px}
            .media{max-height:224px}
        }
        @media(max-width:1023px){
            :root{--header-h:68px}
            .header{border-bottom:1px solid var(--line);backdrop-filter:none;background:#f8fbfb}
            .header.is-stuck{box-shadow:0 1px 10px rgba(5,43,57,.07)}
            .header__inner{display:flex;justify-content:space-between}
            .brand{grid-column:auto;justify-self:auto}
            .header__cta{display:none}
            .menu-toggle{display:grid;place-items:center;border-color:#cbd9de}

            /* navigation becomes an off-canvas drawer below the single header breakpoint */
            .nav{position:fixed;inset:0 0 0 auto;z-index:90;display:flex;visibility:hidden;opacity:0;width:min(84vw,320px);grid-column:auto;justify-self:auto;flex-direction:column;align-items:stretch;justify-content:flex-start;overflow-y:auto;gap:2px;padding:18px var(--gutter) 22px;background:#fff;border:0;box-shadow:-18px 0 44px rgba(3,29,39,.22);transform:translateX(100%);transition:transform .26s ease,opacity .26s ease}
            .nav.open{visibility:visible;opacity:1;transform:none}
            .nav a{padding:14px 12px;text-align:right;font-size:15px;border-bottom:1px solid var(--line-soft)}
            .nav a:after{display:none}
            .nav a.active{background:var(--ice);border-radius:var(--r-sm);border-bottom-color:transparent;box-shadow:inset 3px 0 0 var(--lime)}
            .nav__head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:10px}
            .nav__title{font-size:12px;font-weight:800;letter-spacing:.06em;color:var(--muted)}
            .nav__close{width:44px;height:44px;display:grid;place-items:center;border:1px solid var(--line);border-radius:var(--r-sm);background:#fff;font-size:20px;color:var(--navy)}
            .nav a.nav__cta{display:inline-flex;margin-top:16px;width:100%;color:#fff;border-bottom-color:transparent}
            .nav a.nav__cta:hover{background:var(--navy-mid);color:#fff}
            .nav-scrim{position:fixed;inset:0;z-index:80;display:block;background:rgba(3,29,39,.5);opacity:0;visibility:hidden;transition:opacity .26s ease}
            .nav-scrim[hidden]{display:none}
            .nav-scrim.open{opacity:1;visibility:visible}
            body.nav-locked{overflow:hidden}
            body.nav-locked .header{z-index:95}
        }
        @media(max-width:900px){
            .hero__grid{grid-template-columns:1fr;padding-bottom:32px}
            .hero__copy{max-width:none}
            .hero__visual{grid-row:2;aspect-ratio:16/9;max-height:320px}
            .trust__item{padding:14px 16px}
            .section-head{flex-direction:column;align-items:flex-start;gap:16px}
            .visit__inner{grid-template-columns:1fr}
            .visit__media{background-position:60% 42%}
            .visit__media:after{background:linear-gradient(0deg,rgba(3,29,39,.55) 0%,rgba(3,29,39,.88) 55%,var(--navy-deep) 100%)}
            .advice__grid,.contact__grid,.faq__grid{grid-template-columns:1fr}
            /* text before image converts better on mobile */
            .advice__figure{grid-row:2}
            .advice__image{aspect-ratio:16/9}
            .footer__grid{grid-template-columns:1fr 1fr}
            .footer__brand{grid-column:1/-1}
        }

        /* ============================================================
           16. MOBILE — a layout of its own, not a stacked desktop
           ============================================================ */
        /* no grid or flex child may push the page sideways */
        .hero__grid>*,.categories>*,.products>*,.steps>*,.footer__grid>*,
        .advice__grid>*,.contact__grid>*,.faq__grid>*,.visit__inner>*,
        .product__body>*,.category-card__body>*,.trust__item>*{min-width:0}
        .product h3,.cat-title,.step h3,.faq summary,.section-title,.hero h1{overflow-wrap:break-word}

        /* touch targets reach 44px where the pointer is a finger */
        @media(pointer:coarse),(max-width:680px){
            :root{--btn-h:50px;--btn-h-sm:44px}
            .filter{min-height:44px}
            .menu-toggle{width:46px;height:46px}
            .round-arrow{width:40px;height:40px}
            .faq summary{min-height:62px}
        }

        @media(max-width:680px){
            :root{--gutter:20px;--sec-y:clamp(48px,11vw,60px);--sec-y-compact:clamp(36px,9vw,46px);--fs-h1:clamp(38px,11vw,46px);--fs-h2:clamp(29px,8vw,35px);--fs-h3:clamp(22px,6.2vw,26px);--fs-body:16px}

            .brand__mark{width:36px;height:36px}
            .brand__word{font-size:21px}

            /* ---- hero: compact mobile composition ---- */
            .hero{border-radius:0}
            .hero__grid{padding:14px 0 12px;gap:12px}
            .eyebrow{font-size:10.5px;gap:7px}
            .hero h1{max-width:12ch;margin:7px 0 7px;font-size:clamp(34px,10vw,40px);letter-spacing:-1px;line-height:1.12}
            .hero__lead{font-size:14.5px;line-height:1.65;margin-bottom:12px;max-width:40ch}
            .hero__actions{display:grid;grid-template-columns:minmax(0,1.15fr) minmax(0,.85fr);gap:8px}
            .hero__actions .btn{width:auto;min-width:0;min-height:46px;padding-inline:10px;font-size:13px}
            .hero__actions .btn--outline{font-weight:700;border-color:rgba(255,255,255,.2)}
            .hero__proof{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:6px;margin-top:10px;padding-top:10px}
            .hero__proof-item{justify-content:center;gap:4px;font-size:10.5px;line-height:1.45;text-align:center}
            .hero__proof-item i{width:14px;height:14px}
            .hero__visual{aspect-ratio:auto;height:clamp(176px,46vw,215px);max-height:none;border-radius:var(--r-md);mask-image:none;background-size:contain;background-position:center;background-color:#04222e}
            .hero__frame{inset:6px}
            .hero__tag{right:10px;top:10px;padding:5px 9px;font-size:10.5px}
            .hero__badge{right:10px;bottom:10px;max-width:calc(100% - 20px);padding:6px 9px;font-size:10.5px}
            .hero__trust{background:rgba(3,29,39,.16)}
            .hero__trust-grid{grid-template-columns:repeat(3,minmax(0,1fr))}
            .trust__item{display:grid;grid-template-columns:18px 1fr;gap:6px;padding:10px 7px;align-items:center;text-align:right}
            .trust__item+.trust__item{border-right:1px solid rgba(255,255,255,.1);border-top:0}
            .trust__item .icon{width:18px;height:18px}
            .trust__item strong{font-size:11px;line-height:1.45}
            .trust__item p{display:none}

            /* ---- categories: 2x2, compact ---- */
            .section-head{margin-bottom:20px;gap:12px}
            .section-desc{font-size:14.5px;margin-top:6px}
            .categories-section{padding-block:42px}
            .categories-section .section-head{align-items:stretch;margin-bottom:18px;text-align:center}
            .categories-section .section-head__text{max-width:none}
            .categories-section .eyebrow-label{justify-content:center}
            .categories-section .section-title{max-width:15ch;margin-inline:auto;font-size:clamp(30px,8.5vw,34px);line-height:1.25;letter-spacing:-.8px}
            .categories-section .section-desc{max-width:32ch;margin-inline:auto}
            .categories{grid-template-columns:1fr 1fr;gap:12px}
            .category-card{padding:6px;border-radius:16px}
            .category-card:before{top:13px;right:13px;font-size:10px}
            .category-card .media{aspect-ratio:4/3;max-height:138px}
            .category-card__body{padding:10px 6px 4px;gap:8px}
            .cat-title{font-size:17px;line-height:1.4}
            .cat-sub{font-size:11.5px;line-height:1.45}
            .round-arrow{width:32px;height:32px;font-size:14px}

            /* ---- products ---- */
            .products{grid-template-columns:1fr;gap:14px}
            .equipment{padding-block:42px}
            .equipment__panel{margin-bottom:14px;padding:18px 14px 12px;border-radius:16px}
            .equipment .section-head{align-items:stretch;margin-bottom:12px;gap:8px;text-align:center}
            .equipment .section-head__text{max-width:none}
            .equipment .section-head .eyebrow-label{justify-content:center}
            .equipment .section-head .section-title{max-width:12ch;margin-inline:auto;font-size:clamp(29px,8vw,32px);line-height:1.22;letter-spacing:-.7px}
            .equipment .section-head .section-desc{max-width:32ch;margin-inline:auto;font-size:13.5px;line-height:1.65}
            .equipment .section-head .btn{min-height:46px}
            .section-head .btn{width:100%}
            .equipment__toolbar{display:block;padding:10px 0 0}
            /* one compact row; it scrolls only on the narrowest phones */
            .filters-wrap{position:relative;overflow:hidden}
            .filters{display:flex;gap:4px;margin:0;padding:0;overflow-x:auto;scroll-snap-type:x proximity;-webkit-overflow-scrolling:touch}
            .filter{flex:0 0 auto;min-height:38px;padding:6px 8px;background:var(--ice);font-size:10.5px;line-height:1.4;white-space:nowrap;scroll-snap-align:start}
            .filters-wrap:after{display:none}
            .results{display:block;text-align:center;font-size:11px;margin-top:6px}
            .product{padding:6px;border-radius:18px;gap:0}
            .product .media{aspect-ratio:16/9;max-height:190px}
            .product .media--sq{--zoom:1.12}
            .product__flag{top:14px;right:14px;font-size:10px}
            .product__body{padding:12px 8px 4px}
            .product__desc{font-size:14px;margin:4px 0 12px}
            .product__actions{display:grid;grid-template-columns:1fr auto auto;gap:6px}
            .product__actions .btn--ghost{padding:7px 12px}
            .products-more{margin-top:18px}
            .products-more .btn{width:100%}

            /* ---- visit banner ---- */
            .visit__inner{padding:40px 0 38px}
            .visit__copy{display:flex;flex-direction:column;align-items:center;text-align:center}
            .visit__copy h2{max-width:14ch;margin-inline:auto}
            .visit__copy p{font-size:14.5px;margin:8px auto 18px;max-width:34ch}
            .visit__copy .btn{width:100%}
            .visit__note{justify-content:center;margin-top:14px;font-size:12px;text-align:center}

            /* ---- why mas cool ---- */
            .advice__lead{font-size:14.5px;margin:8px 0 16px}
            .advice-point{padding:11px 16px 11px 0;gap:11px}
            .advice-point h3{font-size:15.5px}
            .advice-point p{font-size:13px;line-height:1.6}
            .advice__figure{margin-top:22px}
            .advice__image{aspect-ratio:auto;height:clamp(250px,70vw,300px);background-position:38% center}
            .advice__caption{right:12px;bottom:12px;border-radius:var(--r-sm);padding:9px 14px;font-size:11.5px}

            /* ---- process: one continuous vertical timeline ---- */
            .process__head{text-align:right}
            .process__head .eyebrow-label{justify-content:flex-start}
            .process__head .section-desc{margin-inline:0}
            .steps{grid-template-columns:1fr;gap:0;margin-top:26px}
            .steps:before{content:"";display:block;top:19px;bottom:40px;right:19px;left:auto;width:2px;height:auto;background:var(--line-soft)}
            .step{display:grid;grid-template-columns:38px 1fr;column-gap:14px;align-items:start;min-height:0;border:0;border-radius:0;background:transparent;padding:0 0 22px;text-align:right;box-shadow:none}
            .step:hover{transform:none;box-shadow:none}
            .step:not(:last-child):after{display:none}
            .step:last-child{padding-bottom:0}
            .step__number{position:relative;top:auto;right:auto;width:38px;height:38px;margin:0;font-size:11px;background:#fff;border:2px solid var(--line);color:var(--navy);box-shadow:none}
            .step--final .step__number{border-color:var(--lime)}
            .step--final{color:var(--navy)}
            .step--final p{color:var(--muted)}
            .step__body{display:grid;grid-template-columns:auto 1fr;align-items:center;column-gap:10px;row-gap:2px;padding-top:4px}
            .step__icon{width:30px;height:30px;border-radius:9px;margin:0;grid-row:1}
            .step__icon .icon{width:17px;height:17px}
            .step h3{font-size:16.5px;grid-row:1}
            .step p{grid-column:1/-1;font-size:13.5px;line-height:1.6;max-width:none;margin:0;text-align:right}

            /* ---- faq ---- */
            .faq__intro p{font-size:13.5px;margin-top:8px;max-width:none}
            .faq__grid{gap:20px}
            .faq summary{font-size:14px;padding:12px 0;gap:12px}
            .faq summary:after{width:26px;height:26px}
            .faq details{padding:0 14px}
            .faq details p{font-size:13.5px;padding-bottom:14px}

            /* ---- contact ---- */
            .contact{padding-block:40px}
            .contact__grid{gap:14px}
            .contact__copy h2{max-width:16ch;margin-top:6px;font-size:clamp(30px,8.5vw,34px);line-height:1.2}
            .contact__copy p{font-size:14px;line-height:1.65;margin-top:6px;max-width:none}
            .form{padding:16px;border-radius:16px}
            .form__grid{grid-template-columns:1fr;gap:9px}
            .field label{margin-bottom:4px;font-size:12px}
            .field input,.field select,.field textarea{min-height:46px;padding-block:8px;font-size:15px}
            .field textarea{min-height:70px;height:70px}
            .form .btn{min-height:48px;margin-top:10px}
            .form__note{margin-top:6px;line-height:1.5}
            .whatsapp-float{right:14px;bottom:max(14px,env(safe-area-inset-bottom));width:48px;height:48px}
            .whatsapp-float svg{width:24px;height:24px}
            .whatsapp-float__label{display:none}
            /* native select arrow sits on the correct side for RTL */
            .field select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 7'%3E%3Cpath d='M1 1l5 5 5-5' fill='none' stroke='%235c737e' stroke-width='1.7' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");background-position:left 14px center;background-size:11px 7px;background-repeat:no-repeat;padding-left:36px}

            /* ---- footer ---- */
            .footer{padding:28px 0 16px}
            .footer__grid{grid-template-columns:1fr 1fr;gap:18px 16px}
            .footer__brand{grid-column:1/-1;padding-bottom:4px;border-bottom:1px solid rgba(255,255,255,.08)}
            .footer__start{grid-column:1/-1}
            .footer__title{font-size:12.5px;margin-bottom:4px}
            .footer__links a{font-size:13px;margin:3px 0}
            .footer__start .footer__links-row{display:flex;flex-wrap:wrap;gap:8px}
            .footer__bottom{margin-top:18px;padding-top:12px;font-size:11.5px;gap:6px}
        }

        @media(min-width:480px) and (max-width:680px){
            .contact .form__grid{grid-template-columns:1fr 1fr}
            .contact .field:nth-child(n+3){grid-column:1/-1}
        }

        /* narrow phones: the three actions no longer fit on one row */
        @media(max-width:375px){
            :root{--gutter:16px}
            .brand__tag{display:none}
            .product__actions{grid-template-columns:1fr 1fr}
            .product__actions .btn--dark{grid-column:1/-1}
            .cat-sub{display:none}
            .category-card .media{max-height:124px}
        }
        @media(prefers-reduced-motion:reduce){
            html{scroll-behavior:auto}
            *,*:before,*:after{transition:none!important;animation:none!important}
        }

        /* ---- editor preview mode only ---- */
        body.is-preview [data-section]{position:relative;transition:box-shadow .2s ease}
        body.is-preview [data-section].is-highlighted{box-shadow:inset 0 0 0 3px #d4f83f;border-radius:6px}
        body.is-preview [data-section]{cursor:pointer}
        body.is-preview .whatsapp-float{display:none}
    </style>
</head>
<body id="top" @class(['is-preview' => $isPreview]) style="--hero-image:url('{{ $heroImage }}');--visit-image:url('{{ $visitImage }}');--advice-image:url('{{ $adviceImage }}')">
<div class="scroll-progress" aria-hidden="true"><span></span></div>
<a class="skip-link" href="#main">تخطي إلى المحتوى</a>
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false"><defs>
    <symbol id="snow" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M24 3v42M6 13l36 22M6 35l36-22M19 7l5 5 5-5M19 41l5-5 5 5M8 19l7 2-2-7M40 29l-7-2 2 7M13 34l2-7-7 2M35 14l-2 7 7-2"/></g></symbol>
    <symbol id="globe" viewBox="0 0 48 48"><circle cx="24" cy="24" r="19"/><path d="M5 24h38M24 5c6 6 9 12 9 19s-3 13-9 19c-6-6-9-12-9-19s3-13 9-19z"/></symbol>
    <symbol id="warehouse" viewBox="0 0 48 48"><path d="M7 18 24 7l17 11v24H7zM14 24h20v18H14zM18 29h12M18 34h12"/></symbol>
    <symbol id="support" viewBox="0 0 48 48"><path d="M8 27v-5a16 16 0 0 1 32 0v5M8 27a5 5 0 0 0 5 5h3V22h-3a5 5 0 0 0-5 5ZM40 27a5 5 0 0 1-5 5h-3V22h3a5 5 0 0 1 5 5ZM35 32c0 6-4 9-11 9"/></symbol>
    <symbol id="check" viewBox="0 0 48 48"><circle cx="24" cy="24" r="18"/><path d="m15 24 6 6 13-14"/></symbol>
    <symbol id="calendar" viewBox="0 0 48 48"><rect x="8" y="12" width="32" height="29" rx="3"/><path d="M15 7v10M33 7v10M8 21h32M15 28h5M27 28h5M15 35h5M27 35h5"/></symbol>
    <symbol id="search" viewBox="0 0 48 48"><circle cx="21" cy="21" r="14"/><path d="m31 31 11 11"/></symbol>
    <symbol id="note" viewBox="0 0 48 48"><path d="M10 7h24l5 5v29H10zM34 7v7h7M16 21h16M16 27h16M16 33h10"/></symbol>
</defs></svg>

<div class="nav-scrim" hidden></div>
<header class="header"><div class="header__inner">
    <a class="brand" href="#top" aria-label="mas Cool الرئيسية"><svg class="brand__mark" aria-hidden="true"><use href="#snow"/></svg><div><div class="brand__word">mas Cool</div><div class="brand__tag">معدات التبريد الصناعي</div></div></a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="nav" aria-label="فتح القائمة">☰</button>
    <nav class="nav" id="nav" aria-label="القائمة الرئيسية" aria-hidden="false" tabindex="-1"><div class="nav__head"><span class="nav__title">القائمة</span><button class="nav__close" type="button" aria-label="إغلاق القائمة">×</button></div><a class="active" href="#top">الرئيسية</a><a href="#equipment">المعدات</a><a href="#about">لماذا mas Cool</a><a href="#contact">تواصل معنا</a><a class="btn btn--dark nav__cta" href="{{ $wa($footerS?->whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="mobile_cta" data-wa-action="quote" data-whatsapp-message="{{ $footerS?->whatsapp_message ?? 'مرحبًا mas Cool، أرغب في طلب عرض سعر.' }}">{{ $footerS?->setting('header_cta_text') ?? 'اطلب عرض سعر' }} <span class="arrow" aria-hidden="true">←</span></a></nav>
    <a class="btn btn--dark header__cta" href="{{ $wa($footerS?->whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="header_cta" data-wa-action="quote" data-whatsapp-message="{{ $footerS?->whatsapp_message ?? 'مرحبًا mas Cool، أرغب في طلب عرض سعر.' }}">{{ $footerS?->setting('header_cta_text') ?? 'اطلب عرض سعر' }} <span class="arrow" aria-hidden="true">←</span></a>
</div></header>

<main id="main">
<section class="hero" aria-labelledby="hero-title" data-section="hero">
    <div class="container hero__grid">
        <div class="hero__copy"><p class="eyebrow">{{ $heroS?->eyebrow }}</p><h1 id="hero-title">{{ $heroS?->title }}<span>{{ $heroS?->highlighted_text }}</span></h1><p class="hero__lead">{{ $heroS?->description }}</p><div class="hero__actions"><a class="btn btn--lime" href="{{ $heroS?->setting('primary_button_href', '#equipment') }}">{{ $heroS?->button_text }} <span class="arrow" aria-hidden="true">←</span></a><a class="btn btn--outline" href="{{ $wa($heroS?->secondary_whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="hero_booking" data-wa-action="booking" data-whatsapp-message="{{ $heroS?->secondary_whatsapp_message }}">{{ $heroS?->secondary_button_text }}</a></div>@if(($benefitsS?->is_active ?? true) && $heroProofs->isNotEmpty())<div class="hero__proof" aria-label="مزايا سريعة" data-section="hero_benefits">@foreach($heroProofs as $proof)<span class="hero__proof-item"><i aria-hidden="true">✓</i> {{ $proof->title }}</span>@endforeach</div>@endif</div>
        <div class="hero__visual" role="img" aria-label="{{ $heroS?->image_alt }}"><span class="hero__frame" aria-hidden="true"></span><span class="hero__tag">{{ $heroS?->setting('tag') }}</span><span class="hero__badge"><i aria-hidden="true"></i> {{ $heroS?->setting('badge') }}</span></div>
    </div>
    @if(($trustS?->is_active ?? true) && $trustItems->isNotEmpty())
    <div class="hero__trust" aria-label="مميزات الخدمة" data-section="trust"><div class="container hero__trust-grid">
        @foreach($trustItems as $trust)
        <div class="trust__item"><svg class="icon" aria-hidden="true"><use href="#{{ $trust->icon_key ?: 'check' }}"/></svg><div><strong>{{ $trust->title }}</strong><p>{{ $trust->description }}</p></div></div>
        @endforeach
    </div></div>
    @endif
</section>

@if($catS?->is_active ?? true)
<section class="section section--compact categories-section" aria-labelledby="categories-title" data-section="categories"><div class="container">
    <div class="section-head"><div class="section-head__text"><p class="eyebrow-label">{{ $catS?->eyebrow }}</p><h2 class="section-title" id="categories-title">{{ $catS?->title }}</h2><p class="section-desc">{{ $catS?->description }}</p></div></div>
    <div class="categories">
        @foreach($categories as $category)
        <button class="category-card" type="button" data-category="{{ $category->slug }}"><span class="media media--{{ $category->media_shape }}"><img src="{{ HomeMedia::url($category->image) }}" width="1672" height="941" loading="lazy" decoding="async" alt="{{ $category->image_alt ?: $category->name }}"></span><span class="category-card__body"><span class="cat-text"><span class="cat-title">{{ $category->name }}</span><span class="cat-sub">{{ $category->short_description }}</span></span><span class="round-arrow" aria-hidden="true">←</span></span></button>
        @endforeach
    </div>
</div></section>
@endif

@if($equipS?->is_active ?? true)
<section class="section equipment" id="equipment" aria-labelledby="equipment-title" data-section="equipment"><div class="container">
    <div class="equipment__panel">
        <div class="section-head"><div class="section-head__text"><p class="eyebrow-label">{{ $equipS?->eyebrow }}</p><h2 class="section-title" id="equipment-title">{{ $equipS?->title }}</h2><p class="section-desc">{{ $equipS?->description }}</p></div><a class="btn btn--outline" href="{{ $wa($equipS?->whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="equipment_help" data-wa-action="help" data-whatsapp-message="{{ $equipS?->whatsapp_message }}">{{ $equipS?->button_text }} <span class="arrow" aria-hidden="true">←</span></a></div>
        <div class="equipment__toolbar"><div class="filters-wrap"><div class="filters" role="group" aria-label="تصفية المعدات"><button class="filter" data-filter="all" aria-pressed="true">{{ $equipS?->setting('filter_all_label', 'الكل') }}</button>@foreach($categories as $category)<button class="filter" data-filter="{{ $category->slug }}" aria-pressed="false">{{ $category->name }}</button>@endforeach</div></div><span class="results" id="results" role="status"></span></div>
    </div>
    <div class="products">
        @foreach($products as $product)
        <article class="product" data-type="{{ $product->category?->slug }}">@if($product->is_available && $product->availability_label)<span class="product__flag">{{ $product->availability_label }}</span>@endif<div class="media media--{{ $product->mediaShapeClass() }}"><img src="{{ HomeMedia::url($product->image) }}" width="{{ $product->media_shape === 'xwide' ? 2159 : 1672 }}" height="{{ $product->media_shape === 'xwide' ? 728 : 941 }}" loading="lazy" decoding="async" alt="{{ $product->image_alt ?: $product->name }}"></div><div class="product__body"><span class="product__kicker">{{ $product->kicker }}</span><h3>{{ $product->name }}</h3><p class="product__desc">{{ $product->description }}</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="{{ $product->name }}" data-value="{{ $product->category?->slug }}" data-wa-source="product_price" data-wa-action="quote" data-product-id="{{ $product->id }}" data-whatsapp-message="{{ $product->whatsapp_price_message }}">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button" data-wa-source="product_details" data-wa-action="details" data-product-id="{{ $product->id }}" data-whatsapp-message="{{ $product->whatsapp_details_message }}">التفاصيل<span class="visually-hidden"> — {{ $product->name }}</span></button><button class="btn btn--ghost btn--sm" type="button" data-wa-source="product_specs" data-wa-action="specs" data-product-id="{{ $product->id }}" data-whatsapp-message="{{ $product->whatsapp_specs_message }}">المواصفات<span class="visually-hidden"> — {{ $product->name }}</span></button></div></div></article>
        @endforeach
    </div>
    <div class="products-more"><a class="btn btn--outline" href="{{ $wa($equipS?->secondary_whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="equipment_help" data-wa-action="help" data-whatsapp-message="{{ $equipS?->secondary_whatsapp_message }}">{{ $equipS?->secondary_button_text }}</a></div>
</div></section>
@endif

@if($visitS?->is_active ?? true)
<section class="visit" aria-labelledby="visit-title" data-section="visit">
    <div class="visit__media" role="img" aria-label="{{ $visitS?->image_alt }}"></div>
    <div class="container visit__inner"><div class="visit__copy"><h2 id="visit-title">{{ $visitS?->title }} <span>{{ $visitS?->highlighted_text }}</span></h2><p>{{ $visitS?->description }}</p><a class="btn btn--lime" href="{{ $wa($visitS?->whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="visit_booking" data-wa-action="booking" data-whatsapp-message="{{ $visitS?->whatsapp_message }}">{{ $visitS?->button_text }} <span class="arrow" aria-hidden="true">←</span></a><span class="visit__note"><i aria-hidden="true"></i> {{ $visitS?->setting('note') }}</span></div></div>
</section>
@endif

@if($adviceS?->is_active ?? true)
<section class="section advice" id="about" aria-labelledby="advice-title" data-section="advice"><div class="container advice__grid">
    <figure class="advice__figure"><div class="advice__image" role="img" aria-label="{{ $adviceS?->image_alt }}"></div><figcaption class="advice__caption">{{ $adviceS?->setting('caption') }}</figcaption></figure>
    <div><p class="eyebrow-label">{{ $adviceS?->eyebrow }}</p><h2 class="section-title" id="advice-title">{{ $adviceS?->title }} <span>{{ $adviceS?->highlighted_text }}</span></h2><p class="advice__lead">{{ $adviceS?->description }}</p>
    <div class="advice-list">
        @foreach($advicePoints as $point)
        <div class="advice-point"><span class="advice-point__num" aria-hidden="true">{{ $point->label ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div><h3>{{ $point->title }}</h3><p>{{ $point->description }}</p></div></div>
        @endforeach
    </div>
    </div>
</div></section>
@endif

@if($processS?->is_active ?? true)
<section class="section section--compact process" aria-labelledby="process-title" data-section="process"><div class="container"><div class="process__head"><p class="eyebrow-label">{{ $processS?->eyebrow }}</p><h2 class="section-title" id="process-title">{{ $processS?->title }}</h2><p class="section-desc">{{ $processS?->description }}</p></div><div class="steps">
    @foreach($processSteps as $step)
    <div class="step{{ $step->isFinal() ? ' step--final' : '' }}"><span class="step__number">{{ $step->label ?: str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span><div class="step__body"><span class="step__icon"><svg class="icon" aria-hidden="true"><use href="#{{ $step->icon_key ?: 'note' }}"/></svg></span><h3>{{ $step->title }}</h3><p>{{ $step->description }}</p></div></div>
    @endforeach
</div></div></section>
@endif

@if($faqS?->is_active ?? true)
<section class="section section--compact faq" aria-labelledby="faq-title" data-section="faq"><div class="container faq__grid"><div class="faq__intro"><p class="eyebrow-label">{{ $faqS?->eyebrow }}</p><h2 id="faq-title">{{ $faqS?->title }}</h2><p>{{ $faqS?->description }}</p></div><div class="faq__list">
    @foreach($faqs as $faq)
    <details @if($loop->first) open @endif><summary>{{ $faq->title }}</summary><div class="faq__answer"><p>{{ $faq->description }}</p></div></details>
    @endforeach
</div></div></section>
@endif

@if($contactS?->is_active ?? true)
<section class="section contact" id="contact" aria-labelledby="contact-title" data-section="contact"><div class="container contact__grid"><div class="contact__copy"><p class="eyebrow">{{ $contactS?->eyebrow }}</p><h2 id="contact-title">{{ $contactS?->title }} <span>{{ $contactS?->highlighted_text }}</span></h2><p>{{ $contactS?->description }}</p></div><form class="form" id="inquiry" novalidate><div class="form__grid">
    <div class="field"><label for="name">الاسم</label><input id="name" name="name" autocomplete="name" placeholder="الاسم بالكامل" required maxlength="100"></div>
    <div class="field"><label for="phone">رقم الهاتف</label><input id="phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="رقم الهاتف" required maxlength="25"></div>
    <div class="field"><label for="type">نوع المعدة</label><select id="type" name="type" required><option value="">اختر نوع المعدة</option>@foreach($categories as $category)<option value="{{ $category->slug }}">{{ $category->name }}</option>@endforeach<option value="other">{{ $contactS?->setting('other_option_label', 'أحتاج مساعدة في الاختيار') }}</option></select></div>
    <div class="field"><label for="message">تفاصيل الطلب</label><textarea id="message" name="message" placeholder="اكتب تفاصيل احتياجك هنا..." required maxlength="1500"></textarea></div>
    </div><button class="btn btn--lime" type="submit">{{ $contactS?->button_text }} <span class="arrow" aria-hidden="true">◁</span></button><p class="form__note">{{ $contactS?->setting('form_note') }}</p></form>
</div></section>
@endif
</main>

<footer class="footer" data-section="footer"><div class="container"><div class="footer__grid"><div class="footer__brand"><a class="brand" href="#top"><svg class="brand__mark" aria-hidden="true"><use href="#snow"/></svg><div><div class="brand__word">mas Cool</div><div class="brand__tag">معدات التبريد الصناعي</div></div></a></div><div class="footer__links"><h3 class="footer__title">{{ $footerS?->setting('quick_links_title', 'روابط سريعة') }}</h3><a href="#top">الرئيسية</a><a href="#equipment">المعدات</a><a href="#about">لماذا mas Cool</a><a href="#contact">تواصل معنا</a></div><div class="footer__links"><h3 class="footer__title">{{ $footerS?->setting('equipment_title', 'المعدات') }}</h3>@foreach($footerS?->setting('equipment_links') ?? $categories->pluck('name')->all() as $link)<a href="#equipment">{{ $link }}</a>@endforeach</div><div class="footer__links footer__start"><h3 class="footer__title">{{ $footerS?->setting('start_title', 'ابدأ معنا') }}</h3><div class="footer__links-row"><a href="{{ $wa($footerS?->whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="footer_quote" data-wa-action="quote" data-whatsapp-message="{{ $footerS?->whatsapp_message }}">{{ $footerS?->button_text }}</a><a href="{{ $wa($footerS?->secondary_whatsapp_message) }}" target="_blank" rel="noopener noreferrer" data-wa-source="footer_quote" data-wa-action="booking" data-whatsapp-message="{{ $footerS?->secondary_whatsapp_message }}">{{ $footerS?->secondary_button_text }}</a></div></div></div><div class="footer__bottom"><span>© <span id="year"></span> {{ $footerS?->setting('copyright', 'mas Cool — جميع الحقوق محفوظة.') }}</span><a href="#top">العودة للأعلى ↑</a></div></div></footer>

@if($whatsappNumber !== '')
<a class="whatsapp-float" href="{{ $wa($footerS?->setting('floating_message')) }}" target="_blank" rel="noopener noreferrer" data-wa-source="floating_button" data-wa-action="contact" data-whatsapp-message="{{ $footerS?->setting('floating_message', 'مرحبًا mas Cool، أريد الاستفسار عن معدات التبريد.') }}" aria-label="تواصل معنا عبر واتساب">
    <span class="whatsapp-float__label">تواصل معنا عبر واتساب</span>
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.297.3-.495.099-.198.05-.372-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.009-.371-.011-.57-.011-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479s1.065 2.875 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.227 1.36.195 1.871.118.57-.085 1.758-.719 2.006-1.413.248-.694.248-1.29.173-1.414-.074-.123-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.99c-.002 5.45-4.437 9.884-9.889 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
</a>
@endif

<script>
'use strict';
/* ---- mobile navigation drawer ---- */
const menuButton=document.querySelector('.menu-toggle');
const nav=document.querySelector('#nav');
const navScrim=document.querySelector('.nav-scrim');
const navClose=document.querySelector('.nav__close');
const desktopHeader=matchMedia('(min-width:1024px)');
const focusablesIn=el=>[...el.querySelectorAll('a[href],button:not([disabled])')].filter(n=>n.getClientRects().length>0);
let navOpen=false;
function setNav(open,{restoreFocus=true,clearStyles=false}={}){
    open=Boolean(open)&&!desktopHeader.matches;
    const wasOpen=navOpen;
    navOpen=open;
    nav.classList.toggle('open',open);
    navScrim.classList.toggle('open',open);
    navScrim.hidden=!open;
    document.body.classList.toggle('nav-locked',open);
    menuButton.setAttribute('aria-expanded',String(open));
    nav.setAttribute('aria-hidden',String(!desktopHeader.matches&&!open));
    nav.toggleAttribute('inert',!desktopHeader.matches&&!open);
    navScrim.setAttribute('aria-hidden',String(!open));
    if(clearStyles){
        nav.removeAttribute('style');
        navScrim.removeAttribute('style');
        document.body.style.removeProperty('overflow');
        if(!document.body.style.length)document.body.removeAttribute('style');
    }
    /* focus the panel; retry on a timer rather than rAF, which never fires in a hidden tab */
    if(open){
        const moveFocus=()=>{const f=focusablesIn(nav);(f[0]||nav).focus({preventScroll:true});};
        moveFocus();
        if(!nav.contains(document.activeElement))setTimeout(moveFocus,0);
    }
    else if(wasOpen){
        if(desktopHeader.matches&&nav.contains(document.activeElement)){
            (nav.querySelector('a.active')||nav.querySelector('a[href]'))?.focus({preventScroll:true});
        }
        else if(restoreFocus&&!desktopHeader.matches){menuButton.focus({preventScroll:true});}
    }
}
menuButton.addEventListener('click',()=>setNav(!navOpen));
navClose.addEventListener('click',()=>setNav(false));
navScrim.addEventListener('click',()=>setNav(false));
nav.addEventListener('click',e=>{if(e.target.closest('a'))setNav(false,{restoreFocus:false});});
addEventListener('keydown',e=>{
    if(!navOpen)return;
    if(e.key==='Escape'){e.preventDefault();setNav(false);return;}
    if(e.key!=='Tab')return;
    const f=focusablesIn(nav);if(!f.length)return;
    const first=f[0],last=f[f.length-1];
    if(e.shiftKey&&document.activeElement===first){e.preventDefault();last.focus();}
    else if(!e.shiftKey&&document.activeElement===last){e.preventDefault();first.focus();}
});
/* the drawer is a mobile affordance — close it if the viewport grows past the breakpoint */
function syncHeaderViewport(){setNav(false,{restoreFocus:false,clearStyles:desktopHeader.matches});}
desktopHeader.addEventListener('change',syncHeaderViewport);
syncHeaderViewport();

/* ---- filter scroller: show a fade while more tabs remain past the edge ---- */
const filtersEl=document.querySelector('.filters');
const filtersWrap=document.querySelector('.filters-wrap');
function updateFilterCue(){
    const more=filtersEl.scrollWidth-filtersEl.clientWidth-Math.abs(filtersEl.scrollLeft)>2;
    filtersWrap.classList.toggle('has-more',more);
}
filtersEl.addEventListener('scroll',updateFilterCue,{passive:true});
addEventListener('resize',updateFilterCue,{passive:true});
addEventListener('load',updateFilterCue);
if('ResizeObserver' in window)new ResizeObserver(updateFilterCue).observe(filtersEl);
updateFilterCue();
const filters=[...document.querySelectorAll('[data-filter]')];
const products=[...document.querySelectorAll('.product')];
const result=document.querySelector('#results');
function applyFilter(type='all'){let count=0;products.forEach(card=>{const show=type==='all'||card.dataset.type===type;card.classList.toggle('hidden',!show);if(show)count++;});filters.forEach(btn=>btn.setAttribute('aria-pressed',String(btn.dataset.filter===type)));result.textContent=`عرض ${count} من ${products.length} معدات`;
const active=filters.find(b=>b.dataset.filter===type);
if(active&&filtersEl.scrollWidth>filtersEl.clientWidth)active.scrollIntoView({block:'nearest',inline:'nearest'});
updateFilterCue();}
filters.forEach(btn=>btn.addEventListener('click',()=>applyFilter(btn.dataset.filter)));
document.querySelectorAll('[data-category]').forEach(btn=>btn.addEventListener('click',()=>{applyFilter(btn.dataset.category);document.querySelector('#equipment').scrollIntoView({block:'start'});}));
const whatsappNumber=@json($whatsappNumber);
const waTrackUrl=@json(route('whatsapp.track'));
const waToken=document.querySelector('meta[name="csrf-token"]')?.content||'';
/* Fire-and-forget analytics. Never delays or blocks the WhatsApp hand-off. */
function trackWhatsApp(source,action,productId){
    if(!source||!waTrackUrl)return;
    const payload=JSON.stringify({source:source,action_type:action||null,equipment_product_id:productId?Number(productId):null});
    try{
        const blob=new Blob([payload],{type:'application/json'});
        if(navigator.sendBeacon&&navigator.sendBeacon(waTrackUrl+'?_token='+encodeURIComponent(waToken),blob))return;
        fetch(waTrackUrl,{method:'POST',keepalive:true,headers:{'Content-Type':'application/json','X-CSRF-TOKEN':waToken},body:payload}).catch(()=>{});
    }catch(_){/* analytics must never break the CTA */}
}
function openWhatsApp(message){
    if(!whatsappNumber){
        alert('رقم واتساب غير مُعدّ حاليًا. يرجى إضافته من لوحة التحكم.');
        return;
    }
    const url=`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
    const whatsappWindow=window.open(url,'_blank');
    if(whatsappWindow)whatsappWindow.opener=null;
    else window.location.href=url;
}
document.addEventListener('click',e=>{
    const trigger=e.target.closest('[data-whatsapp-message]');
    if(!trigger)return;
    e.preventDefault();
    /* the message is authored in the dashboard; never rebuilt here */
    const message=trigger.dataset.whatsappMessage||'مرحبًا mas Cool، أريد الاستفسار عن معدات التبريد.';
    trackWhatsApp(trigger.dataset.waSource,trigger.dataset.waAction,trigger.dataset.productId);
    openWhatsApp(message);
});
document.querySelector('#inquiry').addEventListener('submit',e=>{
    e.preventDefault();
    const form=e.currentTarget;
    if(!form.checkValidity()){form.reportValidity();return;}
    const data=new FormData(form);
    const select=document.querySelector('#type');
    trackWhatsApp('inquiry_form','inquiry',null);
    openWhatsApp([
        'مرحبًا mas Cool، أرغب في الاستفسار عن معدة.',
        `الاسم: ${data.get('name')}`,
        `الهاتف: ${data.get('phone')}`,
        `نوع المعدة: ${select.options[select.selectedIndex].text}`,
        `التفاصيل: ${data.get('message')}`
    ].join('\n'));
});
document.querySelector('#year').textContent=new Date().getFullYear();

@if($isPreview)
/* ---------- editor preview bridge ---------- */
(function(){
    const ORIGIN=@json(config('app.url'));
    const allowed=[location.origin, ORIGIN].filter(Boolean);
    /* WhatsApp must never actually open while previewing inside the dashboard */
    document.addEventListener('click',e=>{
        const wa=e.target.closest('[data-whatsapp-message],a[href^="https://wa.me"]');
        if(wa){e.preventDefault();e.stopImmediatePropagation();}
        const sec=e.target.closest('[data-section]');
        if(sec&&parent!==window){
            e.preventDefault();
            parent.postMessage({source:'mascool-preview',action:'select',section:sec.dataset.section},allowed[0]);
        }
    },true);
    function highlight(key){
        document.querySelectorAll('[data-section]').forEach(el=>el.classList.toggle('is-highlighted',el.dataset.section===key));
        const target=document.querySelector('[data-section="'+CSS.escape(key)+'"]');
        if(target)target.scrollIntoView({block:'start',behavior:'smooth'});
    }
    addEventListener('message',e=>{
        if(!allowed.includes(e.origin))return;                 // validate origin
        const d=e.data;
        if(!d||d.source!=='mascool-editor')return;
        if(d.action==='highlight')highlight(d.section);
    });
    if(parent!==window)parent.postMessage({source:'mascool-preview',action:'ready'},allowed[0]);
})();
@endif
const header=document.querySelector('.header');
const progressBar=document.querySelector('.scroll-progress span');
let scrollTick=false;
function updateScrollUI(){const max=document.documentElement.scrollHeight-innerHeight;progressBar.style.width=`${max>0?(scrollY/max)*100:0}%`;header.classList.toggle('is-stuck',scrollY>8);scrollTick=false;}
addEventListener('scroll',()=>{if(!scrollTick){requestAnimationFrame(updateScrollUI);scrollTick=true;}},{passive:true});
updateScrollUI();
const pageSections=[...document.querySelectorAll('main section[id]')];
const navLinks=[...document.querySelectorAll('.nav a')];
if('IntersectionObserver' in window){
    const sectionObserver=new IntersectionObserver(entries=>entries.forEach(entry=>{if(entry.isIntersecting){navLinks.forEach(link=>link.classList.toggle('active',link.hash===`#${entry.target.id}`));}}),{rootMargin:'-35% 0px -55%'});
    pageSections.forEach(section=>sectionObserver.observe(section));
}
document.querySelectorAll('.faq details').forEach(item=>item.addEventListener('toggle',()=>{if(item.open){document.querySelectorAll('.faq details[open]').forEach(openItem=>{if(openItem!==item)openItem.removeAttribute('open');});}}));
applyFilter();
</script>
</body>
</html>
