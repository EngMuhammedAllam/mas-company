<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="mas Cool لمعدات التبريد الصناعي. معدات مستوردة ومعاينة قبل الشراء.">
    <meta name="theme-color" content="#062b39">
    <title>mas Cool | معدات التبريد الصناعي</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="/mas-cool-assets/hero-compressor.png" fetchpriority="high">
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
        .brand{display:flex;align-items:center;gap:10px;grid-column:1;justify-self:end}
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
        .header__cta{grid-column:3;justify-self:start;min-height:42px;padding:8px 18px;font-size:13px}
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
        .hero__visual{position:relative;aspect-ratio:16/11;max-height:430px;justify-self:stretch;background:url('/mas-cool-assets/hero-compressor.png') 34% center/cover no-repeat;mask-image:radial-gradient(ellipse 78% 86% at 42% 50%,#000 58%,transparent 100%)}
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
        .equipment{background:linear-gradient(180deg,#eaf2f4 0%,var(--paper) 62%)}
        .equipment__toolbar{display:flex;align-items:center;justify-content:space-between;gap:16px;margin-bottom:20px;padding-bottom:10px;border-bottom:1px solid var(--line)}
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
        .visit__media{position:absolute;inset:0;background:url('/mas-cool-assets/fan-closeup.png') 20% 42%/cover no-repeat}
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
        .advice__image{aspect-ratio:4/3.1;border-radius:var(--r-lg);background:url('/mas-cool-assets/fan-closeup.png') 34% center/cover no-repeat}
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
        .process{background:#fff}
        .process__head{max-width:600px}
        .steps{position:relative;display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-top:46px}
        /* connector aligns with the centre of the number nodes */
        .steps:before{content:"";position:absolute;top:0;right:16.6%;left:16.6%;height:1px;background:repeating-linear-gradient(90deg,var(--line) 0 6px,transparent 6px 12px)}
        .step{position:relative;border:1px solid var(--line-soft);border-radius:var(--r-lg);background:#fff;padding:0 22px 22px;text-align:center;transition:border-color .2s ease,transform .2s ease,box-shadow .2s ease}
        .step:hover{transform:translateY(-3px);box-shadow:var(--shadow);border-color:#b9ccd4}
        .step__number{width:42px;height:42px;border-radius:50%;background:#fff;border:1px solid var(--line);display:grid;place-items:center;margin:-21px auto 14px;font-weight:800;font-size:12px;color:var(--muted);position:relative;z-index:1;transition:background .2s ease,border-color .2s ease,color .2s ease}
        /* the closing step is the conversion moment — it carries the accent */
        .step--final .step__number{background:var(--lime);border-color:var(--lime);color:var(--navy)}
        .step--final{border-color:#cfe08f}
        .step__icon{width:46px;height:46px;border-radius:var(--r-md);background:var(--ice);display:grid;place-items:center;margin:0 auto 10px;color:var(--navy)}
        .step h3{font-size:17px;line-height:1.5}
        .step p{font-size:13.5px;line-height:1.7;color:var(--muted);max-width:30ch;margin:4px auto 0}

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

            /* ---- hero: tighter, image closer to the copy ---- */
            .hero{border-radius:0}
            .hero__grid{padding:22px 0 18px;gap:16px}
            .hero h1{margin:10px 0 10px;letter-spacing:-1.2px;line-height:1.16}
            .hero__lead{font-size:15.5px;line-height:1.7;margin-bottom:18px;max-width:38ch}
            .hero__actions{gap:8px}
            .hero__actions .btn{width:100%}
            .hero__actions .btn--outline{min-height:46px;font-weight:700;border-color:rgba(255,255,255,.2)}
            /* three proofs as a compact two-row grid instead of a loose wrap */
            .hero__proof{display:grid;grid-template-columns:1fr 1fr;gap:6px 12px;margin-top:12px;padding-top:11px}
            .hero__proof-item{font-size:12px}
            .hero__visual{aspect-ratio:auto;height:clamp(214px,57vw,262px);max-height:none;border-radius:var(--r-md);mask-image:none;background-size:contain;background-position:center;background-color:#04222e}
            .hero__frame{inset:8px}
            .hero__tag{right:12px;top:12px}
            .hero__badge{right:12px;bottom:12px;max-width:calc(100% - 24px)}
            .hero__trust-grid{grid-template-columns:1fr}
            .trust__item{padding:9px 0;gap:10px;align-items:center}
            .trust__item+.trust__item{border-right:0;border-top:1px solid rgba(255,255,255,.1)}
            .trust__item .icon{width:18px;height:18px}
            .trust__item strong{font-size:13px;line-height:1.5}
            .trust__item p{font-size:11px;line-height:1.5}

            /* ---- categories: 2x2, compact ---- */
            .section-head{margin-bottom:20px;gap:12px}
            .section-desc{font-size:14.5px;margin-top:6px}
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
            .section-head .btn{width:100%}
            .equipment__toolbar{flex-direction:column;align-items:stretch;gap:6px;padding-bottom:8px}
            /* real RTL scroller: bleeds to the screen edge, nothing clipped at rest */
            .filters{position:relative;margin-inline:calc(var(--gutter) * -1);padding-inline:var(--gutter);scroll-padding-inline:var(--gutter);scroll-snap-type:x proximity;-webkit-overflow-scrolling:touch}
            /* tighter tabs so the whole set fits without clipping at 390px and up */
            .filter{flex:0 0 auto;scroll-snap-align:start;padding:6px 10px;font-size:12.5px}
            .filters-wrap{position:relative}
            /* fade cue showing the row continues past the left edge */
            .filters-wrap:after{content:"";position:absolute;top:0;bottom:0;left:calc(var(--gutter) * -1);width:28px;pointer-events:none;background:linear-gradient(270deg,rgba(242,247,248,0),#eef5f6);opacity:0;transition:opacity .2s ease}
            .filters-wrap.has-more:after{opacity:1}
            .results{text-align:right;font-size:12px}
            .product{padding:6px;border-radius:18px;gap:0}
            .product .media{aspect-ratio:16/10;max-height:232px}
            .product__flag{top:14px;right:14px;font-size:10px}
            .product__body{padding:12px 8px 4px}
            .product__desc{font-size:14px;margin:4px 0 12px}
            .product__actions{display:grid;grid-template-columns:1fr auto auto;gap:6px}
            .product__actions .btn--ghost{padding:7px 12px}
            .products-more{margin-top:18px}
            .products-more .btn{width:100%}

            /* ---- visit banner ---- */
            .visit__inner{padding:40px 0 38px}
            .visit__copy h2{max-width:14ch}
            .visit__copy p{font-size:14.5px;margin:8px 0 18px;max-width:34ch}
            .visit__copy .btn{width:100%}
            .visit__note{margin-top:14px;font-size:12px}

            /* ---- why mas cool ---- */
            .advice__lead{font-size:14.5px;margin:8px 0 16px}
            .advice-point{padding:11px 16px 11px 0;gap:11px}
            .advice-point h3{font-size:15.5px}
            .advice-point p{font-size:13px;line-height:1.6}
            .advice__figure{margin-top:22px}
            .advice__image{aspect-ratio:auto;height:clamp(250px,70vw,300px);background-position:38% center}
            .advice__caption{right:12px;bottom:12px;border-radius:var(--r-sm);padding:9px 14px;font-size:11.5px}

            /* ---- process: one continuous vertical timeline ---- */
            .steps{grid-template-columns:1fr;gap:0;margin-top:26px}
            .steps:before{content:"";top:19px;bottom:40px;right:19px;left:auto;width:2px;height:auto;background:var(--line-soft)}
            .step{display:grid;grid-template-columns:38px 1fr;column-gap:14px;align-items:start;border:0;border-radius:0;background:transparent;padding:0 0 22px;text-align:right;box-shadow:none}
            .step:hover{transform:none;box-shadow:none}
            .step:last-child{padding-bottom:0}
            .step__number{width:38px;height:38px;margin:0;font-size:11px;background:#fff;border:2px solid var(--line)}
            .step--final .step__number{border-color:var(--lime)}
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
            .contact__grid{gap:20px}
            .contact__copy h2{max-width:16ch}
            .contact__copy p{font-size:14.5px;max-width:none}
            .form{padding:20px;border-radius:18px}
            .form__grid{grid-template-columns:1fr;gap:12px}
            .field input,.field select,.field textarea{min-height:50px;font-size:16px}
            .field textarea{min-height:84px;height:84px}
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
    </style>
</head>
<body id="top">
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
    <nav class="nav" id="nav" aria-label="القائمة الرئيسية" aria-hidden="false" tabindex="-1"><div class="nav__head"><span class="nav__title">القائمة</span><button class="nav__close" type="button" aria-label="إغلاق القائمة">×</button></div><a class="active" href="#top">الرئيسية</a><a href="#equipment">المعدات</a><a href="#about">لماذا mas Cool</a><a href="#contact">تواصل معنا</a><a class="btn btn--dark nav__cta" href="#contact">اطلب عرض سعر <span class="arrow" aria-hidden="true">←</span></a></nav>
    <a class="btn btn--dark header__cta" href="#contact">اطلب عرض سعر <span class="arrow" aria-hidden="true">←</span></a>
</div></header>

<main id="main">
<section class="hero" aria-labelledby="hero-title">
    <div class="container hero__grid">
        <div class="hero__copy"><p class="eyebrow">mas Cool · معدات التبريد الصناعي</p><h1 id="hero-title">قوة التبريد.<span>ثقة الاختيار.</span></h1><p class="hero__lead">معدات تبريد مستوردة، تعاينها وتختبرها قبل الشراء. اختر المعدة المناسبة وراجع تفاصيلها قبل القرار.</p><div class="hero__actions"><a class="btn btn--lime" href="#equipment">استكشف المعدات <span class="arrow" aria-hidden="true">←</span></a><a class="btn btn--outline" href="#contact">احجز معاينة</a></div><div class="hero__proof" aria-label="مزايا سريعة"><span class="hero__proof-item"><i aria-hidden="true">✓</i> فحص قبل الشراء</span><span class="hero__proof-item"><i aria-hidden="true">✓</i> اختيارات متعددة</span><span class="hero__proof-item"><i aria-hidden="true">✓</i> دعم فني متخصص</span></div></div>
        <div class="hero__visual" role="img" aria-label="كباس تبريد صناعي أخضر على خلفية رسم هندسي"><span class="hero__frame" aria-hidden="true"></span><span class="hero__tag">جاهز للمعاينة</span><span class="hero__badge"><i aria-hidden="true"></i> معاينة واختبار قبل الشراء</span></div>
    </div>
    <div class="hero__trust" aria-label="مميزات الخدمة"><div class="container hero__trust-grid">
        <div class="trust__item"><svg class="icon" aria-hidden="true"><use href="#globe"/></svg><div><strong>معدات مستوردة</strong><p>من أفضل العلامات العالمية</p></div></div>
        <div class="trust__item"><svg class="icon" aria-hidden="true"><use href="#warehouse"/></svg><div><strong>معاينة بالمخزن</strong><p>تعاين وتختبر قبل الشراء</p></div></div>
        <div class="trust__item"><svg class="icon" aria-hidden="true"><use href="#support"/></svg><div><strong>مساعدة في الاختيار</strong><p>فريق متخصص يساعدك</p></div></div>
    </div></div>
</section>

<section class="section section--compact" aria-labelledby="categories-title"><div class="container">
    <div class="section-head"><div class="section-head__text"><p class="eyebrow-label">01 / تصفح حسب النوع</p><h2 class="section-title" id="categories-title">كل ما يحتاجه نظام التبريد</h2><p class="section-desc">مجموعة متكاملة من معدات التبريد الصناعي بمواصفات عالمية.</p></div></div>
    <div class="categories">
        <button class="category-card" type="button" data-category="compressors"><span class="media media--sq"><img src="/mas-cool-assets/compressor-green.png" width="1672" height="941" loading="lazy" decoding="async" alt="كباس تبريد نصف مغلق باللون الأخضر"></span><span class="category-card__body"><span class="cat-text"><span class="cat-title">كباسات</span><span class="cat-sub">كباسات نصف مغلقة</span></span><span class="round-arrow" aria-hidden="true">←</span></span></button>
        <button class="category-card" type="button" data-category="coils"><span class="media media--wide"><img src="/mas-cool-assets/coil-white.png" width="1672" height="941" loading="lazy" decoding="async" alt="كويل تبريد أبيض بمروحتين"></span><span class="category-card__body"><span class="cat-text"><span class="cat-title">كويلات</span><span class="cat-sub">كويلات تبريد وتجميد</span></span><span class="round-arrow" aria-hidden="true">←</span></span></button>
        <button class="category-card" type="button" data-category="units"><span class="media media--wide"><img src="/mas-cool-assets/condensing-unit-green.png" width="1672" height="941" loading="lazy" decoding="async" alt="وحدة تكثيف خضراء متكاملة"></span><span class="category-card__body"><span class="cat-text"><span class="cat-title">وحدات تبريد</span><span class="cat-sub">وحدات متكاملة وجاهزة</span></span><span class="round-arrow" aria-hidden="true">←</span></span></button>
        <button class="category-card" type="button" data-category="condensers"><span class="media media--wide"><img src="/mas-cool-assets/condenser-blue.png" width="1672" height="941" loading="lazy" decoding="async" alt="كوندنسر هواء أزرق بمروحتين"></span><span class="category-card__body"><span class="cat-text"><span class="cat-title">كوندنسرات</span><span class="cat-sub">مكثفات هواء عالية الكفاءة</span></span><span class="round-arrow" aria-hidden="true">←</span></span></button>
    </div>
</div></section>

<section class="section equipment" id="equipment" aria-labelledby="equipment-title"><div class="container">
    <div class="section-head"><div class="section-head__text"><p class="eyebrow-label">02 / معدات مختارة</p><h2 class="section-title" id="equipment-title">معدات تستحق نظرة أقرب</h2><p class="section-desc">معدات مختارة بعناية من أفضل العلامات، راجع مواصفاتها قبل الزيارة.</p></div><a class="btn btn--outline" href="#contact">اسأل عن معدة محددة <span class="arrow" aria-hidden="true">←</span></a></div>
    <div class="equipment__toolbar"><div class="filters-wrap"><div class="filters" role="group" aria-label="تصفية المعدات"><button class="filter" data-filter="all" aria-pressed="true">الكل</button><button class="filter" data-filter="compressors" aria-pressed="false">كباسات</button><button class="filter" data-filter="coils" aria-pressed="false">كويلات</button><button class="filter" data-filter="units" aria-pressed="false">وحدات تبريد</button><button class="filter" data-filter="condensers" aria-pressed="false">كوندنسرات</button></div></div><span class="results" id="results" role="status"></span></div>
    <div class="products">
        <article class="product" data-type="condensers"><span class="product__flag">متاح للمعاينة</span><div class="media media--wide"><img src="/mas-cool-assets/condenser-blue.png" width="1672" height="941" loading="lazy" decoding="async" alt="كوندنسر هواء صناعي أزرق بمروحتين"></div><div class="product__body"><span class="product__kicker">مكثفات هوائية</span><h3>كوندنسر هواء</h3><p class="product__desc">مكثف هواء صناعي بمواصفات عالية وتبريد ثابت.</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="كوندنسر هواء" data-value="condensers">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button">التفاصيل<span class="visually-hidden"> — كوندنسر هواء</span></button><button class="btn btn--ghost btn--sm" type="button">المواصفات<span class="visually-hidden"> — كوندنسر هواء</span></button></div></div></article>
        <article class="product" data-type="coils"><span class="product__flag">متاح للمعاينة</span><div class="media media--wide"><img src="/mas-cool-assets/coil-white.png" width="1672" height="941" loading="lazy" decoding="async" alt="كويل تبريد أبيض بمروحتين"></div><div class="product__body"><span class="product__kicker">تبريد وتجميد</span><h3>كويل تبريد</h3><p class="product__desc">كويل هواء للتبريد والتجميد بمقاسات وقدرات متعددة.</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="كويل تبريد" data-value="coils">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button">التفاصيل<span class="visually-hidden"> — كويل تبريد</span></button><button class="btn btn--ghost btn--sm" type="button">المواصفات<span class="visually-hidden"> — كويل تبريد</span></button></div></div></article>
        <article class="product" data-type="compressors"><span class="product__flag">متاح للمعاينة</span><div class="media media--sq"><img src="/mas-cool-assets/compressor-green.png" width="1672" height="941" loading="lazy" decoding="async" alt="كباس تبريد نصف مغلق أخضر"></div><div class="product__body"><span class="product__kicker">كباسات تبريد</span><h3>كباس نصف مغلق</h3><p class="product__desc">كباس صناعي عالي الكفاءة، اسأل عن القدرة والحالة.</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="كباس نصف مغلق" data-value="compressors">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button">التفاصيل<span class="visually-hidden"> — كباس نصف مغلق</span></button><button class="btn btn--ghost btn--sm" type="button">المواصفات<span class="visually-hidden"> — كباس نصف مغلق</span></button></div></div></article>
        <article class="product" data-type="units"><span class="product__flag">متاح للمعاينة</span><div class="media media--wide"><img src="/mas-cool-assets/condensing-unit-green.png" width="1672" height="941" loading="lazy" decoding="async" alt="وحدة تكثيف خضراء متكاملة"></div><div class="product__body"><span class="product__kicker">وحدات تبريد</span><h3>وحدة تكثيف</h3><p class="product__desc">وحدة تكثيف متكاملة وجاهزة لمتطلبات المشروع.</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="وحدة تكثيف" data-value="units">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button">التفاصيل<span class="visually-hidden"> — وحدة تكثيف</span></button><button class="btn btn--ghost btn--sm" type="button">المواصفات<span class="visually-hidden"> — وحدة تكثيف</span></button></div></div></article>
        <article class="product" data-type="coils"><span class="product__flag">متاح للمعاينة</span><div class="media media--xwide"><img src="/mas-cool-assets/coil-four-fan.png" width="2159" height="728" loading="lazy" decoding="async" alt="كويل تجميد صناعي بأربع مراوح"></div><div class="product__body"><span class="product__kicker">كويلات متعددة المراوح</span><h3>كويل تجميد</h3><p class="product__desc">كويل تجميد صناعي بأربع مراوح وقدرة تشغيل عالية.</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="كويل تجميد" data-value="coils">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button">التفاصيل<span class="visually-hidden"> — كويل تجميد</span></button><button class="btn btn--ghost btn--sm" type="button">المواصفات<span class="visually-hidden"> — كويل تجميد</span></button></div></div></article>
        <article class="product" data-type="compressors"><span class="product__flag">متاح للمعاينة</span><div class="media media--sq"><img src="/mas-cool-assets/compressor-blue.png" width="1672" height="941" loading="lazy" decoding="async" alt="كباس تبريد صناعي أزرق"></div><div class="product__body"><span class="product__kicker">كباسات صناعية</span><h3>كباس تبريد</h3><p class="product__desc">كباس متعدد الاستخدامات، راجع الموديل والتوافر.</p><div class="product__actions"><button class="btn btn--dark btn--sm" type="button" data-inquire="كباس تبريد" data-value="compressors">استفسر عن السعر <span class="arrow" aria-hidden="true">←</span></button><button class="btn btn--ghost btn--sm" type="button">التفاصيل<span class="visually-hidden"> — كباس تبريد</span></button><button class="btn btn--ghost btn--sm" type="button">المواصفات<span class="visually-hidden"> — كباس تبريد</span></button></div></div></article>
    </div>
    <div class="products-more"><a class="btn btn--outline" href="#contact">استعرض جميع المعدات ⊞</a></div>
</div></section>

<section class="visit" aria-labelledby="visit-title">
    <div class="visit__media" role="img" aria-label="مراوح تبريد صناعية"></div>
    <div class="container visit__inner"><div class="visit__copy"><h2 id="visit-title">شوف المعدة. جرّبها. <span>وقرر بثقة.</span></h2><p>تواصل معنا لتنسيق زيارتك ومعاينة المعدات.</p><a class="btn btn--lime" href="#contact">احجز زيارتك الآن <span class="arrow" aria-hidden="true">←</span></a><span class="visit__note"><i aria-hidden="true"></i> معاينة واختبار بالمخزن مع استشارة فنية</span></div></div>
</section>

<section class="section advice" id="about" aria-labelledby="advice-title"><div class="container advice__grid">
    <figure class="advice__figure"><div class="advice__image" role="img" aria-label="مروحة تبريد صناعية عن قرب"></div><figcaption class="advice__caption">خبرة فنية • اختيار أدق</figcaption></figure>
    <div><p class="eyebrow-label">03 / اختيار مدروس</p><h2 class="section-title" id="advice-title">اختيار المعدة يبدأ بفهم <span>احتياجك</span></h2><p class="advice__lead">شاركنا نوع الاستخدام والمواصفات المطلوبة؛ لنساعدك في اختيار المعدة المناسبة.</p>
    <div class="advice-list">
        <div class="advice-point"><span class="advice-point__num" aria-hidden="true">01</span><div><h3>نوع الاستخدام</h3><p>تحديد طبيعة التطبيق وبيئة التشغيل المناسبة.</p></div></div>
        <div class="advice-point"><span class="advice-point__num" aria-hidden="true">02</span><div><h3>القدرة المطلوبة</h3><p>اختيار السعة والقدرة المتوافقة مع احتياج مشروعك.</p></div></div>
        <div class="advice-point"><span class="advice-point__num" aria-hidden="true">03</span><div><h3>ظروف التشغيل</h3><p>مراعاة درجات الحرارة والظروف البيئية لأفضل أداء.</p></div></div>
    </div>
    </div>
</div></section>

<section class="section section--compact process" aria-labelledby="process-title"><div class="container"><div class="process__head"><p class="eyebrow-label">04 / خطوات واضحة</p><h2 class="section-title" id="process-title">من أول استفسار لحد المعاينة</h2><p class="section-desc">خطوات بسيطة تضمن لك اختيار المعدة المناسبة.</p></div><div class="steps">
    <div class="step"><span class="step__number">01</span><div class="step__body"><span class="step__icon"><svg class="icon" aria-hidden="true"><use href="#note"/></svg></span><h3>حدد احتياجك</h3><p>اخبرنا بنوع الاستخدام والمواصفات التي تبحث عنها.</p></div></div>
    <div class="step"><span class="step__number">02</span><div class="step__body"><span class="step__icon"><svg class="icon" aria-hidden="true"><use href="#search"/></svg></span><h3>راجع التفاصيل</h3><p>استفسر عن الموديل والقدرة والحالة والتوافر والسعر.</p></div></div>
    <div class="step step--final"><span class="step__number">03</span><div class="step__body"><span class="step__icon"><svg class="icon" aria-hidden="true"><use href="#calendar"/></svg></span><h3>احجز المعاينة</h3><p>نسّق موعدًا لمعاينة المعدة والتأكد من ملاءمتها.</p></div></div>
</div></div></section>

<section class="section section--compact faq" aria-labelledby="faq-title"><div class="container faq__grid"><div class="faq__intro"><p class="eyebrow-label">05 / نجاوب على أسئلتك</p><h2 id="faq-title">أسئلة قبل الشراء</h2><p>إجابات واضحة تساعدك في اتخاذ القرار المناسب.</p></div><div class="faq__list">
    <details open><summary>هل يمكن معاينة المعدة قبل الشراء؟</summary><div class="faq__answer"><p>يمكن التواصل معنا لتنسيق موعد المعاينة والاطلاع على تفاصيل المعدة وإجراءات الاختبار المتاحة.</p></div></details>
    <details><summary>كيف أختار القدرة المناسبة؟</summary><div class="faq__answer"><p>شارك معنا نوع الاستخدام وحجم المساحة ودرجة الحرارة المطلوبة، وسنراجع المتطلبات الفنية معك.</p></div></details>
    <details><summary>كيف أطلب عرض سعر؟</summary><div class="faq__answer"><p>اختر «استفسر عن السعر» أسفل المعدة أو املأ النموذج التالي بتفاصيل احتياجك.</p></div></details>
    <details><summary>كيف أتأكد من توافر المعدة؟</summary><div class="faq__answer"><p>التوافر يتغير؛ تواصل معنا لتأكيد الموديل والحالة والكمية المتاحة قبل الزيارة.</p></div></details>
</div></div></section>

<section class="section contact" id="contact" aria-labelledby="contact-title"><div class="container contact__grid"><div class="contact__copy"><p class="eyebrow">الخطوة القادمة تبدأ هنا</p><h2 id="contact-title">جاهز نختار المعدة <span>المناسبة؟</span></h2><p>اترك تفاصيل احتياجك وسنتواصل معك.</p></div><form class="form" id="inquiry" novalidate><div class="form__grid">
    <div class="field"><label for="name">الاسم</label><input id="name" name="name" autocomplete="name" placeholder="الاسم بالكامل" required maxlength="100"></div>
    <div class="field"><label for="phone">رقم الهاتف</label><input id="phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" placeholder="رقم الهاتف" required maxlength="25"></div>
    <div class="field"><label for="type">نوع المعدة</label><select id="type" name="type" required><option value="">اختر نوع المعدة</option><option value="compressors">كباسات</option><option value="coils">كويلات</option><option value="units">وحدات تبريد</option><option value="condensers">كوندنسرات</option><option value="other">أحتاج مساعدة في الاختيار</option></select></div>
    <div class="field"><label for="message">تفاصيل الطلب</label><textarea id="message" name="message" placeholder="اكتب تفاصيل احتياجك هنا..." required maxlength="1500"></textarea></div>
    </div><button class="btn btn--lime" type="submit">إرسال الاستفسار <span class="arrow" aria-hidden="true">◁</span></button><p class="form__note">سيتم تجهيز رسالة قابلة للنسخ، ولا تُرسل بياناتك تلقائيًا.</p></form>
</div></section>
</main>

<footer class="footer"><div class="container"><div class="footer__grid"><div class="footer__brand"><a class="brand" href="#top"><svg class="brand__mark" aria-hidden="true"><use href="#snow"/></svg><div><div class="brand__word">mas Cool</div><div class="brand__tag">معدات التبريد الصناعي</div></div></a></div><div class="footer__links"><h3 class="footer__title">روابط سريعة</h3><a href="#top">الرئيسية</a><a href="#equipment">المعدات</a><a href="#about">لماذا mas Cool</a><a href="#contact">تواصل معنا</a></div><div class="footer__links"><h3 class="footer__title">المعدات</h3><a href="#equipment">كباسات</a><a href="#equipment">كويلات تبريد</a><a href="#equipment">وحدات تكثيف</a><a href="#equipment">كوندنسرات</a></div><div class="footer__links footer__start"><h3 class="footer__title">ابدأ معنا</h3><div class="footer__links-row"><a href="#contact">اطلب عرض سعر ←</a><a href="#contact">نسّق موعد المعاينة</a></div></div></div><div class="footer__bottom"><span>© <span id="year"></span> mas Cool — جميع الحقوق محفوظة.</span><a href="#top">العودة للأعلى ↑</a></div></div></footer>

<dialog class="dialog" id="request-dialog"><h2>طلبك جاهز</h2><p>انسخ الرسالة وأرسلها عبر وسيلة التواصل المناسبة.</p><textarea id="request-text" readonly aria-label="نص الطلب"></textarea><div class="dialog__actions"><button class="btn btn--lime" id="copy" type="button">نسخ الرسالة</button><button class="btn btn--outline" id="close-dialog" type="button">إغلاق</button></div><div class="status" id="status" role="status"></div></dialog>

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
document.querySelectorAll('[data-inquire]').forEach(btn=>btn.addEventListener('click',()=>{document.querySelector('#type').value=btn.dataset.value;document.querySelector('#message').value=`أرغب في معرفة السعر والتوافر والمواصفات الخاصة بـ ${btn.dataset.inquire}.`;document.querySelector('#contact').scrollIntoView({block:'start'});}));
const dialog=document.querySelector('#request-dialog');
const requestText=document.querySelector('#request-text');
document.querySelector('#inquiry').addEventListener('submit',e=>{e.preventDefault();const form=e.currentTarget;if(!form.checkValidity()){form.reportValidity();return;}const data=new FormData(form);const select=document.querySelector('#type');requestText.value=[`مرحبًا mas Cool، أرغب في طلب عرض سعر.`,`الاسم: ${data.get('name')}`,`الهاتف: ${data.get('phone')}`,`نوع المعدة: ${select.options[select.selectedIndex].text}`,`التفاصيل: ${data.get('message')}`].join('\n');document.querySelector('#status').textContent='';dialog.showModal();});
document.querySelector('#copy').addEventListener('click',async()=>{try{await navigator.clipboard.writeText(requestText.value);document.querySelector('#status').textContent='تم نسخ الرسالة.';}catch{requestText.select();document.querySelector('#status').textContent='تم تحديد الرسالة؛ اضغط Ctrl+C لنسخها.';}});
document.querySelector('#close-dialog').addEventListener('click',()=>dialog.close());
document.querySelector('#year').textContent=new Date().getFullYear();
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
