@extends('layouts.adminlte')
@section('title', 'Danh sách tin tức')
@section('content')
    <div class="container">
        <h2>Danh sách bài viết</h2>

        <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">+ Thêm bài viết</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ngày tạo</th>
                    <th>Xác thực</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($item->title), 50) }}</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $item->is_verified ? 'bg-success' : 'bg-warning' }}">
                                {{ $item->is_verified ? 'Có' : 'Không' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('news.detail', $item->slug) }}" class="btn btn-info btn-sm" style=""
                                target="_blank">
                                <i class="fas fa-eye"></i> Hiển thị
                            </a>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                style="color: white; ">
                                <i class="fas fa-pen"></i> Sửa
                            </a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
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


        <div class="d-flex justify-content-center mt-3">
            {{ $news->links('pagination::bootstrap-4') }}
        </div>

    </div>
@endsection
