@extends('dashboard.layouts.master')

@section('title', 'إدارة خدمات التبريد والتكييف')

@section('content')
<div class="main-content app-content">
    <div class="container-fluid">

        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">إدارة خدمات التبريد والتكييف</h1>
                <span class="fs-semibold text-muted">تعديل العنوان العام وإدارة الخدمات الفردية</span>
            </div>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">خدمات التبريد والتكييف</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End::page-header -->

        <!-- القسم العام (العنوان والوصف) -->
        <div class="row mb-4">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            العنوان والوصف العام
                        </div>
                        <a href="{{ route('section_services.edit' , $serviceSection->id) }}" class="btn btn-warning btn-sm">
                            <i class="ri-edit-line me-1"></i> تعديل القسم العام
                        </a>
                    </div>
                    <div class="card-body">
                        @if($serviceSection)
                            <p><strong>العنوان:</strong> {{ $serviceSection->title }}</p>
                            <p><strong>الوصف:</strong> {{ $serviceSection->description }}</p>
                        @else
                            <p class="text-muted">لم يتم إدخال بيانات القسم العام بعد.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- جدول الخدمات -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            قائمة الخدمات
                        </div>
                        <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm">
                            <i class="ri-add-line me-1"></i> إضافة خدمة جديدة
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

                        @if($services->isEmpty())
                            <div class="text-center py-4">
                                <i class="ri-service-line fs-40 text-muted"></i>
                                <p class="mt-2 text-muted">لا توجد خدمات حتى الآن.</p>
                            </div>
                        @else
                            <table id="file-export" class="table table-bordered text-nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الأيقونة</th>
                                        <th>العنوان</th>
                                        <th>الوصف</th>
                                        <th>الترتيب</th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if(Str::startsWith($service->icon, 'bx bx') || Str::startsWith($service->icon, 'ri '))
                                                    <i class="{{ $service->icon }} fs-20 text-primary"></i>
                                                @else
                                                    <img src="{{ secure_asset('storage/' . $service->icon)}}" alt="تصميم الأنظمة" width="50"/>
                                                @endif
                                            </td>
                                            <td>{{ $service->title }}</td>
                                            <td>{{ Str::limit($service->description, 50) }}</td>
                                            <td>{{ $service->sort_order }}</td>
                                            <td>
                                                @if($service->is_active)
                                                    <span class="badge bg-success">نشط</span>
                                                @else
                                                    <span class="badge bg-danger">معطل</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 fs-15">
                                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-icon btn-sm btn-success-light">
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $service->id }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal-{{ $service->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">حذف الخدمة</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            هل أنت متأكد من حذف الخدمة "<strong>{{ $service->title }}</strong>"؟
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
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
  

@endsection
