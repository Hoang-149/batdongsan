@extends('layouts.adminlte')

@section('title', 'Typical Business List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách doanh nghiệp</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.typical_business.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tạo mới
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($businesses as $business)
                                        <tr>
                                            <td>{{ $business->id }}</td>
                                            <td>
                                                <img src="{{ asset($business->image_url) }}" alt="Business Image"
                                                    style="max-width: 100px;">
                                            </td>
                                            <td>

                                                <a href="{{ route('home') }}" class="btn btn-info btn-sm" style=""
                                                    target="_blank">
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>
                                                <a href="{{ route('admin.typical_business.destroy', $business->id) }}"
                                                    class="btn btn-warning btn-sm" style="color: white; ">
                                                    <i class="fas fa-pen"></i> Sửa
                                                </a>
                                                <form action="{{ route('admin.project.destroyBanner', $business->id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this property?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Xóa
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Không tìm thấy.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $businesses->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
