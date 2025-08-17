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
                        <td>{{ $item->title }}</td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="Business Image" style="max-width: 100px;">
                        </td>
                        <td>{{ $item->location }}</td>
                        <td>
                            <a href="{{ route('admin.project.editBanner', $item->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.project.destroyBanner', $item->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- {{ $banner->links() }} --}}
    </div>
@endsection
