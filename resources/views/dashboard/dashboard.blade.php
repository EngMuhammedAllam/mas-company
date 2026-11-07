@extends('dashboard.layouts.master')
@section('title')
الصفحة الرئيسية - غرف التبريد
@endsection
@section('content')
<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    لوحة التحكم - ملخص الموقع
                </h1>
                <span class="fs-semibold text-muted">إليك نظرة عامة على محتوى وإحصائيات موقعك</span>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text-capitalize ">
                            <a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize active " aria-current="page">
                            التقارير
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="detections-page">
            <div class="row">
                <!-- المقالات -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card overflow-hidden border-top-card border-top-primary">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block fw-semibold fs-16 text-capitalize mb-1">
                                        إجمالي المقالات
                                    </span>
                                    <h4 class="fw-bold mb-1">{{ $stats['blog_posts'] }}</h4>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="text-{{ $postsGrowth >= 0 ? 'success' : 'danger' }} fs-12 fw-semibold">
                                            <i class="ri-trending-{{ $postsGrowth >= 0 ? 'up' : 'down' }}-line me-1"></i>
                                            {{ number_format($postsGrowth, 1) }}%
                                        </span>
                                        <span class="text-muted fs-11 ms-1">عن الشهر الماضي</span>
                                    </div>
                                </div>
                                <div class="avatar border-0 bg-primary-transparent text-primary">
                                    <i class="ri-article-line fs-24"></i>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- المشاريع -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card overflow-hidden border-top-card border-top-secondary">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block fw-semibold fs-16 text-capitalize mb-1">
                                        فئات المشاريع
                                    </span>
                                    <h4 class="fw-bold mb-1">{{ $stats['project_categories'] }}</h4>
                                    <span class="text-muted fs-12">إجمالي الفئات المعروضة</span>
                                </div>
                                <div class="avatar border-0 bg-secondary-transparent text-secondary">
                                    <i class="ri-gallery-line fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- الخدمات -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card overflow-hidden border-top-card border-top-success">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block fw-semibold fs-16 text-capitalize mb-1">
                                        إجمالي الخدمات
                                    </span>
                                    <h4 class="fw-bold mb-1">{{ $stats['services'] }}</h4>
                                    <span class="text-muted fs-12">خدمات فعالة على الموقع</span>
                                </div>
                                <div class="avatar border-0 bg-success-transparent text-success">
                                    <i class="ri-service-line fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- رسائل التراسل -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card overflow-hidden border-top-card border-top-warning">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="d-block fw-semibold fs-16 text-capitalize mb-1">
                                        رسائل التواصل
                                    </span>
                                    <h4 class="fw-bold mb-1">{{ $stats['contacts'] }}</h4>
                                    <div class="d-flex align-items-center mt-1">
                                        <span class="text-{{ $contactsGrowth >= 0 ? 'success' : 'danger' }} fs-12 fw-semibold">
                                            <i class="ri-trending-{{ $contactsGrowth >= 0 ? 'up' : 'down' }}-line me-1"></i>
                                            {{ number_format($contactsGrowth, 1) }}%
                                        </span>
                                        <span class="text-muted fs-11 ms-1">عن الشهر الماضي</span>
                                    </div>
                                </div>
                                <div class="avatar border-0 bg-warning-transparent text-warning">
                                    <i class="ri-mail-line fs-24"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- إحصائيات الرسوم البيانية - الصف الأول -->
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">نشاط الرسائل (آخر 6 أشهر)</div>
                        </div>
                        <div class="card-body">
                            <div id="contactsChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">مشاهدات المدونة (آخر 6 أشهر)</div>
                        </div>
                        <div class="card-body">
                            <div id="viewsChart"></div>
                        </div>
                    </div>
                </div>

                <!-- الصف الثاني: توزيع المحتوى والجدول -->
                <div class="col-xl-4">
                    <div class="card custom-card">
                        <div class="card-header">
                            <div class="card-title">توزيع المحتوى</div>
                        </div>
                        <div class="card-body">
                            <div id="distributionChart"></div>
                            <hr>
                            <ul class="list-group list-group-flush mt-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    عدد العملاء
                                    <span class="badge bg-primary rounded-pill">{{ $stats['clients'] }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    آراء العملاء
                                    <span class="badge bg-secondary rounded-pill">{{ $stats['testimonials'] }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    أقسام المدونة
                                    <span class="badge bg-info rounded-pill">{{ $stats['blog_categories'] }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">آخر رسائل التواصل</div>
                            <a href="{{ route('admin.contact.index') }}" class="btn btn-sm btn-primary-light">عرض الكل</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>الأسم</th>
                                            <th>البريد</th>
                                            <th>التاريخ</th>
                                            <th>الرسالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recent_contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->fullname }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <span class="text-muted" title="{{ $contact->message }}">
                                                    {{ \Illuminate\Support\Str::limit($contact->message, 40) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if($recent_contacts->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">لا توجد رسائل حالياً</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- آخر التدوينات في الأسفل أو بجانب شيء آخر -->
                <div class="col-xl-12 mt-2">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title">آخر التدوينات المضافة</div>
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-sm btn-primary-light">إدارة المدونة</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($recent_posts as $post)
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center p-2 border rounded">
                                        <span class="avatar avatar-md me-3">
                                            <img src="{{ asset('storage/blogs/' . $post->image) }}" class="rounded shadow-sm" alt="">
                                        </span>
                                        <div class="flex-fill overflow-hidden">
                                            <p class="fw-semibold mb-0 fs-13 text-truncate">{{ $post->title }}</p>
                                            <span class="text-muted fs-11">{{ $post->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if($recent_posts->isEmpty())
                                <div class="col-12 text-center text-muted">لا توجد مقالات حالياً</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->
@endsection

@push('scripts')
<script>
    // Charts Initialization
    window.addEventListener('load', function() {
        if (typeof ApexCharts === 'undefined') return;

        // 1. Contacts Chart
        var contactsOptions = {
            series: [{
                name: 'الرسائل',
                data: {
                    !!json_encode(array_values($contact_counts)) !!
                }
            }],
            chart: {
                height: 320,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: {
                    !!json_encode(array_values($months)) !!
                },
            },
            colors: ['#3858f9'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            }
        };
        new ApexCharts(document.querySelector("#contactsChart"), contactsOptions).render();

        // 2. Views Chart
        var viewsOptions = {
            series: [{
                name: 'المشاهدات',
                data: {
                    !!json_encode(array_values($view_counts)) !!
                }
            }],
            chart: {
                height: 320,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            xaxis: {
                categories: {
                    !!json_encode(array_values($months)) !!
                },
            },
            colors: ['#27ae60']
        };
        new ApexCharts(document.querySelector("#viewsChart"), viewsOptions).render();

        // 3. Distribution Chart
        var distOptions = {
            series: {
                !!json_encode(array_values($distribution['data'])) !!
            },
            chart: {
                height: 320,
                type: 'donut'
            },
            labels: {
                !!json_encode(array_values($distribution['labels'])) !!
            },
            legend: {
                position: 'bottom'
            },
            colors: ['#3858f9', '#e74c3c', '#27ae60'],
            dataLabels: {
                enabled: false
            }
        };
        new ApexCharts(document.querySelector("#distributionChart"), distOptions).render();
    });
</script>
@endpush