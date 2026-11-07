@extends('dashboard.layouts.master')
@section('title')
تعديل العميل
@endsection
@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">تعديل بيانات العميل</h1>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ route('admin.clients.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $client->id }}">
                            <div class="row gy-4">
                                <div class="col-xl-6">
                                    <label for="name" class="form-label">اسم العميل (اختياري)</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $client->name }}" placeholder="اسم العميل">
                                </div>
                                <div class="col-xl-6">
                                    <label for="link" class="form-label">رابط الموقع (اختياري)</label>
                                    <input type="url" name="link" id="link" class="form-control" value="{{ $client->link }}" placeholder="https://example.com">
                                </div>
                                <div class="col-xl-12">
                                    <label for="image" class="form-label">شعار العميل</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $client->image) }}" alt="Current Logo" style="width: 100px; height: 100px; object-fit: contain;">
                                    </div>
                                </div>
                                <div class="col-xl-12 mt-4">
                                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
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