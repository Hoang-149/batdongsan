@extends('layouts.adminlte')
@section('title', 'Danh sách banner')
@section('content')
    <div class="container">
        <h2>Danh sách banner</h2>

        <a href="{{ route('admin.project.createBanner') }}" class="btn btn-primary mb-3">+ Thêm banner</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Location</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allBanner as $item)
                    <tr>
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($item->title), 50) }}</td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="Business Image" style="max-width: 100px;">
                        </td>
                        <td>{{ $item->location }}</td>
                        <td>
                            <a href="{{ route('projects') }}" class="btn btn-info btn-sm" style="" target="_blank">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <a href="{{ route('admin.project.editBanner', $item->id) }}" class="btn btn-warning btn-sm"
                                style="color: white; ">
                                <i class="fas fa-pen"></i> Sửa
                            </a>
                            <form action="{{ route('admin.project.destroyBanner', $item->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this property?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- {{ $banner->links() }} --}}
    </div>
@endsection
