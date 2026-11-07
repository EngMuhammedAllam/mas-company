@extends('dashboard.layouts.master')
@section('title')
إضافة عميل جديد
@endsection
@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">إضافة عميل جديد</h1>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-xl-6">
                                    <label for="name" class="form-label">اسم العميل (اختياري)</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="اسم العميل">
                                </div>
                                <div class="col-xl-6">
                                    <label for="link" class="form-label">رابط الموقع (اختياري)</label>
                                    <input type="url" name="link" id="link" class="form-control" placeholder="https://example.com">
                                </div>
                                <div class="col-xl-12">
                                    <label for="image" class="form-label">شعار العميل</label>
                                    <input type="file" name="image" id="image" class="form-control" required>
                                </div>
                                <div class="col-xl-12 mt-4">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection