@extends('layouts.adminlte')
@section('title', 'Chỉnh sửa banner')
@section('content')
    <div class="container">
        <h2>Chỉnh sửa banner</h2>

        @include('pages.admin.banner_project_page._form', [
            'action' => route('admin.project.updateBanner', $banner->id),
            'method' => 'PUT',
            'button' => 'Lưu',
        ])
    </div>
@endsection
