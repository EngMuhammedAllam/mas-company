@extends('dashboard.layouts.master')
@section('title')
رسائل التواصل
@endsection
@section('content')

<!-- Start::app-content -->
<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                    مرحبا بكم في صفحة رسائل التواصل
                </h1>
                <span class="fs-semibold text-muted">هنا يمكنك قراءة رسائل العملاء</span>
            </div>
        </div>
        <!-- End::page-header -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title text-capitalize">
                            رسائل التواصل
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
                        <table id="file-export" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الهاتف</th>
                                    <th>العنوان</th>
                                    <th>الرسالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                <tr class="product-list">
                                    <td>{{ $message->fullname }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->phone }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td style="white-space: pre-wrap;">{{ $message->message }}</td>
                                    <td>
                                        <div class="hstack gap-2 fs-15">
                                            <a class="btn btn-icon btn-sm btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteMessageModal-{{ $message->id }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteMessageModal-{{ $message->id }}" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.contact.destroy', $message->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حـــــذف الرسالة</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    هل أنت متأكد من حذف الرسالة من <strong>{{ $message->fullname }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ألغاء</button>
                                                    <button type="submit" class="btn btn-danger">حذف</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::app-content -->

@endsection