@extends('landing.layouts.master' , ['page' => 'home'])

@section('title')
ماس للتبريد والتكييف المركزي | غرف تبريد وتجميد | Mas Cooling
@endsection

@section('meta_description', 'شركة ماس للتبريد والتكييف المركزي - متخصصون في تصميم وتركيب وصيانة غرف التبريد وغرف التجميد وأنظمة التكييف المركزي. خبرة أكثر من 15 عاماً في مجال التبريد الصناعي والتجاري. اتصل بنا الآن للحصول على استشارة مجانية.')
@section('meta_keywords', 'تبريد, غرف تبريد, غرف تجميد, تكييف مركزي, شركة تبريد, صيانة تكييف, تبريد صناعي, تبريد تجاري, أنظمة تبريد, ماس للتبريد, Mas Cooling, تركيب غرف تبريد, صيانة غرف تبريد, تكييف مركزي مصر, حلول تبريد, الماس لغرف التبريد, الماس للتبريد, الماس للغرف, تكييفات, mas لغرف التبريد, mas للتكييف')
@section('og_title', 'ماس للتبريد والتكييف المركزي | غرف تبريد وتجميد | Mas Cooling')
@section('og_description', 'شركة ماس للتبريد - خبراء تصميم وتركيب غرف التبريد والتجميد وأنظمة التكييف المركزي. خبرة +15 سنة. استشارة مجانية.')

@section('content')
<main class="landing-craft">
    <style>
        .landing-craft {
            --craft-ink: #091526;
            --craft-muted: #5b6b7f;
            --craft-line: #dbe7f1;
            --craft-surface: #ffffff;
            --craft-soft: #eef5f9;
            --craft-blue: #087db8;
            --craft-blue-strong: #0d5e9c;
            --craft-cyan: #29c6d1;
            --craft-accent: #f27a45;
            background: #f4f8fb;
            color: var(--craft-ink);
            overflow: hidden;
        }

        .landing-craft section {
            scroll-margin-top: 105px;
        }

        .landing-craft .premium-hero {
            min-height: 78vh;
            margin-bottom: 0;
            padding: 140px 0 108px;
            background: #071522;
            isolation: isolate;
        }

        .landing-craft .premium-hero__bg-shapes {
            display: none;
        }

        .landing-craft .premium-hero__container {
            display: block;
            max-width: 1180px;
            padding: 0 32px;
            position: static;
        }

        .landing-craft .premium-hero__content {
            position: relative;
            z-index: 2;
            max-width: 700px;
            margin-left: auto;
            margin-right: 0;
            padding: 0;
            color: #ffffff;
        }

        .landing-craft .premium-hero__badge,
        .landing-craft .premium-projects__badge,
        .landing-craft .premium-about__badge {
            letter-spacing: 0;
            text-transform: none;
        }

        .landing-craft .premium-hero__badge {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.24);
            color: #dffaff;
            border-radius: 999px;
            box-shadow: none;
        }

        .landing-craft .premium-hero__title {
            color: #ffffff;
            font-size: 3.6rem;
            line-height: 1.22;
            margin-bottom: 1.25rem;
            max-width: 680px;
            text-shadow: 0 16px 50px rgba(0, 0, 0, 0.38);
        }

        .landing-craft .premium-hero__title span {
            background: linear-gradient(135deg, #7dd3fc, #5eead4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .landing-craft .premium-hero__desc {
            color: rgba(240, 249, 255, 0.84);
            max-width: 650px;
            margin-bottom: 1.75rem;
            font-size: 1.08rem;
        }

        .premium-hero__metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            max-width: 610px;
            margin-bottom: 2rem;
        }

        .premium-hero__metric {
            min-height: 88px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
        }

        .premium-hero__metric strong {
            display: block;
            color: #ffffff;
            font-size: 1.8rem;
            line-height: 1;
            margin-bottom: 8px;
        }

        .premium-hero__metric span {
            display: block;
            color: rgba(240, 249, 255, 0.76);
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .landing-craft .premium-hero__actions {
            gap: 1rem;
        }

        .landing-craft .premium-btn {
            min-height: 58px;
            border-radius: 8px;
            padding: 0.95rem 1.65rem;
        }

        .landing-craft .premium-btn--primary {
            background: linear-gradient(135deg, #0ea5e9, #1237a8);
            box-shadow: 0 18px 35px rgba(6, 40, 96, 0.35);
        }

        .landing-craft .premium-btn--secondary {
            background: rgba(255, 255, 255, 0.94);
            border-color: rgba(255, 255, 255, 0.6);
            color: #071522 !important;
        }

        .landing-craft .premium-hero__image-wrapper {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .landing-craft .premium-hero__image-container {
            width: 100%;
            height: 100%;
            border-radius: 0;
            box-shadow: none;
            transform: none;
        }

        .landing-craft .premium-hero__image-container::before {
            background:
                linear-gradient(90deg, rgba(7, 21, 34, 0.24) 0%, rgba(7, 21, 34, 0.74) 55%, rgba(7, 21, 34, 0.95) 100%),
                linear-gradient(180deg, rgba(7, 21, 34, 0.45), rgba(7, 21, 34, 0.18) 44%, rgba(7, 21, 34, 0.82));
            border: 0;
            border-radius: 0;
        }

        .landing-craft .premium-hero__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: none;
        }

        .landing-craft .premium-hero__float-card {
            right: auto;
            left: max(32px, calc((100vw - 1180px) / 2 + 32px));
            bottom: 52px;
            border-radius: 8px;
            animation: none;
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 24px 55px rgba(3, 18, 34, 0.24);
        }

        .landing-craft .premium-hero__float-icon,
        .landing-craft .feature-icon-wrapper,
        .landing-craft .service-card__icon {
            border-radius: 8px;
        }

        .landing-craft .premium-features {
            position: relative;
            z-index: 5;
            margin-top: 0;
            padding: 76px 0 86px;
            background:
                linear-gradient(180deg, #f7fbfd 0%, #eef5f9 100%);
            border-top: 1px solid #dfeaf2;
        }

        .landing-craft .premium-features::before {
            content: '';
            position: absolute;
            inset: 0 0 auto;
            height: 4px;
            background: linear-gradient(90deg, #29c6d1, #087db8, #f27a45);
        }

        .features-heading {
            max-width: 760px;
            margin: 0 auto 36px;
            padding: 0 32px;
            color: var(--craft-ink);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            text-align: center;
        }

        .features-heading__eyebrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 34px;
            padding: 6px 14px;
            border-radius: 999px;
            background: #e7f7fb;
            color: var(--craft-blue-strong);
            border: 1px solid #c9eaf2;
            font-size: 0.86rem;
            font-weight: 800;
        }

        .features-heading h2 {
            font-size: 2.05rem;
            font-weight: 800;
            color: var(--craft-ink);
            margin: 0;
            line-height: 1.28;
        }

        .features-heading p {
            max-width: 660px;
            color: var(--craft-muted);
            margin: 0;
            line-height: 1.8;
            font-size: 1.02rem;
        }

        .features-heading::after {
            content: '';
            width: 76px;
            height: 3px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--craft-cyan), var(--craft-blue));
            margin-top: 4px;
        }

        .landing-craft .features-grid,
        .landing-craft .premium-about__container,
        .landing-craft .premium-projects__grid,
        .landing-craft .services-grid,
        .landing-craft .testimonial-container {
            max-width: 1180px;
            padding-inline: 32px;
        }

        .landing-craft .features-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .landing-craft .feature-card {
            min-height: 248px;
            align-items: flex-start;
            text-align: right;
            border-radius: 8px;
            background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
            border-color: var(--craft-line);
            box-shadow: 0 18px 40px rgba(11, 42, 73, 0.08);
            padding: 30px;
        }

        .landing-craft .feature-card:hover,
        .landing-craft .service-card:hover,
        .landing-craft .premium-projects__card:hover {
            transform: translateY(-6px);
        }

        .landing-craft .feature-icon-wrapper {
            width: 64px;
            height: 64px;
            margin-bottom: 1.45rem;
            background: #e7f7fb;
            box-shadow: none;
        }

        .landing-craft .feature-title,
        .landing-craft .service-card__title {
            font-size: 1.24rem;
            line-height: 1.35;
        }

        .landing-craft .feature-title {
            margin-bottom: 0.9rem;
        }

        .landing-craft .feature-desc,
        .landing-craft .service-card__text,
        .landing-craft .premium-about__desc,
        .landing-craft .premium-projects__desc,
        .landing-craft .premium-services__desc {
            color: var(--craft-muted);
        }

        .landing-craft .premium-about {
            padding: 88px 0;
            background: #ffffff;
        }

        .landing-craft .premium-about__container {
            grid-template-columns: 1.05fr 0.95fr;
            gap: 56px;
        }

        .landing-craft .premium-about__images {
            gap: 14px;
        }

        .landing-craft .premium-about__img-wrapper,
        .landing-craft .premium-projects__card,
        .landing-craft .service-card,
        .landing-craft .testimonial-card,
        .landing-blog .wc > .animate_top,
        .landing-contact .contact-info-card,
        .landing-contact .contact-form-card {
            border-radius: 8px;
        }

        .landing-craft .premium-about__img-wrapper {
            box-shadow: 0 18px 45px rgba(9, 21, 38, 0.1);
        }

        .landing-craft .premium-about__title,
        .landing-craft .premium-projects__title,
        .landing-craft .premium-services__title,
        .landing-craft .premium-testimonials h2,
        .landing-blog h2,
        .landing-contact h2 {
            color: var(--craft-ink);
            font-size: 2.35rem;
            line-height: 1.28;
        }

        .landing-craft .premium-about__badge,
        .landing-craft .premium-projects__badge {
            color: var(--craft-blue-strong);
        }

        .landing-craft .premium-about__point {
            background: #f6fafc;
            border: 1px solid #e7eef5;
            border-radius: 8px;
            padding: 12px 14px;
            margin-bottom: 10px;
        }

        .landing-craft .video-btn__play {
            border-radius: 8px;
            background: var(--craft-accent);
        }

        .landing-craft .video-btn__play::after {
            display: none;
        }

        .landing-craft .premium-projects {
            padding: 86px 0;
            background: linear-gradient(180deg, #eef5f9 0%, #ffffff 100%);
        }

        .landing-craft .premium-projects__header,
        .landing-craft .premium-services__header {
            margin-bottom: 42px;
        }

        .landing-craft .premium-projects__tab {
            border-radius: 8px;
            background: #ffffff;
            border-color: #dce7f1;
            box-shadow: 0 10px 24px rgba(9, 21, 38, 0.06);
        }

        .landing-craft .premium-projects__tab.active {
            background: #0b5ea8;
            box-shadow: 0 14px 28px rgba(13, 94, 156, 0.22);
        }

        .landing-craft .premium-projects__grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .landing-craft .premium-projects__card {
            aspect-ratio: 1.12 / 1;
            box-shadow: 0 20px 45px rgba(9, 21, 38, 0.12);
        }

        .premium-projects__overlay {
            position: absolute;
            inset: auto 0 0;
            padding: 22px;
            color: #ffffff;
            background: linear-gradient(180deg, rgba(7, 21, 34, 0) 0%, rgba(7, 21, 34, 0.88) 52%, rgba(7, 21, 34, 0.96) 100%);
        }

        .premium-projects__category {
            display: inline-flex;
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 999px;
            background: rgba(41, 198, 209, 0.18);
            color: #dffaff;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .premium-projects__card-title {
            margin: 0 0 8px;
            color: #ffffff;
            font-size: 1.24rem;
            font-weight: 800;
            line-height: 1.35;
        }

        .premium-projects__card-desc {
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.6;
            margin-bottom: 14px;
        }

        .premium-projects__link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            font-weight: 800;
        }

        .landing-clients {
            padding: 78px 0;
            background: #ffffff;
            border-block: 1px solid #e8f0f6;
        }

        .landing-clients .wc {
            max-width: 980px;
            margin: 0 auto;
            padding: 24px 32px;
            border-radius: 8px;
            background: #f7fbfd;
            border: 1px solid #e4eef5;
            gap: 28px;
        }

        .landing-craft .premium-services {
            padding: 88px 0;
            background: #edf4f8;
        }

        .landing-craft .services-grid {
            gap: 18px;
        }

        .landing-craft .service-card {
            min-height: 315px;
            padding: 34px 28px;
            box-shadow: 0 16px 38px rgba(9, 21, 38, 0.08);
        }

        .landing-craft .service-card:nth-child(2),
        .landing-craft .service-card:nth-child(5) {
            border-color: rgba(8, 125, 184, 0.45);
            box-shadow: 0 22px 48px rgba(8, 125, 184, 0.14);
        }

        .landing-craft .premium-testimonials {
            padding: 84px 0;
            background: #ffffff;
        }

        .landing-craft .testimonial-container {
            max-width: 940px;
        }

        .landing-craft .testimonial-card {
            padding: 42px;
            border-color: #dfeaf2;
            box-shadow: 0 22px 55px rgba(9, 21, 38, 0.08);
        }

        .landing-stats {
            padding: 66px 0;
            background: #071522;
            color: #ffffff;
        }

        .landing-stats img,
        .landing-contact > template > div > img,
        .landing-contact img[alt="شكل"],
        .landing-cta img {
            display: none !important;
        }

        .landing-stats .bb {
            max-width: 1180px;
            padding-inline: 32px;
        }

        .landing-stats .tc.uf {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .landing-stats .animate_top {
            width: auto;
            min-height: 132px;
            padding: 24px 18px;
            border: 1px solid rgba(255, 255, 255, 0.13);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.07);
        }

        .landing-stats h2 {
            color: #ffffff;
            font-size: 2.65rem;
            line-height: 1;
            margin-bottom: 12px;
        }

        .landing-stats p {
            color: rgba(255, 255, 255, 0.72);
            margin: 0;
        }

        .landing-blog {
            padding: 88px 0;
            background: #f6fafc;
        }

        .landing-blog .wc {
            max-width: 1180px;
            margin: 0 auto;
            padding-inline: 32px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .landing-blog .wc > .animate_top {
            background: #ffffff;
            border: 1px solid #e2edf4;
            overflow: hidden;
            box-shadow: 0 18px 44px rgba(9, 21, 38, 0.08);
        }

        .landing-blog .wc > .animate_top > .c {
            height: 260px;
            overflow: hidden;
        }

        .landing-blog .wc > .animate_top img.w-full {
            height: 100% !important;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .landing-blog .wc > .animate_top:hover img.w-full {
            transform: scale(1.05);
        }

        .landing-blog .yh {
            padding: 22px;
        }

        .landing-blog h3 {
            font-size: 1.25rem;
            line-height: 1.45;
        }

        .landing-contact {
            padding: 90px 0;
            background: #eef5f9;
        }

        .landing-contact .wq {
            max-width: 1180px;
            padding-inline: 32px;
        }

        .landing-contact .contact-info-card,
        .landing-contact .contact-form-card {
            background: #ffffff;
            border: 1px solid #dfeaf2;
            box-shadow: 0 20px 48px rgba(9, 21, 38, 0.08);
        }

        .landing-contact .contact-info-card {
            max-width: 360px;
            border-top: 4px solid var(--craft-accent);
        }

        .landing-contact .contact-form-card {
            flex: 1;
            min-width: 0;
        }

        .landing-contact input,
        .landing-contact textarea {
            border-radius: 8px !important;
            border-color: #d7e4ee !important;
            background: #fbfdff !important;
            min-height: 56px;
        }

        .landing-contact textarea {
            min-height: 160px;
        }

        .landing-contact button[type="submit"] {
            border-radius: 8px;
            min-width: 190px;
            background: #0b5ea8;
        }

        .landing-cta {
            padding: 74px 0;
            background: linear-gradient(135deg, #0b5ea8, #071522);
        }

        .landing-cta h2,
        .landing-cta p {
            color: #ffffff;
        }

        .eh .landing-craft,
        .eh .landing-craft .premium-about,
        .eh .landing-craft .premium-testimonials,
        .eh .landing-clients {
            background: #08111f;
        }

        .eh .landing-craft .premium-projects,
        .eh .landing-craft .premium-services,
        .eh .landing-blog,
        .eh .landing-contact {
            background: #0d1726;
        }

        .eh .landing-craft .feature-card,
        .eh .landing-craft .service-card,
        .eh .landing-craft .testimonial-card,
        .eh .landing-blog .wc > .animate_top,
        .eh .landing-contact .contact-info-card,
        .eh .landing-contact .contact-form-card,
        .eh .landing-clients .wc {
            background: #111e2f;
            border-color: #223247;
        }

        .eh .landing-craft .premium-about__title,
        .eh .landing-craft .premium-projects__title,
        .eh .landing-craft .premium-services__title,
        .eh .landing-craft .premium-testimonials h2,
        .eh .landing-blog h2,
        .eh .landing-contact h2,
        .eh .landing-craft .feature-title,
        .eh .landing-craft .service-card__title {
            color: #f8fafc;
        }

        @media (max-width: 1024px) {
            .landing-craft .premium-hero {
                min-height: auto;
                padding: 124px 0 96px;
            }

            .landing-craft .premium-hero__content {
                max-width: 720px;
                text-align: right;
            }

            .landing-craft .premium-hero__title {
                font-size: 3rem;
            }

            .features-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .landing-craft .features-grid,
            .landing-craft .premium-projects__grid,
            .landing-craft .services-grid,
            .landing-blog .wc {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .landing-craft .premium-about__container {
                grid-template-columns: 1fr;
            }

            .landing-stats .tc.uf {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .landing-craft section {
                scroll-margin-top: 78px;
            }

            .landing-craft .premium-hero {
                padding: 112px 0 74px;
            }

            .landing-craft .premium-hero__container,
            .features-heading,
            .landing-craft .features-grid,
            .landing-craft .premium-about__container,
            .landing-craft .premium-projects__grid,
            .landing-craft .services-grid,
            .landing-craft .testimonial-container,
            .landing-blog .wc,
            .landing-contact .wq,
            .landing-stats .bb {
                padding-inline: 18px;
            }

            .landing-craft .premium-hero__title {
                font-size: 2.35rem;
            }

            .premium-hero__metrics,
            .landing-craft .features-grid,
            .landing-craft .premium-projects__grid,
            .landing-craft .services-grid,
            .landing-blog .wc,
            .landing-stats .tc.uf {
                grid-template-columns: 1fr;
            }

            .landing-craft .premium-hero__float-card {
                display: none;
            }

            .landing-craft .premium-hero__actions {
                align-items: stretch;
                flex-direction: column;
            }

            .features-heading {
                margin-bottom: 26px;
            }

            .features-heading h2 {
                font-size: 1.55rem;
            }

            .features-heading p {
                font-size: 0.95rem;
            }

            .landing-craft .premium-btn {
                width: 100%;
            }

            .landing-craft .premium-about,
            .landing-craft .premium-projects,
            .landing-craft .premium-services,
            .landing-craft .premium-testimonials,
            .landing-blog,
            .landing-contact {
                padding-block: 64px;
            }

            .landing-craft .premium-about__title,
            .landing-craft .premium-projects__title,
            .landing-craft .premium-services__title,
            .landing-craft .premium-testimonials h2,
            .landing-blog h2,
            .landing-contact h2 {
                font-size: 1.9rem;
            }
        }
    </style>
    <!-- ===== Premium Hero Start ===== -->
    <style>
        .premium-hero {
            position: relative;
            width: 100%;
            min-height: 85vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: #f8fafc;
            direction: rtl;
            font-family: 'Inter', 'Outfit', sans-serif;
            margin-bottom: 4rem;
            padding-top: 125px
        }

        .premium-hero__bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            pointer-events: none
        }

        .premium-hero__shape-1 {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(3, 105, 161, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%
        }

        .premium-hero__shape-2 {
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(30, 64, 175, 0.05) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%
        }

        .premium-hero__container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 4rem 5%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            z-index: 1;
            position: relative;
            width: 100%
        }

        .premium-hero__content {
            padding-top: 2rem
        }

        .premium-hero__badge {
            display: inline-flex;
            align-items: center;
            padding: .5rem 1.25rem;
            background: rgba(7, 89, 133, .1);
            color: #075985;
            border-radius: 50px;
            font-weight: 700;
            font-size: .875rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(7, 89, 133, .3);
            box-shadow: 0 4px 6px -1px rgba(7, 89, 133, .1)
        }

        .premium-hero__title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.3;
            color: #0f172a;
            margin-bottom: 1.5rem
        }

        .premium-hero__title span {
            background: linear-gradient(135deg, #0369a1, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent
        }

        .premium-hero__desc {
            font-size: 1.125rem;
            line-height: 1.8;
            color: #64748b;
            margin-bottom: 2.5rem;
            max-width: 90%
        }

        .premium-hero__actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap
        }

        .premium-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 12px;
            transition: all .3s ease;
            text-decoration: none;
            gap: .75rem
        }

        .premium-btn--primary {
            background: linear-gradient(135deg, #0369a1, #1e40af);
            color: #fff !important;
            box-shadow: 0 10px 25px -5px rgba(30, 64, 175, .4);
            border: 2px solid transparent
        }

        .premium-btn--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(30, 64, 175, .5)
        }

        .premium-btn--secondary {
            background: #fff;
            color: #0f172a !important;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, .05)
        }

        .premium-btn--secondary:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .05)
        }

        .premium-hero__image-wrapper {
            position: relative;
            z-index: 2
        }

        .premium-hero__image-container {
            position: relative;
            width: 100%;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25);
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform .6s cubic-bezier(.175, .885, .32, 1.275)
        }

        .premium-hero__image-wrapper:hover .premium-hero__image-container {
            transform: perspective(1000px) rotateY(0deg) translateY(-10px)
        }

        .premium-hero__image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, .2), rgba(255, 255, 255, 0));
            z-index: 10;
            pointer-events: none;
            border: 1px solid rgba(255, 255, 255, .3);
            border-radius: 24px
        }

        .premium-hero__image {
            width: 100%;
            height: 550px;
            object-fit: cover;
            display: block;
            transform: scale(1.05);
            transition: transform .6s ease
        }

        .premium-hero__image-wrapper:hover .premium-hero__image {
            transform: scale(1)
        }

        .premium-hero__float-card {
            position: absolute;
            bottom: -2rem;
            right: -2rem;
            background: rgba(255, 255, 255, .95);
            backdrop-filter: blur(10px);
            padding: 1.25rem 1.5rem;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 8px 10px -6px rgba(0, 0, 0, .1);
            display: flex;
            align-items: center;
            gap: 1.25rem;
            z-index: 20;
            animation: heroFloat 6s ease-in-out infinite;
            border: 1px solid rgba(255, 255, 255, .8)
        }

        .premium-hero__float-icon {
            width: 50px;
            height: 50px;
            background: #e0f2fe;
            color: #0369a1;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem
        }

        .premium-hero__float-text h5 {
            margin: 0;
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: .25rem
        }

        .premium-hero__float-text p {
            margin: 0;
            font-size: .875rem;
            color: #64748b
        }

        @keyframes heroFloat {
            0% {
                transform: translateY(0px)
            }

            50% {
                transform: translateY(-15px)
            }

            100% {
                transform: translateY(0px)
            }
        }

        .eh .premium-hero {
            background: #0b1120
        }

        .eh .premium-hero__title {
            color: #f8fafc
        }

        .eh .premium-hero__desc {
            color: #94a3b8
        }

        .eh .premium-hero__float-card {
            background: rgba(30, 41, 59, .95);
            border: 1px solid rgba(255, 255, 255, .1)
        }

        .eh .premium-hero__float-text h5 {
            color: #f8fafc
        }

        .eh .premium-btn--secondary {
            background: rgba(30, 41, 59, .5);
            color: #f8fafc !important;
            border-color: rgba(255, 255, 255, .1)
        }

        .eh .premium-btn--secondary:hover {
            background: rgba(30, 41, 59, 1);
            border-color: rgba(255, 255, 255, .2)
        }

        .eh .premium-hero__badge {
            background: rgba(3, 105, 161, .15);
            border-color: rgba(3, 105, 161, .3)
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .premium-hero__container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 4rem;
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .premium-hero__desc {
                margin: 0 auto 2.5rem;
            }

            .premium-hero__actions {
                justify-content: center;
            }

            .premium-hero__image-container {
                transform: none !important;
            }

            .premium-hero__float-card {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
                bottom: -2rem;
                animation: none;
            }
        }

        @media (max-width: 768px) {
            .premium-hero__title {
                font-size: 2.25rem;
            }

            .premium-hero__image {
                height: 350px;
            }

            .premium-hero__float-card {
                display: none;
                /* Hide on mobile to reduce paint complexity */
            }

            .premium-hero__badge {
                backdrop-filter: none;
                /* Expensive on mobile GPU */
            }

            .premium-hero__image-container {
                box-shadow: 0 10px 20px -5px rgba(0, 0, 0, .15);
            }

            .premium-hero__image-container::before {
                display: none;
                /* Remove overlay on mobile */
            }

            .premium-hero {
                min-height: auto;
                padding-top: 100px;
            }
        }
    </style>

    <section class="premium-hero">
        <!-- Background Accents -->
        <div class="premium-hero__bg-shapes">
            <div class="premium-hero__shape-1"></div>
            <div class="premium-hero__shape-2"></div>
        </div>

        <div class="premium-hero__container">
            <!-- Content -->
            <div class="premium-hero__content animate_right">
                <div class="premium-hero__badge">
                    <i class="fa-solid fa-snowflake" style="margin-inline-end: 0.5rem;"></i>
                    حلول هندسية متطورة
                </div>

                <h1 class="premium-hero__title">
                    {!! str_replace('احترافية', '<span>احترافية</span>', $heroSection->title) !!}
                </h1>

    <!-- ===== About Start ===== -->
    <section class="ji gp uq 2xl:ud-py-0 pg i pg qh rm ji hp " style="margin:30px">
        <div class="bb ze ki xn wq">
            <div class="tc wf gg qq">
                <!-- About Images -->
                <div class="animate_left xc gn gg jn/2 i">
                    <div>
                        <img src="{{ secure_asset('land/images/shape-05.svg')}}" alt="Shape" class="h -ud-left-5 x" />
                        <img src="{{ $aboutSection->image1 ? asset('storage/' . $aboutSection->image1) : secure_asset('land/images/About1.jpeg') }}" style="height: 350px !important;width: 300px !important;" alt="أنظمة التبريد المتطورة" class="ib" />
                        <img src="{{ $aboutSection->image2 ? asset('storage/' . $aboutSection->image2) : secure_asset('land/images/About2.jpeg') }}" style="height: 300px !important;width: 300px !important;" height="100" alt="تركيب الأنظمة المركزية" />
                    </div>
                    <div>
                        <img src="{{ $aboutSection->image3 ? asset('storage/' . $aboutSection->image3) : secure_asset('land/images/About3.jpeg') }}" style="height: 300px !important;width: 300px !important;" alt="صيانة الأنظمة" class="ob gb" />
                        <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="Shape" class="bb" />
                    </div>
                </div>

                <div class="premium-hero__actions">
                    <a href="#contact" class="premium-btn premium-btn--primary">
                        اطلب استشارة مجانية
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>

                    <a href="tel:{{ optional(\App\Models\Setting\ContactSetting::first())->phone ?? '0123456789' }}" class="premium-btn premium-btn--secondary">
                        <i class="fa-solid fa-phone" style="color:#0ea5e9; font-size:1.1rem;"></i>
                        <div style="text-align: right; display:flex; flex-direction:column; align-items:start;">
                            <span style="font-size: 0.75rem; color:#64748b; font-weight:normal; line-height: 1;">اتصل بنا الآن</span>
                            <span style="line-height: 1.2; font-weight:bold;">{{ optional(\App\Models\Setting\ContactSetting::first())->phone ?? '0123456789' }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="premium-hero__image-wrapper animate_left">
                <div class="premium-hero__image-container">
                    @php
                    $baseImage = str_replace(['.jpg', '.png', '.jpeg'], '', $heroSection->image);
                    $webpImage = $baseImage . '.webp';
                    $mobileWebp = $baseImage . '-mobile.webp';
                    @endphp
                    <picture>
                        <source type="image/webp" media="(max-width: 767px)" srcset="{{ secure_asset('storage/' . $mobileWebp) }}">
                        <source type="image/webp" srcset="{{ secure_asset('storage/' . $webpImage) }}">
                        <img src="{{ secure_asset('storage/' . $heroSection->image) }}" alt="{{ $heroSection->title }}" class="premium-hero__image" fetchpriority="high" loading="eager" width="600" height="500" />
                    </picture>
                </div>

                <!-- Floating Card -->
                <div class="premium-hero__float-card">
                    <div class="premium-hero__float-icon">
                        <i class="fa-solid fa-temperature-arrow-down"></i>
                    </div>
                    <div class="premium-hero__float-text">
                        <h5>أقصى كفاءة</h5>
                        <p>تبريد مثالي وموفر للطاقة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ Premium Hero End ================ -->

    <!-- ================ Premium Features Start ================ -->
    <style>
        .premium-features {
            padding: 5rem 0;
            background: #ffffff;
            direction: rtl;
        }

        .eh .premium-features {
            background: #0b1120;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 5%;
        }

        .feature-card {
            background: #f8fafc;
            padding: 3rem 2rem;
            border-radius: 24px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .eh .feature-card {
            background: rgba(30, 41, 59, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-12px);
            background: #ffffff;
            box-shadow: 0 25px 50px -12px rgba(14, 165, 233, 0.15);
            border-color: #0ea5e9;
        }

        .eh .feature-card:hover {
            background: #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border-color: #0ea5e9;
        }

        .feature-icon-wrapper {
            width: 80px;
            height: 80px;
            background: #ffffff;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            border: 1px solid #f1f5f9;
            z-index: 2;
        }

        .eh .feature-icon-wrapper {
            background: #0f172a;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .feature-card:hover .feature-icon-wrapper {
            transform: scale(1.1) rotate(8deg);
            background: #0ea5e9;
            color: white;
            box-shadow: 0 15px 25px -5px rgba(14, 165, 233, 0.4);
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            object-fit: contain;
            transition: all 0.4s ease;
        }

        .feature-card:hover .feature-icon {
            filter: brightness(0) invert(1);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.25rem;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .eh .feature-title {
            color: #f8fafc;
        }

        .feature-desc {
            font-size: 1rem;
            line-height: 1.8;
            color: #64748b;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .eh .feature-desc {
            color: #94a3b8;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #0ea5e9, #2563eb);
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: right;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }
    </style>

    <section id="features" class="premium-features">
        <div class="features-heading">
            <span class="features-heading__eyebrow">ركائز التشغيل اليومي</span>
            <h2>ما الذي يجعل النظام يعتمد عليه يومياً؟</h2>
            <p>تصميم وتنفيذ وصيانة مبنية على قراءة الأحمال، جودة المعدات، وسهولة التشغيل بعد التسليم.</p>
        </div>
        <div class="features-grid">
            @foreach ($features as $feature)
            <div class="feature-card animate_top">
                <div class="feature-icon-wrapper">
                    <img src="{{ secure_asset('storage/' . $feature->image) }}" alt="{{ $feature->title }}" class="feature-icon" loading="lazy" />
                </div>
                <h4 class="feature-title">{{ $feature->title }}</h4>
                <p class="feature-desc">
                    {{ $feature->description }}
                </p>
            </div>
            @endforeach
        </div>
    </section>
    <!-- ===== Premium Features End ===== -->

    <!-- ===== Premium About Start ===== -->
    <style>
        .premium-about {
            padding: 6rem 0;
            background: #fff;
            direction: rtl;
            overflow: hidden
        }

        .eh .premium-about {
            background: #0b1120
        }

        .premium-about__container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 5rem;
            align-items: center
        }

        .premium-about__images {
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem
        }

        .premium-about__img-wrapper {
            border-radius: 24px;
            overflow: hidden;
            transition: all .5s ease
        }

        .premium-about__img-wrapper:hover {
            transform: scale(1.03) translateY(-10px);
            box-shadow: 0 30px 40px -10px rgba(0, 0, 0, .2)
        }

        .premium-about__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block
        }

        .premium-about__img--large {
            grid-row: span 2;
            height: 500px
        }

        .premium-about__img--small {
            height: 240px
        }

        .premium-about__badge {
            color: #0369a1;
            font-weight: 700;
            font-size: .9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            display: block
        }

        .premium-about__title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 2rem
        }

        .eh .premium-about__title {
            color: #f8fafc
        }

        .premium-about__desc {
            font-size: 1.125rem;
            color: #64748b;
            margin-bottom: 2.5rem
        }

        .eh .premium-about__desc {
            color: #94a3b8
        }

        .premium-about__points {
            list-style: none;
            padding: 0
        }

        .premium-about__point {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
            color: #334155;
            font-size: 1.05rem;
            text-align: right
        }

        .eh .premium-about__point {
            color: #cbd5e1
        }

        .premium-about__point-icon {
            width: 24px;
            height: 24px;
            background: #0ea5e9;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            flex-shrink: 0;
            margin-top: 4px
        }

        .video-btn {
            display: inline-flex;
            align-items: center;
            gap: 1.25rem;
            text-decoration: none
        }

        .video-btn__play {
            width: 64px;
            height: 64px;
            background: #0ea5e9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            position: relative;
            transition: all .3s ease
        }

        .video-btn:hover .video-btn__play {
            transform: scale(1.1);
            background: #2563eb;
            box-shadow: 0 0 0 10px rgba(37, 99, 235, .1)
        }

        .video-btn__play::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            border: 2px solid #0ea5e9;
            animation: aboutPulse 2s infinite
        }

        @keyframes aboutPulse {
            0% {
                transform: scale(1);
                opacity: 1
            }

            100% {
                transform: scale(1.5);
                opacity: 0
            }
        }

        .video-btn__text {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.1rem
        }

        .eh .video-btn__text {
            color: #f8fafc
        }

        @media (max-width:1024px) {
            .premium-about__container {
                grid-template-columns: 1fr;
                gap: 4rem
            }

            .premium-about__images {
                order: 2;
                max-width: 600px;
                margin: 0 auto
            }

            .premium-about__content {
                text-align: center
            }

            .premium-about__points {
                display: inline-block;
                text-align: right
            }

            .video-btn {
                justify-content: center
            }
        }

        @media (max-width:640px) {
            .premium-about__images {
                grid-template-columns: 1fr
            }

            .premium-about__img--large {
                height: 350px
            }
        }
    </style>

    <section id="about" class="premium-about" x-data="{ shown: false }" x-intersect.once="shown = true" style="min-height: 400px;">
        <template x-if="shown">
            <div class="premium-about__container">
                <!-- Images -->
                <div class="premium-about__images animate_left">
                    <div class="premium-about__img-wrapper premium-about__img--large">
                        <img src="{{ $aboutSection->image1 ? secure_asset('storage/' . $aboutSection->image1) : secure_asset('land/images/About1.jpeg') }}" width="400" height="500" alt="أنظمة التبريد" class="premium-about__img" loading="lazy" />
                    </div>
                    <div class="premium-about__img-wrapper premium-about__img--small">
                        <img src="{{ $aboutSection->image2 ? secure_asset('storage/' . $aboutSection->image2) : secure_asset('land/images/About2.jpeg') }}" width="400" height="240" alt="تركيب الأنظمة" class="premium-about__img" loading="lazy" />
                    </div>
                    <div class="premium-about__img-wrapper premium-about__img--small">
                        <img src="{{ $aboutSection->image3 ? secure_asset('storage/' . $aboutSection->image3) : secure_asset('land/images/About3.jpeg') }}" width="400" height="240" alt="صيانة الأنظمة" class="premium-about__img" loading="lazy" />
                    </div>
                </div>

                <!-- Content -->
                <div class="premium-about__content animate_right">
                    <span class="premium-about__badge">{{ $aboutSection->title ?? 'لماذا تختار خدماتنا' }}</span>
                    <h2 class="premium-about__title">{{ $aboutSection->subtitle ?? 'نضمن لك أنظمة تبريد وتكييف مركزية بكفاءة وجودة عالية' }}</h2>
                    <p class="premium-about__desc">
                        {{ $aboutSection->description ?? '' }}
                    </p>

                    <ul class="premium-about__points">
                        @foreach ($aboutSection->points as $point)
                        <li class="premium-about__point">
                            <span class="premium-about__point-icon">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            {{ $point->content }}
                        </li>
                        @endforeach
                    </ul>

                    <a href="{{ $aboutSection->video_url ?? 'https://www.youtube.com/watch?v=wBsEe-gpeCQ' }}" data-fslightbox class="video-btn">
                        <div class="video-btn__play">
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <span class="video-btn__text">شاهد كيفية عملنا</span>
                    </a>
                </div>
            </div>
        </template>
    </section>
    <!-- ===== Premium About End ===== -->

    <!-- ===== Premium Projects Start ===== -->
    <style>
        .premium-projects {
            padding: 6rem 0;
            background: #ffffff;
            direction: rtl;
        }

        .eh .premium-projects {
            background: #0b1120;
        }

        .premium-projects__header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4rem;
            padding: 0 5%;
        }

        .premium-projects__badge {
            display: inline-block;
            color: #0369a1;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            background: rgba(14, 165, 233, 0.1);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            border: 1px solid rgba(14, 165, 233, 0.3);
        }

        .premium-projects__title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .eh .premium-projects__title {
            color: #f8fafc;
        }

        .premium-projects__desc {
            font-size: 1.1rem;
            color: #64748b;
            line-height: 1.8;
        }

        .eh .premium-projects__desc {
            color: #94a3b8;
        }

        /* Tabs */
        .premium-projects__tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 3.5rem;
            padding: 0 5%;
        }

        .premium-projects__tab {
            background: #f1f5f9;
            color: #475569;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid transparent;
        }

        .eh .premium-projects__tab {
            background: #1e293b;
            color: #cbd5e1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .premium-projects__tab:hover {
            background: #e2e8f0;
            color: #0f172a;
            transform: translateY(-2px);
        }

        .eh .premium-projects__tab:hover {
            background: #334155;
            color: #f8fafc;
        }

        .premium-projects__tab.active {
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
            color: #ffffff;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
            border-color: transparent;
        }

        /* Grid */
        .premium-projects__grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 5%;
        }

        /* Card */
        .premium-projects__card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            background: #f8fafc;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            aspect-ratio: 4/3;
            border: 1px solid #f1f5f9;
        }

        .eh .premium-projects__card {
            background: #1e293b;
            box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.4);
            border-color: rgba(255, 255, 255, 0.05);
        }

        .premium-projects__card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 40px -10px rgba(14, 165, 233, 0.2);
            border-color: rgba(14, 165, 233, 0.3);
        }

        .eh .premium-projects__card:hover {
            box-shadow: 0 25px 40px -10px rgba(0, 0, 0, 0.6);
        }

        .premium-projects__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .premium-projects__card:hover .premium-projects__img {
            transform: scale(1.1);
        }

        .premium-projects__card-desc,
        .premium-projects__link {
            transform: translateY(0);
            opacity: 1;
        }

        .premium-projects__tabs {
            gap: 0.5rem;
        }

        .premium-projects__tab {
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
        }

        .premium-projects__grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    </style>

    <section class="premium-projects" id="projects" x-data="{ filterTab: 0, shown: false }" x-intersect.once="shown = true" style="min-height: 600px;">
        <template x-if="shown">
            <div>
                <div class="premium-projects__header animate_top">
                    <span class="premium-projects__badge">
                        <i class="fa-solid fa-briefcase" style="margin-inline-end: 0.5rem;"></i>
                        معرض أعمالنا
                    </span>
                    <h2 class="premium-projects__title">{{ $projectSection->title ?? 'أعمالنا ومشاريعنا في أنظمة التبريد والتكييف' }}</h2>
                    <p class="premium-projects__desc">
                        {{ $projectSection->description ?? 'نفخر بتنفيذ العديد من المشاريع الناجحة في مجال أنظمة التبريد والتكييف المركزية. اكتشف بعض أعمالنا البارزة التي تميزت بالجودة والكفاءة.' }}
                    </p>
                </div>

                <!-- Tabs -->
                <div class="premium-projects__tabs animate_top">
                    <button
                        @click="filterTab = 0"
                        :class="{ 'active': filterTab === 0 }"
                        class="premium-projects__tab"
                        aria-label="عرض جميع المشاريع">
                        جميع المشاريع
                    </button>

                    @foreach ($projectcategories as $index => $category)
                    @php $tabIndex = $index + 1; @endphp
                    <button
                        @click="filterTab = {{ $tabIndex }}"
                        :class="{ 'active': filterTab === {{ $tabIndex }} }"
                        class="premium-projects__tab"
                        aria-label="عرض مشاريع {{ $category->name }}">
                        {{ $category->name }}
                    </button>
                    @endforeach
                </div>

                <!-- Grid -->
                <div class="premium-projects__grid">
                    @foreach ($projectcategories as $index => $category)
                    @php $tabIndex = $index + 1; @endphp

                    @foreach ($category->images as $image)
                    <div class="premium-projects__card animate_top"
                        x-show="filterTab === 0 || filterTab === {{ $tabIndex }}"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-cloak>

                        <img src="{{ secure_asset('storage/projects/' . $image->image) }}"
                            alt="{{ $image->title ?? $category->name }}"
                            class="premium-projects__img"
                            loading="lazy"
                            width="400"
                            height="300" />

                        <div class="premium-projects__overlay">
                            <span class="premium-projects__category">{{ $category->name }}</span>
                            <h3 class="premium-projects__card-title">{{ $image->title ?? $category->name }}</h3>
                            @if($image->description)
                            <p class="premium-projects__card-desc">{{ $image->description }}</p>
                            @endif
                            <a href="{{ secure_asset('storage/projects/' . $image->image) }}" data-fslightbox class="premium-projects__link" rel="noopener noreferrer">
                                <span class="premium-projects__link-icon">
                                    <i class="fa-solid fa-expand"></i>
                                </span>
                                تكبير الصورة
                            </a>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </template>
    </section>
    <!-- ===== Premium Projects End ===== -->

    <!-- ===== Clients Start ===== -->
    <section class="pj vp mr landing-clients" x-data="{ shown: false }" x-intersect.once="shown = true" style="min-height: 200px;">
        <template x-if="shown">
            <div>
                <!-- Section Title Start -->
                <div x-data="{ sectionTitle: `شركاء النجاح`, sectionTitleText: `نفخر بشراكتنا مع كبرى الشركات والمؤسسات التي وثقت في خدماتنا وحلولنا المتميزة في مجال التبريد والتكييف.`}">
                    <div class="animate_top bb ze rj ki xn vq">
                        <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b">
                        </h2>
                        <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                    </div>
                </div>
                <!-- Section Title End -->

                <div class="bb ze ah ch pm hj xp ki xn 2xl:ud-px-49 bc">
                    <div class="wc rf qn zf cp kq xf wf">
                        @foreach ($clients as $client)
                        <a href="{{ $client->link ?? '#!' }}" class="rc animate_top" target="{{ $client->link ? '_blank' : '_self' }}" rel="noopener noreferrer" title="{{ $client->name }}">
                            <img class="th wl ml il zl om" src="{{ secure_asset('storage/' . $client->image) }}" alt="{{ $client->name ?? 'Client Logo' }}" style="width: 100px; height: 100px; object-fit: contain;" loading="lazy" width="100" height="100" />
                            <img class="xc sk ml il zl nm" src="{{ secure_asset('storage/' . $client->image) }}" alt="{{ $client->name ?? 'Client Logo' }}" style="width: 100px; height: 100px; object-fit: contain;" loading="lazy" width="100" height="100" />
                            <span class="d-block mt-2 text-center text-sm font-medium text-gray-700 dark:text-gray-300">{{ $client->name }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </template>
    </section>
    <!-- ===== Clients End ===== -->

    <!-- ===== Premium Services Start ===== -->
    <style>
        .premium-services {
            padding: 8rem 0;
            background: #f8fafc;
            direction: rtl;
            overflow: hidden;
        }

        .eh .premium-services {
            background: #0f172a;
        }

        .premium-services__header {
            max-width: 800px;
            margin: 0 auto 5rem;
            text-align: center;
            padding: 0 5%;
        }

        .premium-services__title {
            font-size: 2.75rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .eh .premium-services__title {
            color: #f8fafc;
        }

        .premium-services__desc {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.8;
        }

        .eh .premium-services__desc {
            color: #94a3b8;
        }

        .services-grid {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .service-card {
            background: #ffffff;
            padding: 3rem 2.5rem;
            border-radius: 24px;
            border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .eh .service-card {
            background: #1e293b;
            border-color: #334155;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
        }

        .service-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border-color: #0ea5e9;
        }

        .eh .service-card:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }

        .service-card__icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            transition: all 0.4s ease;
        }

        .eh .service-card__icon {
            background: linear-gradient(135deg, #1e3a8a20, #1e40af40);
        }

        .service-card:hover .service-card__icon {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, #0ea5e9, #2563eb);
        }

        .service-card__icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            transition: all 0.4s ease;
        }

        .service-card:hover .service-card__icon img {
            filter: brightness(0) invert(1);
        }

        .service-card__title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1.25rem;
            transition: color 0.3s ease;
        }

        .eh .service-card__title {
            color: #f8fafc;
        }

        .service-card__text {
            font-size: 1.05rem;
            color: #64748b;
            line-height: 1.7;
        }

        .eh .service-card__text {
            color: #94a3b8;
        }

        @media (max-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .premium-services {
                padding: 5rem 0;
            }
            .premium-services__title {
                font-size: 2rem;
            }
            .services-grid {
                grid-template-columns: 1fr;
            }
            .service-card {
                padding: 2.5rem 2rem;
            }
        }
    </style>

    <section id="services" class="premium-services" x-data="{ shown: false }" x-intersect.once="shown = true" style="min-height: 600px;">
        <template x-if="shown">
            <div>
                <div class="premium-services__header animate_top">
                    <h2 class="premium-services__title">
                        {{ $serviceSection->title ?? 'حلول متكاملة لأنظمة التبريد والتكييف المركزية' }}
                    </h2>
                    <p class="premium-services__desc">
                        {{ $serviceSection->description ?? 'نقدم أحدث الحلول المتكاملة في مجال غرف التبريد والتكييف والأنظمة المركزية، مصممة لتلبي احتياجاتك بدقة عالية وكفاءة استثنائية.' }}
                    </p>
                </div>

                <div class="services-grid">
                    @foreach ($services as $service)
                    <div class="service-card animate_top">
                        <div class="service-card__icon">
                            @if($service->icon)
                            <img src="{{ secure_asset('storage/' . $service->icon) }}" alt="{{ $service->title }}" loading="lazy" width="40" height="40">
                            @else
                            <img src="{{ secure_asset('land/images/shape-08.svg') }}" alt="{{ $service->title }}" loading="lazy" width="40" height="40">
                            @endif
                        </div>
                        <h3 class="service-card__title">{{ $service->title }}</h3>
                        <p class="service-card__text">{{ $service->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </template>
    </section>

    <!-- ===== Premium Services End ===== -->
    <!-- ===== Testimonials Start ===== -->
    <style>
        .premium-testimonials {
            padding: 5rem 0;
            background: #fcfdfe;
            direction: rtl;
            position: relative;
        }
        .eh .premium-testimonials {
            background: #0f172a;
        }
        .testimonial-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .testimonial-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.04);
            border: 1px solid #f1f5f9;
            position: relative;
            text-align: center;
            margin: 1rem;
        }
        .eh .testimonial-card {
            background: #1e293b;
            border-color: #334155;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }
        .testimonial-quote {
            color: #0369a1;
            opacity: 0.15;
            margin-bottom: 1.5rem;
            display: inline-block;
        }
        .testimonial-text {
            font-size: 1.25rem;
            line-height: 1.7;
            color: #334155;
            font-weight: 500;
            margin-bottom: 2rem;
        }
        .eh .testimonial-text {
            color: #cbd5e1;
        }
        .author-info {
            border-top: 1px solid #f1f5f9;
            padding-top: 1.5rem;
            display: inline-block;
            min-width: 200px;
        }
        .eh .author-info {
            border-color: #334155;
        }
        .author-name {
            display: block;
            font-weight: 700;
            color: #0f172a;
            font-size: 1.1rem;
        }
        .eh .author-name {
            color: #f8fafc;
        }
        .author-position {
            display: block;
            color: #64748b;
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }
        .nav-wrapper {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        .nav-btn {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s;
        }
        .eh .nav-btn {
            background: #1e293b;
            border-color: #334155;
            color: #94a3b8;
        }
        .nav-btn:hover {
            background: #0369a1;
            color: #fff;
            border-color: #0369a1;
            transform: scale(1.05);
        }
    </style>

    <section class="premium-testimonials" x-data="{ shown: false }" x-intersect.once="shown = true">
        <template x-if="shown">
            <div class="testimonial-container">
                <div class="animate_top text-center mb-8">
                    <h2 class="fk vj pr kk wm on/5 gq/2 bb _b mb-3">
                        {{ $testimonialSection->title ?? 'آراء عملائنا الكرام' }}
                    </h2>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{ $testimonialSection->description ?? 'نفخر بثقة العملاء الذين استفادوا من خدماتنا.' }}
                    </p>
                </div>

                <div class="animate_top">
                    <div class="swiper testimonial-01">
                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    <div class="testimonial-quote">
                                        <svg width="40" height="40" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C15.4647 8 15.017 8.44772 15.017 9V12C15.017 12.5523 14.5693 13 14.017 13H12.017V21H14.017ZM5.01704 21L5.01704 18C5.01704 16.8954 5.91242 16 7.01704 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H7.01704C6.46476 8 6.01704 8.44772 6.01704 9V12C6.01704 12.5523 5.56931 13 5.01704 13H3.01704V21H5.01704Z" /></svg>
                                    </div>
                                    <p class="testimonial-text">"{{ $testimonial->message }}"</p>
                                    <div class="author-info">
                                        <span class="author-name">{{ $testimonial->name }}</span>
                                        @if($testimonial->position)
                                        <span class="author-position">{{ $testimonial->position }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="nav-wrapper">
                            <div class="swiper-button-prev-custom nav-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                            </div>
                            <div class="swiper-button-next-custom nav-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </section>
    <!-- ===== Testimonials End ===== -->
    <!-- ===== Counter Start ===== -->
    <section class="i pg qh rm ji hp landing-stats" x-data="{ shown: false }" x-intersect.once="shown = true" style="min-height: 200px; overflow: hidden;">
        <template x-if="shown">
            <div>
                <img src="{{ secure_asset('land/images/shape-11.svg')}}" alt="Shape" class="of h ga ha ke ud-hidden md:ud-block" loading="lazy" width="100" height="100" />
                <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="Shape" class="h ia o ae jf ud-hidden md:ud-block" loading="lazy" width="100" height="100" />
                {{-- --}}
                <picture class="ud-hidden md:ud-block">
                    <source media="(min-width: 768px)" srcset="{{ secure_asset('land/images/shape-15.svg')}}">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" class="h q p" width="100" height="100" />
                </picture>

                <div class="bb ze i va ki xn br">
                    <div class="tc uf sn tn xf un gg">

                        @foreach($counters as $counter)
                        <div class="animate_top me/5 ln rj">
                            <h2 class="gk vj zp or kk wm hc">{{ $counter->number }}</h2>
                            <p class="ek bk aq">{{ $counter->title }}</p>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </template>
    </section>
    <!-- ===== Counter End ===== -->
    <section class="ji gp uq landing-blog" id="news" x-data="{ shown: false }" x-intersect.once="shown = true" style="min-height: 400px;">
        <template x-if="shown">
            <div>
                <!-- Section Title Start -->
                <div
                    x-data="{
            sectionTitle: '{{ $blogSection->title ?? 'أحدث المقالات والأخبار' }}',
            sectionTitleText: '{{ $blogSection->description ?? 'تابع أحدث المستجدات والتقنيات في عالم التبريد والتكييف. نشارككم نصائح وخبرات تساعدكم في الحفاظ على كفاءة أنظمتكم وتوفير الطاقة.' }}'
        }">

                    <div class="animate_top bb ze rj ki xn vq">
                        <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                        <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                    </div>

                </div>
                <!-- Section Title End -->

                <div class="bb ye ki xn vq jb jo">
                    <div class="wc qf pn xo zf iq">

                        @foreach ($posts as $post)
                        <div class="animate_top sg vk rm xm">

                            <!-- Image -->
                            <div class="c rc i z-1 pg">
                                <img class="w-full"
                                    src="{{ secure_asset('storage/blogs/' . $post->image ?? 'land/images/blog-01.jpg') }}"
                                    alt="{{ $post->title }}"
                                    style="height: 329px;width: 100%;" loading="lazy" width="400" height="329" />

                                <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                                    <a href="{{ route('blog.show', $post->id) }}"
                                        class="vc ek rg lk gh sl ml il gi hi">
                                        اقرأ المزيد
                                    </a>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="yh">

                                <div class="tc uf wf ag jq">

                                    <!-- Author -->
                                    <div class="tc wf ag">
                                        <img src="{{ secure_asset('land/images/icon-man.svg') }}" alt="كاتب" loading="lazy" width="20" height="20" />
                                        <p>{{ $post->author }}</p>
                                    </div>

                                    <!-- Date -->
                                    <div class="tc wf ag">
                                        <img src="{{ secure_asset('land/images/icon-calender.svg') }}" alt="تاريخ" loading="lazy" width="20" height="20" />
                                        <p>{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</p>
                                    </div>

                                </div>

                                <!-- Title -->
                                <h3 class="ek tj ml il kk wm xl eq lb">
                                    <a href="{{ route('blog.show', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>

                            </div>

                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </template>
    </section>

    <!-- ===== Testimonials End ===== -->

    <!-- ===== Counter Start ===== -->
    <section class="i pg qh rm ji hp">
        <img src="{{ secure_asset('land/images/shape-11.svg')}}" alt="Shape" class="of h ga ha ke" />
        <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="Shape" class="h ia o ae jf" />
        <img src="{{ secure_asset('land/images/shape-14.svg')}}" alt="Shape" class="h ja ka" />
        <img src="{{ secure_asset('land/images/shape-15.svg')}}" alt="Shape" class="h q p" />

        <div class="bb ze i va ki xn br">
            <div class="tc uf sn tn xf un gg">

                @foreach($counters as $counter)
                <div class="animate_top me/5 ln rj">
                    <h2 class="gk vj zp or kk wm hc">{{ $counter->number }}</h2>
                    <p class="ek bk aq">{{ $counter->title }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- ===== Counter End ===== -->

    <!-- ===== Blog Start ===== -->
    <section class="ji gp uq" id="news">

        <!-- Section Title Start -->
        <div
            <div
            x-data="{
            sectionTitle: '{{ $blogSection->title ?? 'أحدث المقالات والأخبار' }}',
            sectionTitleText: '{{ $blogSection->description ?? 'تابع أحدث المستجدات والتقنيات في عالم التبريد والتكييف. نشارككم نصائح وخبرات تساعدكم في الحفاظ على كفاءة أنظمتكم وتوفير الطاقة.' }}'
        }">

            <div class="animate_top bb ze rj ki xn vq">
                <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
            </div>

        </div>
        <!-- Section Title End -->

        <div class="bb ye ki xn vq jb jo">
            <div class="wc qf pn xo zf iq">

                @foreach ($posts as $post)
                <div class="animate_top sg vk rm xm">

                    <!-- Image -->
                    <div class="c rc i z-1 pg">
                        <img class="w-full"
                            src="{{ secure_asset('storage/blogs/' . $post->image ?? 'land/images/blog-01.jpg') }}"
                            alt="{{ $post->title }}"
                            style="height: 329px;width: 100%;" />

                        <div class="im h r s df vd yc wg tc wf xf al hh/20 nl il z-10">
                            <a href="{{ route('blog.show', $post->id) }}"
                                class="vc ek rg lk gh sl ml il gi hi">
                                اقرأ المزيد
                            </a>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="yh">

                        <div class="tc uf wf ag jq">

                            <!-- Author -->
                            <div class="tc wf ag">
                                <img src="{{ secure_asset('land/images/icon-man.svg') }}" alt="كاتب" />
                                <p>{{ $post->author }}</p>
                            </div>

                            <!-- Date -->
                            <div class="tc wf ag">
                                <img src="{{ secure_asset('land/images/icon-calender.svg') }}" alt="تاريخ" />
                                <p>{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</p>
                            </div>

                        </div>

                        <!-- Title -->
                        <h4 class="ek tj ml il kk wm xl eq lb">
                            <a href="{{ route('blog.show', $post->id) }}">
                                {{ $post->title }}
                            </a>
                        </h4>

                    </div>

                </div>
                @endforeach

            </div>
        </div>

    </section>

    <!-- ===== Blog End ===== -->

    <!-- ===== Contact Start ===== -->
    <section id="contact" class="i pg fh rm ji gp uq landing-contact" dir="rtl" x-data="{ shown: false }" x-intersect.once="shown = true" style="min-height: 600px; overflow: hidden;">
        <template x-if="shown">
            <div>
                <!-- الأشكال الخلفية - Desktop only for performance -->
                <img src="{{ secure_asset('land/images/shape-03.svg')}}" alt="شكل" class="h ca u ud-hidden md:ud-block" loading="lazy" width="100" height="100" />
                <img src="{{ secure_asset('land/images/shape-07.svg')}}" alt="شكل" class="h w da ee ud-hidden md:ud-block" loading="lazy" width="100" height="100" />
                {{-- shape-12.svg (193KB) & shape-13.svg (95KB) - Desktop only --}}
                <picture class="ud-hidden md:ud-block">
                    <source media="(min-width: 768px)" srcset="{{ secure_asset('land/images/shape-12.svg')}}">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" class="h p s" width="100" height="100" />
                </picture>
                <picture class="ud-hidden md:ud-block">
                    <source media="(min-width: 768px)" srcset="{{ secure_asset('land/images/shape-13.svg')}}">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="" class="h r q" width="100" height="100" />
                </picture>

                <!-- عنوان القسم -->
                <div class="bb ze rj ki xn vq mb en"
                    x-data="{ sectionTitle: `{{ $contactSetting->title ?? 'تواصل معنا' }}`, sectionTitleText: `{{ $contactSetting->description ?? 'نحن متخصصون في تصميم وتنفيذ غرف التبريد والتجميد وأنظمة التكييف المركزي بجودة عالية. تواصل معنا لأي استفسار أو طلب عرض سعر.' }}` }">
                    <div class="animate_top bb ze rj ki xn vq text-center">
                        <h2 x-text="sectionTitle" class="fk vj pr kk wm on/5 gq/2 bb _b"></h2>
                        <p class="bb on/5 wo/5 hq" x-text="sectionTitleText"></p>
                    </div>
                </div>

                <!-- محتوى التواصل -->
                <div class="i va bb ye ki xn wq jb mo">
                    <div class="tc uf sn tf rn un zf xl:gap-10 flex flex-wrap gap-8">

                        <!-- معلومات التواصل -->
                        <div class="animate_top w-full lg:w-1/2 mn/5 to/3 vk sg hh sm yh rq i pg relative contact-info-card">
                            <img src="{{ secure_asset('land/images/shape-03.svg')}}" alt="شكل" class="h la x wd absolute top-0 left-0 ud-hidden md:ud-block" loading="lazy" width="100" height="100" />

                            <div class="fb space-y-6">
                                <div>
                                    <h4 class="wj kk wm cc">البريد الإلكتروني</h4>
                                    <p><a href="mailto:{{ $contactSetting->email ?? '' }}">{{ $contactSetting->email ?? '' }}</a></p>
                                </div>

                                <div>
                                    <h4 class="wj kk wm cc">موقع المكتب</h4>
                                    <p>{{ $contactSetting->address ?? '' }}</p>
                                </div>

                                <div>
                                    <h4 class="wj kk wm cc">رقم الهاتف</h4>
                                    <p><a href="tel:{{ $contactSetting->phone ?? '' }}">{{ $contactSetting->phone  ?? ''}}</a></p>
                                </div>

                                <div>
                                    <h4 class="wj kk wm cc">واتساب الدعم الفني</h4>
                                    <p><a href="https://wa.me/{{ $contactSetting->phone ?? '' }}">اضغط هنا للتحدث الآن</a></p>
                                </div>

                                <div>
                                    <h4 class="wj kk wm qb">تابعنا على</h4>
                                    <ul class="tc wf fg flex gap-4">
                                        @if($contactSetting && $contactSetting->facebook)
                                        <li><a href="{{ $contactSetting->facebook }}" class="c tc wf xf ie ld rg ml il tl" aria-label="فيسبوك"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        @endif
                                        @if($contactSetting && $contactSetting->twitter)
                                        <li><a href="{{ $contactSetting->twitter }}" class="c tc wf xf ie ld rg ml il tl" aria-label="تويتر"><i class="fa-brands fa-x-twitter"></i></a></li>
                                        @endif
                                        @if($contactSetting && $contactSetting->linkedin)
                                        <li><a href="{{ $contactSetting->linkedin }}" class="c tc wf xf ie ld rg ml il tl" aria-label="لينكدإن"><i class="fa-brands fa-linkedin-in"></i></a></li>
                                        @endif
                                        @if($contactSetting && $contactSetting->instagram)
                                        <li><a href="{{ $contactSetting->instagram }}" class="c tc wf xf ie ld rg ml il tl" aria-label="إنستجرام"><i class="fa-brands fa-instagram"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- نموذج التواصل -->
                        <div class="animate_top w-full lg:w-1/2 nn/5 vo/3 vk sg hh sm yh tq contact-form-card">
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="tc sf yo ap zf ep qb">
                                    <div class="vd to/2">
                                        <label class="rc ac" for="fullname">الاسم الكامل</label>
                                        <input type="text" name="fullname" id="fullname" placeholder="أدخل اسمك الكامل"
                                            class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                                    </div>

                                    <div class="vd to/2">
                                        <label class="rc ac" for="email">البريد الإلكتروني</label>
                                        <input type="email" name="email" id="email" placeholder="example@email.com"
                                            class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                                    </div>
                                </div>

                                <div class="tc sf yo ap zf ep qb">
                                    <div class="vd to/2">
                                        <label class="rc ac" for="phone">رقم الهاتف</label>
                                        <input type="text" name="phone" id="phone" placeholder="+20 123 456 7890"
                                            class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                                    </div>

                                    <div class="vd to/2">
                                        <label class="rc ac" for="subject">عنوان الرسالة</label>
                                        <input type="text" name="subject" id="subject" placeholder="استفسار عن غرفة تبريد"
                                            class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
                                    </div>
                                </div>

                                <div class="fb">
                                    <label class="rc ac" for="message">الرسالة</label>
                                    <textarea name="message" id="message" rows="4" placeholder="أدخل رسالتك أو طلبك هنا..."
                                        class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 ci"></textarea>
                                </div>

                                <div class="tc xf mt-4">
                                    <button type="submit" class="vc rg lk gh ml il hi gi _l">إرسال الرسالة</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </template>
    </section>

    <!-- ===== Contact End ===== -->

    <!-- ===== CTA Start ===== -->
    <section class="i pg gh ji landing-cta" dir="rtl" style="text-align:center; min-height: 300px; overflow: hidden;" x-data="{ shown: false }" x-intersect.once="shown = true">
        <template x-if="shown">
            <div>
                <!-- خلفية زخرفية -->
                <img class="h p q ud-hidden md:ud-block" src="{{ secure_asset('land/images/shape-16.svg')}}" alt="شكل زخرفي" loading="lazy" />

                <div class="bb ye i z-10 ki xn dr">
                    <div class="tc uf sn tn un gg">
                        <!-- النص -->
                        <div class="animate_left to/2">
                            <h2 class="fk vj zp pr lk ac">
                                {{ $ctaSection->title ?? 'انضم إلى أكثر من 1000 عميل يثقون بخدماتنا في غرف التبريد والتجميد وأنظمة التكييف.' }}
                            </h2>
                            <p class="lk">
                                {{ $ctaSection->description ?? 'نقدم حلول متكاملة في تصميم وتنفيذ غرف التبريد والتجميد وأنظمة التكييف المركزي للمصانع، المخازن، والمشروعات التجارية بجودة وكفاءة عالية.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </section>
    <!-- ===== CTA End ===== -->
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle smooth scrolling for internal links without adding # to URL
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');

                // Only handle internal anchors, ignore #! or empty hashes
                if (targetId === '#' || targetId === '#!') return;

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();

                    // Smooth scroll to the target
                    const headerOffset = 100; // Account for fixed header
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Clean URL - Remove the hash from address bar
                    if (history.pushState) {
                        history.pushState(null, null, window.location.pathname + window.location.search);
                    }
                }
            });
        });
    });
</script>

@endsection
