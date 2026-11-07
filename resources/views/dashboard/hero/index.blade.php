@extends('dashboard.layouts.master')
@section('title')
    Hero Section
@endsection
@section('content')

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::page-header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div>
                        <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                            مرحبا بكم في صفحة تعديل العنوان 
                        </h1>
                        <span class="fs-semibold text-muted">هنا يمكنك تعديل البانر الرئيسي </span>
                    </div>
                    <div class="ms-md-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item text-capitalize ">
                                    <a href="index.html">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item text-capitalize active " aria-current="page">
                                    تعديل العنوان
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- End::page-header -->
                <div class="students-list-page">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">
                                       تعديل العنوان الرئيسي
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('admin.hero.update', $heroSection->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label">العنوان<sup><i
                                                            class="ri-star-s-fill text-success fs-8"></i></sup></label>
                                                <input type="text" class="form-control" id="toTitle" name="title" value="{{$heroSection->title}}"
                                                    placeholder="أدخل العنوان">
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                        <div class="col-xl-3">
                                            <label class="form-label">
                                                الصورة
                                                <sup><i class="ri-star-s-fill text-success fs-8"></i></sup>
                                            </label>

                                            <div class="border rounded-2 p-2 position-relative" style="min-height: 150px;">
                                                @if(isset($heroSection) && $heroSection->image)
                                                    <!-- عرض الصورة الحالية -->
                                                    <img src="{{ secure_asset('storage/' . $heroSection->image) }}" alt="الصورة الحالية"
                                                        class="img-fluid rounded mb-2"
                                                        style="max-height: 120px; width: 100%; object-fit: cover;">
                                                @else
                                                    <div class="text-muted small">لا توجد صورة</div>
                                                @endif

                                                <!-- حقل رفع صورة جديدة (مخفي بصريًا أو ظاهر حسب التصميم) -->
                                                <input type="file"
                                                    name="image" id="image" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                            <div class="col-xl-9">
                                                <label for="text-area" class="form-label">الوصف</label>
                                                <textarea class="form-control" id="text-area" rows="1"
                                                    style="height: 178px;" name="description">{{$heroSection->description}}</textarea>
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
        </div>
        <!-- End::app-content -->

@endsection