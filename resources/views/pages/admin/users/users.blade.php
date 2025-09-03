@extends('layouts.adminlte')
@section('title', 'Users')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách người dùng</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tạo mới
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
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
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Số điện thoại</th>
                                    <th>Quyền</th>
                                    <th>Xác thực</th>
                                    <th>Hành động</th>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        @php
                                            $role = $user->roles->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $user->user_id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->full_name ?? 'N/A' }}</td>
                                            <td>{{ $user->phone_number ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $role ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $role ? $role->role_name : 'Người dùng' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $user->is_verified ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $user->is_verified ? 'Có' : 'Không' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->user_id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                                            <td colspan="8" class="text-center">Không tìm thấy.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <script>
        // Optional: Additional JavaScript for table enhancements (e.g., DataTables)
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
