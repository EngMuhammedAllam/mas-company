@extends('dashboard.layouts.master')
@section('title')
من نحن
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    من نحن
                </h1>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            تحديث بيانات "من نحن"
                        </div>
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

                        <form action="{{ route('admin.about.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="title" class="form-label">العنوان</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $about->title }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description" class="form-label">الوصف</label>
                                    <textarea class="form-control" id="description" name="description" rows="5">{{ $about->description }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="video_url" class="form-label">رابط الفيديو</label>
                                    <input type="text" class="form-control" id="video_url" name="video_url" value="{{ $about->video_url }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="image1" class="form-label">الصورة 1</label>
                                    <input type="file" class="form-control" id="image1" name="image1">
                                    @if($about->image1)
                                    <img src="{{ asset('storage/' . $about->image1) }}" alt="Image 1" width="100" class="mt-2">
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="image2" class="form-label">الصورة 2</label>
                                    <input type="file" class="form-control" id="image2" name="image2">
                                    @if($about->image2)
                                    <img src="{{ asset('storage/' . $about->image2) }}" alt="Image 2" width="100" class="mt-2">
                                    @endif
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="image3" class="form-label">الصورة 3</label>
                                    <input type="file" class="form-control" id="image3" name="image3">
                                    @if($about->image3)
                                    <img src="{{ asset('storage/' . $about->image3) }}" alt="Image 3" width="100" class="mt-2">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </form>

                        <hr>

                        <h5 class="mb-3">نقاط "من نحن"</h5>

                        <form action="{{ route('admin.about.points.store') }}" method="post" class="mb-4">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="content" placeholder="أضف نقطة جديدة" required>
                                <button class="btn btn-outline-primary" type="submit">إضافة</button>
                            </div>
                        </form>

                        <ul class="list-group">
                            @foreach($points as $point)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $point->content }}
                                <form action="{{ route('admin.about.points.destroy', $point->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->

@endsection