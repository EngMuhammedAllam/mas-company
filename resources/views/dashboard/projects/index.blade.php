@extends('dashboard.layouts.master')

@section('title')
    إدارة المشاريع
@endsection

@section('content')

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Start::page-header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div>
                    <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                        مرحباً بك في صفحة إدارة المشاريع
                    </h1>
                    <span class="fs-semibold text-muted">هنا يمكنك إدارة أقسام وصور المشاريع</span>
                </div>
                <div class="ms-md-1 ms-0">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item text-capitalize">
                                <a href="{{ route('dashboard') }}">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item text-capitalize active" aria-current="page">
                                المشاريع
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End::page-header -->

            <div class="row mb-4">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title text-capitalize">
                                العنوان والوصف العام
                            </div>
                            <form action="{{ route('admin.projects.section.edit') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="ri-edit-line me-1"></i> تعديل القسم العام
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            @if($section)
                                <p><strong>العنوان:</strong> {{ $section->title }}</p>
                                <p><strong>الوصف:</strong> {{ $section->description }}</p>
                            @else
                                <p class="text-muted">لم يتم إدخال بيانات القسم العام بعد.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- التصنيفات والصور -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-header justify-content-between">
                            <div class="card-title text-capitalize">
                                تصنيفات المشاريع
                            </div>
                            <a href="{{ route('admin.projects.categories.create') }}" class="btn btn-primary btn-sm">
                                <i class="ri-add-line me-1"></i> اضافة تصنيف جديد
                            </a>
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

                            @forelse ($categories as $category)
                                <div class="mb-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0">{{ $category->name }}</h5>
                                            <div class="d-flex align-items-center gap-2">
                                                
                                                <a href="{{ route('admin.projects.images.create' , $category->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="ri-image-add-line"></i> اضافة صور
                                                </a>

                                                <a href="{{ route('admin.projects.categories.edit', $category->id) }}"  class="btn btn-sm btn-outline-warning">
                                                        <i class="ri-edit-line"></i>
                                                </a>

                                                <button type="button" class="btn btn-icon btn-sm btn-danger-light"
                                                 data-bs-toggle="modal" data-bs-target="#deleteCategoryModal-{{ $category->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                </a>    
                                            </div>
                                    </div>

                                    @if($category->images->count() > 0)
                                        <div class="row">
                                            @foreach($category->images as $image)
                                                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                    <div class="border rounded p-2 text-center">
                                                        <img src="{{ secure_asset('storage/projects/' . $image->image) }}" 
                                                             alt="{{ $image->title ?? $category->name }}"
                                                             class="img-fluid rounded mb-2"
                                                             style="height: 150px; object-fit: cover; width: 100%;">
                                                        <p class="small mb-1">{{ $image->title ?? 'بدون عنوان' }}</p>
                                                        <div class="d-flex justify-content-center gap-1">
                                                            <a href="{{ route('admin.projects.images.edit', $image->id) }}" class="btn btn-icon btn-sm btn-success-light">
                                                                <i class="ri-edit-line"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteImageModal-{{ $image->id }}">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted">لا توجد صور لهذا التصنيف.</p>
                                    @endif
                                </div>

                                <!-- Delete Category Modal -->
                                <div class="modal fade" id="deleteCategoryModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.projects.categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف التصنيف</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل أنت متأكد من حذف تصنيف "<strong>{{ $category->name }}</strong>"؟
                                                    <br><small class="text-danger">سيتم حذف جميع الصور المرتبطة بهذا التصنيف أيضًا.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                 <div class="modal fade" id="deleteCategoryModal-{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.projects.categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف التصنيف</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل أنت متأكد من حذف تصنيف "<strong>{{ $category->name }}</strong>"؟
                                                    <br><small class="text-danger">سيتم حذف جميع الصور المرتبطة بهذا التصنيف أيضًا.</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Delete Image Modal -->
                                @foreach($category->images as $image)
                                    <div class="modal fade" id="deleteImageModal-{{ $image->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.projects.images.destroy', $image->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">حذف الصورة</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        هل أنت متأكد من حذف الصورة "<strong>{{ $image->title ?? 'بدون عنوان' }}</strong>"؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-danger">حذف</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @empty
                                <div class="text-center py-4">
                                    <i class="ri-image-line fs-40 text-muted"></i>
                                    <p class="mt-2 text-muted">لا توجد تصنيفات مشاريع حتى الآن.</p>
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End::app-content -->

@endsection