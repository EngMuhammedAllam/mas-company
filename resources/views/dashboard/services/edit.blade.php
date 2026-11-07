@extends('dashboard.layouts.master')

@section('title', 'تعديل الخدمة')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    تعديل الخدمة
                </h1>
                <span class="fs-semibold text-muted">عدّل بيانات الخدمة الفردية</span>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text-capitalize">
                            <a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize">
                            <a href="{{ route('services.index') }}">خدمات التبريد والتكييف</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">
                            تعديل الخدمة
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
                            تعديل: {{ $service->title }}
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

                        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">عنوان الخدمة <sup class="text-danger">*</sup></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required dir="rtl" placeholder="مثال: الصيانة الدورية">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">وصف الخدمة <sup class="text-danger">*</sup></label>
                                <textarea name="description" class="form-control" rows="4" required dir="rtl" placeholder="اشرح الخدمة بشكل مختصر">{{ old('description', $service->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الأيقونة <sup class="text-danger">*</sup></label>
                                <input type="file" name="icon" class="form-control" dir="rtl">
                               <img src="{{ secure_asset('storage/' . $service->icon)}}" class="m-2" alt="تصميم الأنظمة" width="200"/>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ترتيب العرض</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order) }}" min="0" dir="ltr" placeholder="0">
                                <small class="text-muted">الأقل قيمة يظهر أولًا</small>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    تفعيل الخدمة (إظهارها في الموقع)
                                </label>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('services.index') }}" class="btn btn-light">
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