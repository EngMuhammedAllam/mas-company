@extends('dashboard.layouts.master')

@section('title', 'تعديل القسم العام للخدمات')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    تعديل القسم العام
                </h1>
                <span class="fs-semibold text-muted">عدّل العنوان والوصف الرئيسيين لقسم الخدمات</span>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text-capitalize">
                            <a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize">
                            <a href="{{ route('section_services.index') }}">خدمات التبريد والتكييف</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">
                            تعديل القسم العام
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            تعديل العنوان والوصف
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('section_services.update', $serviceSection->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">العنوان الرئيسي <sup class="text-danger">*</sup></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $serviceSection->title) }}" required dir="rtl">
                                <small class="text-muted">يظهر أعلى قسم الخدمات في الصفحة الرئيسية</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوصف الرئيسي <sup class="text-danger">*</sup></label>
                                <textarea name="description" class="form-control" rows="5" required dir="rtl">{{ old('description', $serviceSection->description) }}</textarea>
                                <small class="text-muted">وصف يلخص طبيعة الخدمات المقدمة</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('section_services.index') }}" class="btn btn-light">
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