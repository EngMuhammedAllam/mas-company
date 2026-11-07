@extends('dashboard.layouts.master')

@section('title', 'تعديل القسم العام')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">تعديل القسم العام</h1>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">المشاريع</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تعديل القسم العام</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">تعديل البيانات العامة</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.projects.section.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">العنوان</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $section->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">الوصف</label>
                                <textarea name="description" class="form-control" rows="5" required>{{ old('description', $section->description) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection