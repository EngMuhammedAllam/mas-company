@extends('dashboard.layouts.master')

@section('title')
تعديل التقييم   
@endsection

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">تعديل التقييم</h1>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">آراء العملاء</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تعديل التقييم</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">تعديل: {{ $testimonial->name }}</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">اسم العميل <sup class="text-danger">*</sup></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $testimonial->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوظيفة / الشركة (اختياري)</label>
                                <input type="text" name="position" class="form-control" value="{{ old('position', $testimonial->position) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">التقييم / الاقتباس <sup class="text-danger">*</sup></label>
                                <textarea name="message" class="form-control" rows="4" required>{{ old('message', $testimonial->message) }}</textarea>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">ترتيب العرض</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $testimonial->sort_order) }}" min="0">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active', $testimonial->active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    تفعيل التقييم (إظهاره في الموقع)
                                </label>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('testimonials.index') }}" class="btn btn-light">
                                    <i class="ri-arrow-go-back-line me-1"></i> إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection