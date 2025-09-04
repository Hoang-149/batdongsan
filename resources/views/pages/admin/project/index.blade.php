@extends('layouts.adminlte')

@section('title', 'Project List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách dự án</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.project.create') }}" class="btn btn-primary btn-sm">
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

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tiêu đề</th>
                                        <th>Địa chỉ</th>
                                        <th>Diện tích(m2)</th>
                                        <th>Trạng thái</th>
                                        <th>Xác thực</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($project as $prj)
                                        <tr>
                                            <td>{{ $prj->project_id }}</td>
                                            <td>{{ $prj->project_name }}</td>
                                            <td>{{ $prj->location ?? 'N/A' }}</td>
                                            <td>{{ $prj->area ? number_format($prj->area, 2) : 'N/A' }}</td>
                                            <td>
                                                <span
                                                    class="badge
                                                @if ($prj->status == 0) bg-warning
                                                    @elseif($prj->status == 1)
                                                        bg-success
                                                    @elseif($prj->status == 2)
                                                        bg-primary @endif">
                                                    @if ($prj->status == 0)
                                                        Sắp mở bán
                                                    @elseif($prj->status == 1)
                                                        Đang mở bán
                                                    @elseif($prj->status == 2)
                                                        Đã bàn giao
                                                    @endif

                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $prj->is_verified ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $prj->is_verified ? 'Có' : 'Không' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('project.detail', $prj->slug) }}"
                                                    class="btn btn-info btn-sm" style="" target="_blank">
                                                    <i class="fas fa-eye"></i> Hiển thị
                                                </a>
                                                <a href="{{ route('admin.project.edit', $prj->project_id) }}"
                                                    class="btn btn-warning btn-sm" style="color: white">
                                                    <i class="fas fa-pen"></i> Sửa
                                                </a>
                                                <form action="{{ route('admin.project.destroy', $prj->project_id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this prj?');">
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
                                            <td colspan="13" class="text-center">Không tìm thấy.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $project->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
