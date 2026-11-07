@extends('dashboard.layouts.master')
@section('title')
المقالات
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    كافة المقالات
                </h1>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">المقالات</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">قائمة المقالات</div>
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">إضافة مقال جديد</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <table class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>العنوان</th>
                                    <th>الكاتب</th>
                                    <th>الفئة</th>
                                    <th>تاريخ النشر</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->author }}</td>
                                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                                    <td>{{ $post->published_at }}</td>
                                    <td>
                                        <span class="badge {{ $post->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $post->is_active ? 'نشط' : 'غير نشط' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2">
                                            <form action="{{ route('admin.posts.edit') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-icon btn-sm btn-success-light">
                                                    <i class="ri-edit-line"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.posts.destroy') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-icon btn-sm btn-danger-light" onclick="return confirm('هل أنت متأكد؟')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection