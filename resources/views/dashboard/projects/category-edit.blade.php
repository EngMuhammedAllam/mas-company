@extends('dashboard.layouts.master')

@section('title', 'تعديل التصنيف')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    تعديل التصنيف
                </h1>
                <span class="fs-semibold text-muted">عدّل بيانات تصنيف المشاريع</span>
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
                            تعديل التصنيف
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
                            تعديل تصنيف: {{ $category->name }}
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.projects.categories.update' , $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <div class="mb-3">
                                <label class="form-label">اسم التصنيف <sup class="text-danger">*</sup>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Slug (للرابط الداخلي) <sup class="text-danger">*</sup>
                                @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}">
                                <small class="text-muted">يُستخدم في فلترة المشاريع (مثال: cooling، ac)</small>
                            </div>


                            <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" 
                                   id="is_active" {{ $category->is_active ? 'checked' : '' }}>   
                             <label class="form-check-label" for="is_active">
                                    تفعيل هذا التصنيف
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