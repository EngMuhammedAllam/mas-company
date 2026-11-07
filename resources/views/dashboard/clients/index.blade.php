@extends('dashboard.layouts.master')
@section('title')
قائمة العملاء
@endsection
@section('content')

<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0">قائمة العملاء</h1>
            </div>
        </div>
        <!-- End::page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">شعارات العملاء</div>
                        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">إضافة عميل جديد</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" dir="rtl" role="alert">
                            <i class="ri-close-line" data-bs-dismiss="alert" aria-label="Close"></i>
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">الرابط</th>
                                        <th scope="col">الشعار</th>
                                        <th scope="col">تاريخ الإضافة</th>
                                        <th scope="col">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $client->name ?? '-' }}</td>
                                        <td>
                                            @if($client->link)
                                            <a href="{{ $client->link }}" target="_blank">زيارة الرابط</a>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $client->image) }}" alt="client logo" style="width: 50px; height: 50px; object-fit: contain;">
                                        </td>
                                        <td>{{ $client->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="hstack gap-2">
                                                <form action="{{ route('admin.clients.edit') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $client->id }}">
                                                    <button type="submit" class="btn btn-icon btn-sm btn-success-light">
                                                        <i class="ri-edit-line"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.clients.destroy') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $client->id }}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection