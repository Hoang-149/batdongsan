@extends('layouts.adminlte')
@section('title', 'Tạo bài viết mới')
@section('content')
    <div class="container">
        <h2>Thêm bài viết mới</h2>

        @include('pages.admin.news._form', [
            'action' => route('admin.news.store'),
            'method' => 'POST',
            'button' => 'Lưu',
        ])
    </div>
@endsection
