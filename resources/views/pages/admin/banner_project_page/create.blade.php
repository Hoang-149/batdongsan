@extends('layouts.adminlte')
@section('title', 'Tạo banner mới')
@section('content')
    <div class="container">
        <h2>Thêm banner mới</h2>

        @include('pages.admin.banner_project_page._form', [
            'action' => route('admin.project.storeBanner'),
            'method' => 'POST',
            'button' => 'Lưu',
        ])
    </div>
    <style type="text/css">
        .css_select_div {
            text-align: center;
        }

        .css_select {
            display: inline-table;
            width: 25%;
            padding: 5px;
            margin: 5px 2%;
            border: solid 1px #686868;
            border-radius: 5px;
        }
    </style>
@endsection
