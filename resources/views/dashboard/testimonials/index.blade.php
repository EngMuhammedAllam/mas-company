@extends('dashboard.layouts.master')

@section('title', 'إدارة آراء العملاء')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">إدارة آراء العملاء</h1>
                <span class="fs-semibold text-muted">تعديل العنوان العام وإدارة التقييمات الفردية</span>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">آراء العملاء</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End::page-header -->

        <!-- القسم العام -->
        <div class="row mb-4">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">العنوان والوصف العام</div>
                        <a href="{{ route('section_testimonials.edit', $sectionTestimonial->id) }}" class="btn btn-warning btn-sm">
                            <i class="ri-edit-line me-1"></i> تعديل القسم العام
                        </a>
                    </div>
                    <div class="card-body">
                        @if($sectionTestimonial)
                            <p><strong>العنوان:</strong> {{ $sectionTestimonial->title }}</p>
                            <p><strong>الوصف:</strong> {{ $sectionTestimonial->description }}</p>
                        @else
                            <p class="text-muted">لم يتم إدخال بيانات القسم العام بعد.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول الآراء -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">قائمة التقييمات</div>
                        <a href="{{ route('testimonials.create') }}" class="btn btn-primary btn-sm">
                            <i class="ri-add-line me-1"></i> إضافة تقييم جديد
                        </a>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($testimonials->isEmpty())
                            <div class="text-center py-4">
                                <i class="ri-quote-left-line fs-40 text-muted"></i>
                                <p class="mt-2 text-muted">لا توجد تقييمات حتى الآن.</p>
                            </div>
                        @else
                            <table id="file-export"  class="table table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>الوظيفة</th>
                                        <th>التقييم</th>
                                        <th>الصورة</th>
                                        <th>الترتيب</th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->position }}</td>
                                            <td>{{ Str::limit($testimonial->quote, 30) }}</td>
                                            <td>
                                                @if($testimonial->image)
                                                    <img src="{{ secure_asset('storage/testimonials/' . $testimonial->image) }}" alt="صورة العميل" class="avatar avatar-sm">
                                                @else
                                                    <span class="badge bg-secondary">بدون صورة</span>
                                                @endif
                                            </td>
                                            <td>{{ $testimonial->sort_order }}</td>
                                            <td>
                                                @if($testimonial->active == 1)
                                                    <span class="badge bg-success">نشط</span>
                                                @else
                                                    <span class="badge bg-danger">معطل</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 fs-15">
                                                    <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-icon btn-sm btn-success-light">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $testimonial->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal-{{ $testimonial->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">حذف التقييم</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل أنت متأكد من حذف تقييم "<strong>{{ $testimonial->name }}</strong>"؟
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                            <button type="submit" class="btn btn-danger">حذف</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection