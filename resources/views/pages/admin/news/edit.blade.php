@extends('layouts.adminlte')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
    <div class="container">
        <h2>Chỉnh sửa bài viết</h2>

        @include('pages.admin.news._form', [
            'action' => route('admin.news.store'),
            'method' => 'POST',
            'button' => 'Lưu',
        ])
    </div>
@endsection
