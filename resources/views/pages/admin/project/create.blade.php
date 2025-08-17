@extends('layouts.adminlte')

@section('title', 'Create Project')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tạo mới dự án</h3>
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

                            <form action="{{ route('admin.project.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="user_id">Người đăng <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id"
                                        class="form-control @error('user_id') is-invalid @enderror" required>
                                        <option value="">Lựa chọn</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->user_id }}"
                                                {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
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
                                        value="{{ old('project_name') }}" required>
                                    @error('project_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="content" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="location">Địa chỉ <span class="text-danger">*</span></label>
                                    <select class="css_select" id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                                        <option value="0">Tỉnh Thành</option>
                                    </select>
                                    <select class="css_select" id="quan" name="quan" title="Chọn Quận Huyện">
                                        <option value="0">Quận Huyện</option>
                                    </select>
                                    <select class="css_select" id="phuong" name="phuong" title="Chọn Phường Xã">
                                        <option value="0">Phường Xã</option>
                                    </select>
                                    <input type="hidden" name="tinh_name" id="tinh_name" />
                                    <input type="hidden" name="quan_name" id="quan_name" />
                                    <input type="hidden" name="phuong_name" id="phuong_name" />
                                    @error('tinh')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @error('quan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @error('phuong')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="images">Hình ảnh (Tối thiểu 4 hình)</label>
                                    <input type="file" id="images" name="images[]"
                                        class="form-control-file @error('images.*') is-invalid @enderror" multiple
                                        accept="image/jpeg,image/png,image/jpg">
                                    <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
                                    <div id="image-error" class="text-danger mt-2" style="display: none;">Vui lòng chọn
                                        ít
                                        nhất 4 hình ảnh.</div>
                                    @error('images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="price">Mức giá(triệu/m2)</label>
                                    <input type="number" name="price" id="price" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area">Diện tích</label>
                                    <input type="number" name="area" id="area" step="0.01"
                                        class="form-control @error('area') is-invalid @enderror"
                                        value="{{ old('area') }}">
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
                                        <option value="0" {{ old('is_verified', 0) == 0 ? 'selected' : '' }}>Không
                                        </option>
                                        <option value="1" {{ old('is_verified', 0) == 1 ? 'selected' : '' }}>Có
                                        </option>
                                    </select>
                                    @error('is_verified')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Tạo</button>
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

            // Xử lý hiển thị ảnh
            $('input[name="images[]"]').on('change', function(e) {
                var files = e.target.files;
                var $preview = $('#image-preview');
                var $errorDiv = $('#image-error');
                $preview.html(''); // Xóa ảnh cũ

                // Kiểm tra số lượng ảnh
                if (files.length < 4) {
                    $errorDiv.show();
                } else {
                    $errorDiv.hide();
                }

                $.each(files, function(index, file) {
                    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                        return true; // continue
                    }

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = new Image();
                        img.src = e.target.result;

                        $(img).on('load', function() {
                            var canvas = $('<canvas>')[0];
                            var ctx = canvas.getContext('2d');
                            var maxWidth = 100,
                                maxHeight = 100;
                            var width = img.width,
                                height = img.height;

                            // Resize
                            if (width > height && width > maxWidth) {
                                height = Math.round((height * maxWidth) / width);
                                width = maxWidth;
                            } else if (height > maxHeight) {
                                width = Math.round((width * maxHeight) / height);
                                height = maxHeight;
                            }

                            canvas.width = width;
                            canvas.height = height;
                            ctx.drawImage(img, 0, 0, width, height);

                            var thumbnail = $('<img>')
                                .attr('src', canvas.toDataURL('image/jpeg'))
                                .addClass('rounded object-cover')
                                .css({
                                    width: '150px'
                                });

                            $preview.append(thumbnail);
                        });
                    };

                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

@endsection
