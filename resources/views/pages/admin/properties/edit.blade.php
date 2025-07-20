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

                            <form action="{{ route('admin.properties.update', $property->property_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="user_id">User <span class="text-danger">*</span></label>
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
                                    <label for="type_id">Property Type <span class="text-danger">*</span></label>
                                    <select name="type_id" id="type_id"
                                        class="form-control @error('type_id') is-invalid @enderror">
                                        <option value="">Select Property Type</option>
                                        @foreach ($propertyTypes as $type)
                                            <option value="{{ $type->type_id }}"
                                                {{ old('type_id', $property->type_id) == $type->type_id ? 'selected' : '' }}>
                                                {{ $type->type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location_id">Location <span class="text-danger">*</span></label>
                                    <select name="location_id" id="location_id"
                                        class="form-control @error('location_id') is-invalid @enderror">
                                        <option value="">Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{ $location->location_id }}"
                                                {{ old('location_id', $property->location_id) == $location->location_id ? 'selected' : '' }}>
                                                {{ $location->province }} - {{ $location->district }} -
                                                {{ $location->ward }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="project_id">Project</label>
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
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $property->title) }}">
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $property->description) }}</textarea>
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
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="price" step="0.01"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $property->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="number" name="area" id="area" step="0.01"
                                        class="form-control @error('area') is-invalid @enderror"
                                        value="{{ old('area', $property->area) }}">
                                    @error('area')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_for_sale">For Sale</label>
                                    <select name="is_for_sale" id="is_for_sale"
                                        class="form-control @error('is_for_sale') is-invalid @enderror" required>
                                        <option value="1"
                                            {{ old('is_for_sale', $property->is_for_sale) == 1 ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0"
                                            {{ old('is_for_sale', $property->is_for_sale) == 0 ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('is_for_sale')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_verified">Verified</label>
                                    <select name="is_verified" id="is_verified"
                                        class="form-control @error('is_verified') is-invalid @enderror" required>
                                        <option value="0"
                                            {{ old('is_verified', $property->is_verified) == 0 ? 'selected' : '' }}>No
                                        </option>
                                        <option value="1"
                                            {{ old('is_verified', $property->is_verified) == 1 ? 'selected' : '' }}>Yes
                                        </option>
                                    </select>
                                    @error('is_verified')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Property</button>
                                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.querySelector('input[name="images[]"]');
            const preview = document.getElementById('image-preview');
            const errorDiv = document.getElementById('image-error');
            const currentImagesContainer = document.getElementById('current-images');
            const deleteCheckboxes = document.querySelectorAll('.delete-checkbox');

            // Hàm kiểm tra số lượng hình ảnh hợp lệ
            function validateImageCount() {
                const currentImages = currentImagesContainer.querySelectorAll('.image-container').length;
                const deletedImages = Array.from(deleteCheckboxes).filter(cb => cb.checked).length;
                const newImages = input.files.length;
                const totalImages = currentImages - deletedImages + newImages;

                if (totalImages < 4) {
                    errorDiv.style.display = 'block';
                } else {
                    errorDiv.style.display = 'none';
                }
            }

            // Kiểm tra số lượng hình ảnh khi thay đổi checkbox xóa
            deleteCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', validateImageCount);
            });

            // Xử lý bản xem trước hình ảnh mới
            input.addEventListener('change', function(e) {
                preview.innerHTML = ''; // Xóa bản xem trước cũ
                validateImageCount(); // Kiểm tra số lượng ngay khi chọn hình mới

                Array.from(e.target.files).forEach(file => {
                    if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
                        return; // Bỏ qua tệp không hợp lệ
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = new Image();
                        img.src = e.target.result;

                        img.onload = function() {
                            // Tạo canvas để thu nhỏ hình ảnh
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            const maxWidth = 100; // Chiều rộng tối đa
                            const maxHeight = 100; // Chiều cao tối đa
                            let width = img.width;
                            let height = img.height;

                            // Tính tỷ lệ thu nhỏ
                            if (width > height) {
                                if (width > maxWidth) {
                                    height = Math.round((height * maxWidth) / width);
                                    width = maxWidth;
                                }
                            } else {
                                if (height > maxHeight) {
                                    width = Math.round((width * maxHeight) / height);
                                    height = maxHeight;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;
                            ctx.drawImage(img, 0, 0, width, height);

                            // Tạo phần tử hình ảnh thu nhỏ
                            const thumbnail = document.createElement('img');
                            thumbnail.src = canvas.toDataURL('image/jpeg');
                            thumbnail.classList.add('w-24', 'h-24', 'object-cover',
                                'rounded');
                            preview.appendChild(thumbnail);

                            // Thu hồi URL để tránh rò rỉ bộ nhớ
                            URL.revokeObjectURL(img.src);
                        };
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
@endsection
