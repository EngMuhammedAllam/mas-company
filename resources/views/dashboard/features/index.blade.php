@extends('dashboard.layouts.master')
@section('title')
    الميزات
@endsection
@section('content')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::page-header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div>
                        <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                            مرحبا بكم في صفحة الميزات 
                        </h1>
                        <span class="fs-semibold text-muted">هنا يمكنك رؤية الميزات </span>
                    </div>
                    <div class="ms-md-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item text-capitalize ">
                                    <a href="index.html">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item text-capitalize active " aria-current="page">
                                    الميزات 
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
                                    الـمـــيـزات
                                </div>
                                <a href="{{ route('features.create') }}" class="btn btn-primary">اضافة مــيـزة جديد</a>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" dir="rtl" role="alert">
                                        <i class="ri-close-line"  data-bs-dismiss="alert" aria-label="Close"></i>
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
                                            <th>
                                                <input class="form-check-input check-all" type="checkbox" id="all-products" value="" aria-label="...">
                                            </th>
                                            <th>الرقم التعريفي</th>
                                            <th>العنوان</th>
                                            <th>الوصف</th>
                                            <th>الصورة</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features as $feature)
                                           <tr class="product-list">
                                            <td class="product-checkbox">
                                                <input class="form-check-input" type="checkbox" id="product20" value="21" aria-label="...">
                                            </td>
                                            <td> {{ $feature->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center fw-semibold">
                                                    <span class="text-truncate">{{ $feature->title }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $feature->description }}</td>
                                            <td>
                                                 <img src="{{ secure_asset('storage/'.$feature->image)}}" style="background-color: #000;" class="avatar avatar-md">
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 fs-15">
                                                    <form action="{{ route('features.edit', $feature->id) }}" method="get">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $feature->id }}">
                                                        <button type="submit" class="btn btn-icon btn-sm btn-success-light">
                                                            <i class="ri-edit-line"></i>
                                                        </button>
                                                    </form>
                                                    <a class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteUserModal-{{ $feature->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </a>
                                                </div>
                                            </td>
                
                                        </tr>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteUserModal-{{ $feature->id }}" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('features.destroy', $feature->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">حـــــذف الميزة</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                             هل أنت متأكد من حذف الميزة <strong>{{ $feature->name }}</strong>?
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