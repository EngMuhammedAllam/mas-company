@extends('dashboard.layouts.master')

@section('title', 'تعديل القسم العام للآراء')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">تعديل القسم العام</h1>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('testimonials.index') }}">آراء العملاء</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تعديل القسم العام</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">تعديل العنوان والوصف</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('section_testimonials.update' , $sectionTestimonial->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">العنوان الرئيسي <sup class="text-danger">*</sup></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $sectionTestimonial->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوصف الرئيسي <sup class="text-danger">*</sup></label>
                                <textarea name="description" class="form-control" rows="4" required>{{ old('description', $sectionTestimonial->description) }}</textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('testimonials.index') }}" class="btn btn-light">
                                    <i class="ri-arrow-go-back-line me-1"></i> العودة إلى القائمة
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