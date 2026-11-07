    @extends('landing.layouts.master' , ['page' => 'blog-single'])

    @section('title', $post->title)
    @section('meta_description', \Illuminate\Support\Str::limit(strip_tags($post->content), 160))
    @section('meta_keywords', $post->category->name ?? '')
    @section('og_type', 'article')
    @section('og_title', $post->title)
    @section('og_description', \Illuminate\Support\Str::limit(strip_tags($post->content), 160))
    @section('og_image', secure_asset('storage/blogs/' . $post->image))
    @section('twitter_title', $post->title)
    @section('twitter_description', \Illuminate\Support\Str::limit(strip_tags($post->content), 160))

    @push('head_scripts')
    <!-- Schema.org JSON-LD - Article -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "headline": "{{ $post->title }}",
            "image": [
                "{{ secure_asset('storage/blogs/' . $post->image) }}"
            ],
            "datePublished": "{{ \Carbon\Carbon::parse($post->published_at)->toIso8601String() }}",
            "dateModified": "{{ \Carbon\Carbon::parse($post->updated_at)->toIso8601String() }}",
            "author": {
                "@type": "Person",
                "name": "{{ $post->author ?? 'Admin' }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "{{ config('app.name') }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset('land/images/logo.png') }}"
                }
            },
            "description": "{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}",
            "articleSection": "{{ $post->category->name ?? 'General' }}",
            "articleBody": "{{ strip_tags($post->content) }}"
        }
    </script>
    @endpush

    @section('content')

    <!-- ===== Blog Single Start ===== -->
    <section class="gj qp gr hj rp hr">
        <div class="bb ze ki xn 2xl:ud-px-0">
            <div class="tc sf yo zf kq">

                <!-- Main Content -->
                <div class="ro">
                    <div class="animate_top rounded-md shadow-solid-13 bg-white dark:bg-blacksection border border-stroke dark:border-strokedark p-7.5 md:p-10">

                        <!-- Main Image -->
                        <img loading="lazy" src="{{ secure_asset('storage/blogs/' . ($post->image ?? 'land/images/blog-01.jpg')) }}" alt="{{ $post->title }}" style="height: 500px !important;width: 100% !important;" />

                        <!-- Title -->
                        <h2 class="ek vj 2xl:ud-text-title-lg kk wm nb gb">
                            {{ $post->title }}
                        </h2>

                        <!-- Meta -->
                        <ul class="tc uf cg 2xl:ud-gap-15 fb">
                            <li><span class="rc kk wm">المحرر: </span> {{ $post->author }}</li>
                            <li><span class="rc kk wm">تاريخ النشر: </span> {{ \Carbon\Carbon::parse($post->published_at)->format('d F Y') }}</li>
                            <li><span class="rc kk wm">التصنيف: </span>{{ $post->category->name ?? 'غير مصنف' }}li>
                        </ul>

                        <!-- Content -->
                        <p>{!! nl2br(e($post->content)) !!}</p>

                        <!-- Sub Images (لو عندك صور إضافية) -->
                        @if($post->sub_images ?? false)
                        <div class="wc qf pn dg cb">
                            @foreach($post->sub_images as $img)
                            <img src="{{ secure_asset($img) }}" alt="Blog" />
                            @endforeach
                        </div>
                        @endif

                        <!-- Share -->
                        <h2 class="ek vj 2xl:ud-text-title-lg kk wm nb qb">شارك المقال</h2>

                        <ul class="tc wf bg sb">
                            <li>
                                <p class="sj kk wm tb">شارك عبر:</p>
                            </li>

                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    class="tc wf xf yd ad rg ml il ih wk" aria-label="فيسبوك">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_47_28)">
                                            <path
                                                d="M11.6663 11.25H13.7497L14.583 7.91663H11.6663V6.24996C11.6663 5.39163 11.6663 4.58329 13.333 4.58329H14.583V1.78329C14.3113 1.74746 13.2855 1.66663 12.2022 1.66663C9.93967 1.66663 8.33301 3.04746 8.33301 5.58329V7.91663H5.83301V11.25H8.33301V18.3333H11.6663V11.25Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_28">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}"
                                    class="tc wf xf yd ad rg ml il jh wk" aria-label="تويتر">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_47_47)">
                                            <path
                                                d="M18.4683 4.71327C17.8321 4.99468 17.1574 5.1795 16.4666 5.26161C17.1947 4.82613 17.7397 4.14078 17.9999 3.33327C17.3166 3.73994 16.5674 4.02494 15.7866 4.17911C15.2621 3.61792 14.5669 3.24574 13.809 3.12043C13.0512 2.99511 12.2732 3.12368 11.596 3.48615C10.9187 3.84862 10.3802 4.42468 10.0642 5.12477C9.74812 5.82486 9.67221 6.60976 9.84825 7.35744C8.46251 7.28798 7.10686 6.92788 5.86933 6.30049C4.63179 5.67311 3.54003 4.79248 2.66492 3.71577C2.35516 4.24781 2.19238 4.85263 2.19326 5.46827C2.19326 6.67661 2.80826 7.74411 3.74326 8.36911C3.18993 8.35169 2.64878 8.20226 2.16492 7.93327V7.97661C2.16509 8.78136 2.44356 9.56129 2.95313 10.1842C3.46269 10.807 4.17199 11.2345 4.96075 11.3941C4.4471 11.5333 3.90851 11.5538 3.38576 11.4541C3.60814 12.1468 4.04159 12.7526 4.62541 13.1867C5.20924 13.6208 5.9142 13.8614 6.64159 13.8749C5.91866 14.4427 5.0909 14.8624 4.20566 15.1101C3.32041 15.3577 2.39503 15.4285 1.48242 15.3183C3.0755 16.3428 4.93 16.8867 6.82409 16.8849C13.2349 16.8849 16.7408 11.5741 16.7408 6.96827C16.7408 6.81827 16.7366 6.66661 16.7299 6.51827C17.4123 6.02508 18.0013 5.41412 18.4691 4.71411L18.4683 4.71327Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_47">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}"
                                    class="tc wf xf yd ad rg ml il kh wk" aria-label="لينكدإن">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_47_53)">
                                            <path
                                                d="M5.78353 4.16665C5.78331 4.60867 5.6075 5.03251 5.29478 5.34491C4.98207 5.65732 4.55806 5.8327 4.11603 5.83248C3.674 5.83226 3.25017 5.65645 2.93776 5.34373C2.62536 5.03102 2.44997 4.60701 2.4502 4.16498C2.45042 3.72295 2.62622 3.29912 2.93894 2.98671C3.25166 2.67431 3.67567 2.49892 4.1177 2.49915C4.55972 2.49937 4.98356 2.67517 5.29596 2.98789C5.60837 3.30061 5.78375 3.72462 5.78353 4.16665ZM5.83353 7.06665H2.5002V17.5H5.83353V7.06665ZM11.1002 7.06665H7.78353V17.5H11.0669V12.025C11.0669 8.97498 15.0419 8.69165 15.0419 12.025V17.5H18.3335V10.8916C18.3335 5.74998 12.4502 5.94165 11.0669 8.46665L11.1002 7.06665Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_53">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>

                <!-- Sidebar -->
                <div class="jn/2 so">

                    <!-- Search -->
                    <div class="animate_top fb">
                        <form action="" method="GET">
                            <div class="i">
                                <input type="text" name="q" placeholder="ابحث عن مقال..."
                                    class="vd sm _g ch pm vk xm rg gm dm/40 dn/40 li mi" />
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="animate_top fb">
                        <h4 class="tj kk wm qb">الفئات</h4>

                        <ul>
                            @foreach($categories as $cat)
                            <li class="ql vb du-ease-in-out il xl">
                                <a href="{{ route('blog.category', $cat->id) }}">{{ $cat->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Related Posts -->
                    <div class="animate_top">
                        <h4 class="tj kk wm qb">مشاركات ذات صلة</h4>

                        <div>
                            @foreach($relatedPosts as $related)
                            <div class="tc fg 2xl:ud-gap-6 qb">
                                <img src="{{ secure_asset('storage/blogs/' . $related->image) }}" alt="{{ $related->title }}" style="height: 100px !important;width: 100px !important;" />
                                <h5 class="wj kk wm xl bn ml il">
                                    <a href="{{ route('blog.show', $related->id) }}">
                                        {{ $related->title }}
                                    </a>
                                </h5>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- ===== Blog Single End ===== -->

    <!-- ===== CTA End ===== -->

    {{-- <script defer src="{{ secure_asset('land/bundle.js') }}"></script> --}}

    @endsection