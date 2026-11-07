@extends('dashboard.layouts.master')

@section('title', 'تعديل الصورة')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    تعديل الصورة
                </h1>
                <span class="fs-semibold text-muted">عدّل بيانات صورة المشروع</span>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text-capitalize">
                            <a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize">
                            <a href="{{ route('projects.index') }}">المشاريع</a>
                        </li>
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">
                            تعديل الصورة
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
                            تعديل صورة: {{ $image->title ?? 'بدون عنوان' }}
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('admin.projects.images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">التصنيف المرتبط</label>
                                <input type="text" class="form-control" value="{{ $image->category->name ?? 'غير محدد' }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الصورة الحالية</label>
                                <div>
                                    <img src="{{ secure_asset('storage/projects/' . $image->image) }}" 
                                         alt="{{ $image->title ?? 'صورة المشروع' }}"
                                         class="img-fluid rounded" style="max-height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">رفع صورة جديدة (اختياري)</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">إذا لم تختار صورة جديدة، ستبقى الصورة القديمة.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">عنوان الصورة (اختياري)</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $image->title) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">ترتيب العرض</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $image->sort_order) }}">
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active', $image->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    تفعيل هذه الصورة
                                </label>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> حفظ التغييرات
                                </button>
                                <a href="{{ route('projects.index') }}" class="btn btn-light">
                                    <i class="ri-arrow-go-back-line me-1"></i> إلغاء
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection