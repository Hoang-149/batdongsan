@extends('layouts.adminlte')

@section('title', 'Edit Project')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa dự án</h3>
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

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.project.update', $project->project_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="user_id">Người đăng <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id"
                                        class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">Lựa chọn</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ old('user_id', $project->user_id) == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="project_name">Tên dự án <span class="text-danger">*</span></label>
                                    <input type="text" name="project_name" id="project_name"
                                        class="form-control @error('project_name') is-invalid @enderror"
                                        value="{{ old('project_name', $project->project_name) }}" required>
                                    @error('project_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="content" class="form-control @error('description') is-invalid @enderror">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="location">Địa chỉ <span class="text-danger">*</span></label>
                                    <select class="css_select" id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                                        <option value="0">Tỉnh Thành</option>
                                    </select>
                                    <select class="css_select" id="phuong" name="phuong" title="Chọn Phường Xã">
                                        <option value="0">Phường Xã</option>
                                    </select>
                                    <input type="hidden" name="tinh_name" id="tinh_name" />
                                    <input type="hidden" name="phuong_name" id="phuong_name" />
                                    @error('tinh')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @error('phuong')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Hình ảnh hiện tại (Tối thiểu 4 hình ảnh sau khi chỉnh sửa)</label>
                                    <div class="flex flex-wrap gap-2 mb-2" id="current-images">
                                        @foreach ($project->images as $image)
                                            <div class="relative image-container">
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    <img src="{{ asset($image->image_url) }}"
                                                        class="w-24 h-24 object-cover rounded" alt="Project image"
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                                <label
                                                    class="absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 cursor-pointer">
                                                    <input type="checkbox" name="delete_images[]"
                                                        value="{{ $image->image_id }}" class="hidden delete-checkbox">
                                                    <i class="fas fa-trash"></i>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="images">Thêm hình ảnh mới</label>
                                    <input type="file" id="images" name="images[]"
                                        class="form-control-file @error('images.*') is-invalid @enderror" multiple
                                        accept="image/jpeg,image/png,image/jpg">
                                    <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
                                    <div id="image-error" class="text-danger mt-2" style="display: none;">
                                        Tổng số hình ảnh (hiện tại trừ đi số bị xóa + mới thêm) phải ít nhất là 4.
                                    </div>
                                    @error('images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Mức giá(triệu/m2)</label>
                                    <input type="number" name="price" id="price" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $project->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area">Diện tích</label>
                                    <input type="number" name="area" id="area" step="0.01"
                                        class="form-control @error('area') is-invalid @enderror"
                                        value="{{ old('area', $project->area) }}">
                                    @error('area')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status"
                                        class="form-control @error('status') is-invalid @enderror" required>
                                        <option value="0" {{ old('status', 0) == 0 ? 'selected' : '' }}>Sắp mở bán
                                        </option>
                                        <option value="1" {{ old('status', 0) == 1 ? 'selected' : '' }}>Đang mở bán
                                        </option>
                                        <option value="2" {{ old('status', 0) == 2 ? 'selected' : '' }}>Đã bàn giao
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_verified">Xác thực</label>
                                    <select name="is_verified" id="is_verified"
                                        class="form-control @error('is_verified') is-invalid @enderror" required>
                                        <option value="0"
                                            {{ old('is_verified', $project->is_verified) == 0 ? 'selected' : '' }}>Không
                                        </option>
                                        <option value="1"
                                            {{ old('is_verified', $project->is_verified) == 1 ? 'selected' : '' }}>Có
                                        </option>
                                    </select>
                                    @error('is_verified')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                    <a href="{{ route('admin.project.index') }}" class="btn btn-secondary">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <script>
        jQuery(document).ready(function($) {

            window.locationDefault = {
                tinh: "{{ $project->location ? explode(', ', $project->location)[0] : '' }}",
                phuong: "{{ $project->location ? explode(', ', $project->location)[1] : '' }}"
            };


        });
    </script>

@endsection
