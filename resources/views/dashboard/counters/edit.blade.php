@extends('dashboard.layouts.master')
@section('title')
تعديل العداد
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    تعديل العداد
                </h1>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            تعديل العداد
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.counters.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $counter->id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="number" class="form-label">الرقم (العدد)</label>
                                    <input type="text" class="form-control" id="number" name="number" value="{{ $counter->number }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">العنوان</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $counter->title }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">تحديث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->

@endsection