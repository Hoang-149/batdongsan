@extends('layouts.adminlte')

@section('title', 'Property List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách bài đăng</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">
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
                                        {{-- <th>Người đăng</th> --}}
                                        {{-- <th>Loại</th> --}}
                                        <th>Địa chỉ</th>
                                        {{-- <th>Images</th> --}}
                                        {{-- <th>Mức giá</th> --}}
                                        <th>Diện tích</th>
                                        <th>Xác thực</th>
                                        {{-- <th>VIP Status</th> --}}
                                        <th>Nhu cầu</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($properties as $property)
                                        <tr>
                                            <td>{{ $property->property_id }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit(strip_tags($property->title), 50) }}</td>
                                            {{-- <td>{{ $property->user->username ?? 'N/A' }}</td> --}}
                                            {{-- <td>{{ implode(', ', $property->propertyTypes->pluck('type_name')->toArray()) }} --}}
                                            </td>
                                            <td>{{ $property->location ?? 'N/A' }}</td>
                                            {{-- <td>
                                                <div class="flex flex-wrap gap-2">
                                                    @if ($property->images->isNotEmpty())
                                                        @foreach ($property->images as $image)
                                                            <a href="{{ asset($image->image_url) }}" target="_blank"
                                                                title="View full image">
                                                                <img src="{{ asset($image->image_url) }}"
                                                                    class="w-8 object-cover rounded hover:scale-105 transition-transform duration-200"
                                                                    alt="Property Image" width="64px">
                                                            </a>
                                                        @endforeach
                                                    @else
                                                        <span class="text-gray-500">No images available</span>
                                                    @endif
                                                </div>
                                            </td> --}}
                                            {{-- <td>{{ $property->price ? number_format($property->price, 2) : 'N/A' }}</td> --}}
                                            <td>{{ $property->area ? number_format($property->area, 2) : 'N/A' }}</td>

                                            <td>
                                                <span
                                                    class="badge {{ $property->is_verified ? 'bg-success' : 'bg-warning' }}">
                                                    {{ $property->is_verified ? 'Có' : 'Không' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($property->demande == 0)
                                                    <span>Thuê</span>
                                                @else
                                                    @if ($property->demande == 1)
                                                        <span>Bán</span>
                                                    @else
                                                        <span>Thuê và Bán</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('properties.show', $property->slug) }}"
                                                    class="btn btn-info btn-sm" style="" target="_blank">
                                                    <i class="fas fa-eye"></i> Hiển thị
                                                </a>
                                                <a href="{{ route('admin.properties.edit', $property->property_id) }}"
                                                    class="btn btn-warning btn-sm" style="color: white; ">
                                                    <i class="fas fa-pen"></i> Sửa
                                                </a>
                                                <form
                                                    action="{{ route('admin.properties.destroy', $property->property_id) }}"
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
                                            <td colspan="13" class="text-center">Không tìm thấy.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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
