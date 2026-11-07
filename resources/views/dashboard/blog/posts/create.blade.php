@extends('dashboard.layouts.master')
@section('title')
إضافة مقال جديد
@endsection
@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">إضافة مقال جديد</h1>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-xl-6">
                                    <label for="title" class="form-label">العنوان</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                                <div class="col-xl-6">
                                    <label for="blog_category_id" class="form-label">الفئة</label>
                                    <select name="blog_category_id" id="blog_category_id" class="form-control" required>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6">
                                    <label for="author" class="form-label">الكاتب</label>
                                    <input type="text" name="author" id="author" class="form-control">
                                </div>
                                <div class="col-xl-6">
                                    <label for="published_at" class="form-label">تاريخ النشر</label>
                                    <input type="date" name="published_at" id="published_at" class="form-control">
                                </div>
                                <div class="col-xl-12">
                                    <label for="content" class="form-label">المحتوى</label>
                                    <textarea name="content" id="content" class="form-control" rows="10" required></textarea>
                                </div>
                                <div class="col-xl-6">
                                    <label for="image" class="form-label">الصورة</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                                <div class="col-xl-6">
                                    <label for="is_active" class="form-label">الحالة</label>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option value="1">نشط</option>
                                        <option value="0">غير نشط</option>
                                    </select>
                                </div>
                                <div class="col-xl-12 mt-4">
                                    <button type="submit" class="btn btn-primary">حفظ المقال</button>
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