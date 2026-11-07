@extends('dashboard.layouts.master')
@section('title')
العدادات
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    مرحبا بكم في صفحة العدادات
                </h1>
                <span class="fs-semibold text-muted">هنا يمكنك إدارة العدادات</span>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            العدادات
                        </div>
                        <a href="{{ route('admin.counters.create') }}" class="btn btn-primary">اضافة عداد جديد</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" dir="rtl" role="alert">
                            <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                            {{ session('error') }}
                        </div>
                        @endif
                        <table id="file-export" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>الرقم التعريفي</th>
                                    <th>الرقم (العدد)</th>
                                    <th>العنوان</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($counters as $counter)
                                <tr class="product-list">
                                    <td> {{ $counter->id }}</td>
                                    <td>{{ $counter->number }}</td>
                                    <td>{{ $counter->title }}</td>
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <form action="{{ route('admin.counters.edit') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $counter->id }}">
                                                <button type="submit" class="btn btn-icon btn-sm btn-success-light">
                                                    <i class="ri-edit-line"></i>
                                                </button>
                                            </form>
                                            <a class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteCounterModal-{{ $counter->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteCounterModal-{{ $counter->id }}" tabindex="-1" aria-labelledby="deleteCounterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.counters.destroy') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <input type="hidden" name="id" value="{{ $counter->id }}">
                                                    <h5 class="modal-title">حـــــذف العداد</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل أنت متأكد من حذف العداد <strong>{{ $counter->title }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ألغاء</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->

@endsection