@extends('dashboard.layouts.master')
@section('title')
قسم CTA
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    قسم CTA
                </h1>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            تحديث بيانات قسم CTA
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" dir="rtl" role="alert">
                            <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('admin.cta.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">العنوان</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $cta->title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">الوصف</label>
                                    <textarea class="form-control" id="description" name="description" rows="5">{{ $cta->description }}</textarea>
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