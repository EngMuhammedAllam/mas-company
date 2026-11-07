@extends('dashboard.layouts.master')
@section('title')
    أضـــــافــة مـــيـزة
@endsection
@section('content')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::page-header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div>
                        <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                            مرحبا بكم في صفحة أضافة مـــيزة جديـــدة 
                        </h1>
                        <span class="fs-semibold text-muted">هنا يمكنك ائضافة ميزة جديدة   </span>
                    </div>
                    <div class="ms-md-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item text-capitalize ">
                                    <a href="index.html">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item text-capitalize active " aria-current="page">
                                    اضافة ميزة 
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
                                    اضافة ميزة  
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('features.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">العنوان 
                                                    @error('title')
                                                       <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </label>
                                                <input type="text" class="form-control" name="title" placeholder="أدخل العنوان !">
                                            </div>
                                        </div>   
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">الوصف
                                                    @error('description')
                                                       <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </label>
                                                <input type="text" class="form-control" name="description" placeholder="ادخل الوصف">
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">الصورة</label>
                                                <input type="file" class="form-control" name="image" alt="أضافة صورة">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="buttons d-flex gap-2 mt-2">
                                        <button type="submit" class="btn btn-primary btn-wave btn-sm">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
        <!-- End::app-content -->

@endsection