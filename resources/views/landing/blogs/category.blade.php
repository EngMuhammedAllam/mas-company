@extends('landing.layouts.master' , ['page' => 'blog-single'])

@section('title')
    {{ config('app.name') }}
@endsection

@section('content')

<section class="gj qp gr hj rp hr">
    <div class="bb ze ki xn 2xl:ud-px-0">
        {{-- هنا نستخدم نفس الكلاسات الموجودة في الصفحة الأخرى لضمان التنسيق المتماثل --}}
        <div class="tc sf yo zf kq">

            <div class="ro">
                {{-- نستخدم نفس إطار التظليل واللون الأبيض ليكون المحتوى بارزاً --}}
                <div class="animate_top rounded-md shadow-solid-13 bg-white dark:bg-blacksection border border-stroke dark:border-strokedark p-7.5 md:p-10">

                    {{-- العنوان --}}
                    <h2 class="ek vj 2xl:ud-text-title-lg kk wm nb gb mb-8">
                        مقالات تحت فئة: {{ $category->name }}
                    </h2>

                    {{-- شبكة المقالات --}}
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                        @forelse($posts as $post)
                            {{-- تنسيق بطاقة المقال (تم تحسينها لتناسب الشكل الجديد) --}}
                            <div class="bg-white dark:bg-blacksection overflow-hidden rounded-md border border-stroke dark:border-strokedark shadow-lg hover:shadow-xl transition-shadow duration-300">

                                {{-- الصورة --}}
                                <a href="{{ route('blog.show', $post->id) }}">
                                    <img src="{{ secure_asset('storage/blogs/' . $post->image) }}" 
                                         class="w-full object-cover" 
                                         alt="{{ $post->title }}" 
                                         style="height: 450px !important; width: 80% !important;" />
                                </a>

                                <div class="p-4 md:p-6">
                                    {{-- العنوان --}}
                                    <h3 class="mt-2 text-xl font-bold dark:text-white hover:text-primary transition-colors">
                                        <a href="{{ route('blog.show', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h3>

                                    {{-- الملخص --}}
                                    <p class="text-gray-600 dark:text-gray-400 mt-2 line-clamp-2">{{ $post->excerpt }}</p>

                                    {{-- الميتا (المؤلف والتاريخ) --}}
                                    <div class="mt-4 pt-3 border-t border-stroke dark:border-strokedark text-sm text-gray-500 dark:text-gray-400 tc wf fb">
                                        <span class="rc kk wm">{{ $post->author }}</span>
                                        <span>•</span>
                                        <span>{{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}</span>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p class="text-xl text-center col-span-full py-10">لا توجد مقالات في هذه الفئة حالياً.</p>
                        @endforelse

                    </div>

                    {{-- Pagination الترقيم --}}
                    <div class="mt-10">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>

            <div class="jn/2 so">
                
                {{-- قسم الفئات (Categories) --}}
                <div class="animate_top fb rounded-md shadow-solid-13 bg-white dark:bg-blacksection border border-stroke dark:border-strokedark p-6">
                    <h4 class="tj kk wm qb border-b border-stroke dark:border-strokedark pb-3 mb-4">الفئات</h4>
                    <ul>
                        @foreach($categories as $cat)
                            <li class="ql vb il xl py-1 hover:text-primary transition-colors">
                                <a href="{{ route('blog.category', $cat->id) }}">{{ $cat->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- هنا يمكنك إضافة قسم "البحث" أو "المقالات ذات الصلة" إذا أردت --}}
                {{-- يمكنك نسخ ولصق قسم البحث من الصفحة الأخرى هنا --}}
                {{--
                <div class="animate_top fb mt-8">
                    <form action="{{ route('blog.index') }}" method="GET">
                        <div class="i">
                            <input type="text" name="q" placeholder="ابحث عن مقال..."
                                class="vd sm _g ch pm vk xm rg gm dm/40 dn/40 li mi" />
                        </div>
                    </form>
                </div>
                --}}
                
            </div>
            
        </div>
    </div>
</section>
@endsection