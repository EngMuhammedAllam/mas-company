@extends('dashboard.layouts.master')

@section('title', 'إضافة صورة جديدة')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">إضافة صورة جديدة لتصنيف: {{ $category->name }}</h1>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">المشاريع</a></li>
                        <li class="breadcrumb-item active" aria-current="page">إضافة صورة</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">بيانات الصورة</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.projects.images.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <div class="mb-3">
                                <label class="form-label">الصورة
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </label>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">عنوان الصورة (اختياري)
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ترتيب العرض
                                @error('sort_order')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">رفع الصورة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection