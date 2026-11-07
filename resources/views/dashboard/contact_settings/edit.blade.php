@extends('dashboard.layouts.master')
@section('title')
إعدادات التواصل
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    إعدادات التواصل
                </h1>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            تحديث بيانات التواصل
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" dir="rtl" role="alert">
                            <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('admin.contact-settings.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <h5 class="mb-3">معلومات قسم التواصل</h5>

                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">عنوان القسم</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $setting->title }}" placeholder="تواصل معنا">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">وصف القسم</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="نحن متخصصون في تصميم وتنفيذ غرف التبريد والتجميد...">{{ $setting->description }}</textarea>
                                </div>

                                <h5 class="mt-4 mb-3">معلومات الاتصال</h5>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $setting->email }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $setting->phone }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">العنوان</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $setting->address }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="map_url" class="form-label">رابط الخريطة (Google Map URL)</label>
                                    <input type="text" class="form-control" id="map_url" name="map_url" value="{{ $setting->map_url }}">
                                </div>

                                <h5 class="mt-4 mb-3">وسائل التواصل الاجتماعي</h5>

                                <div class="col-md-6 mb-3">
                                    <label for="facebook" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $setting->facebook }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="twitter" class="form-label">Twitter</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $setting->twitter }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $setting->instagram }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="linkedin" class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $setting->linkedin }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->

@endsection