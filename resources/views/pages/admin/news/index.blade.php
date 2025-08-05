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
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $item->is_verified ? 'bg-success' : 'bg-warning' }}">
                                {{ $item->is_verified ? 'Có' : 'Không' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
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

        {{ $news->links() }}
    </div>
@endsection
