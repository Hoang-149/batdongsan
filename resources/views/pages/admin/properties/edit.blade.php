@extends('layouts.adminlte')

@section('title', 'Edit Property')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Property: {{ $property->title }}</h3>
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

                            <form action="{{ route('admin.properties.update', $property->property_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="user_id">Người đăng <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id"
                                        class="form-control @error('user_id') is-invalid @enderror">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ old('user_id', $property->user_id) == $user->user_id ? 'selected' : '' }}>
                                                {{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type_id" class="block text-sm font-medium text-gray-700">Loại bất động sản
                                        <span class="text-red-500">*</span></label>
                                    <select name="type_id[]" id="type_id" multiple
                                        class="form-control  @error('type_id.*') border-red-500 @enderror" required>
                                        @foreach ($propertyTypes as $type)
                                            <option value="{{ $type->type_id }}"
                                                {{ in_array($type->type_id, old('type_id', $property->propertyTypes->pluck('type_id')->toArray())) ? 'selected' : '' }}>
                                                {{ $type->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_id.*')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="demande">Nhu cầu</label>
                                    <select name="demande" id="demande"
                                        class="form-control @error('demande') is-invalid @enderror" required>
                                        <option value="0"
                                            {{ old('demande', $property->demande) == 0 ? 'selected' : '' }}>Thuê
                                        </option>
                                        <option value="1"
                                            {{ old('demande', $property->demande) == 1 ? 'selected' : '' }}>Bán
                                        </option>
                                        <option value="2"
                                            {{ old('demande', $property->demande) == 2 ? 'selected' : '' }}>Thuê và Bán
                                        </option>
                                    </select>
                                    @error('demande')
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
                                    <label for="project_id">Dự án</label>
                                    <select name="project_id" id="project_id"
                                        class="form-control @error('project_id') is-invalid @enderror">
                                        <option value="">Select Project (Optional)</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->project_id }}"
                                                {{ old('project_id', $property->project_id) == $project->project_id ? 'selected' : '' }}>
                                                {{ $project->project_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $property->title) }}">
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="content" class="form-control @error('description') is-invalid @enderror">{{ old('description', $property->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Hình ảnh hiện tại (Tối thiểu 4 hình ảnh sau khi chỉnh sửa)</label>
                                    <div class="flex flex-wrap gap-2 mb-2" id="current-images">
                                        @foreach ($property->images as $image)
                                            <div class="relative image-container">
                                                <div class="mt-2 flex flex-wrap gap-2">
                                                    <img src="{{ asset($image->image_url) }}"
                                                        class="w-24 h-24 object-cover rounded" alt="Property image"
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
                                    <label for="price">Mức giá(VND)</label>
                                    <input type="number" name="price" id="price" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $property->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area">Diện tích</label>
                                    <input type="number" name="area" id="area" step="0.01"
                                        class="form-control @error('area') is-invalid @enderror"
                                        value="{{ old('area', $property->area) }}">
                                    @error('area')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_for_sale">Giảm giá</label>
                                    <select name="is_for_sale" id="is_for_sale"
                                        class="form-control @error('is_for_sale') is-invalid @enderror" required>
                                        <option value="1"
                                            {{ old('is_for_sale', $property->is_for_sale) == 1 ? 'selected' : '' }}>Có
                                        </option>
                                        <option value="0"
                                            {{ old('is_for_sale', $property->is_for_sale) == 0 ? 'selected' : '' }}>Không
                                        </option>
                                    </select>
                                    @error('is_for_sale')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_verified">Xác thực</label>
                                    <select name="is_verified" id="is_verified"
                                        class="form-control @error('is_verified') is-invalid @enderror" required>
                                        <option value="0"
                                            {{ old('is_verified', $property->is_verified) == 0 ? 'selected' : '' }}>Không
                                        </option>
                                        <option value="1"
                                            {{ old('is_verified', $property->is_verified) == 1 ? 'selected' : '' }}>Có
                                        </option>
                                    </select>
                                    @error('is_verified')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Hủy</a>
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
                tinh: "{{ $property->location ? explode(', ', $property->location)[0] : '' }}",
                phuong: "{{ $property->location ? explode(', ', $property->location)[1] : '' }}"
            };
        });
    </script>
@endsection
