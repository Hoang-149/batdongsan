@extends('layouts.adminlte')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
    <div class="container">
        <h2>Chỉnh sửa bài viết</h2>

        @include('pages.admin.news._form', [
            'action' => route('admin.news.update', $news->id),
            'method' => 'PUT',
            'button' => 'Lưu',
        ])
    </div>
@endsection
