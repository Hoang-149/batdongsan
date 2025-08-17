@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}"
            required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Ảnh banner</label>
        <input type="file" name="image" class="form-control">
        @if (!empty($banner->image))
            <p class="mt-2">Ảnh hiện tại:</p>
            <img src="{{ asset($banner->image) }}" width="150">
        @endif
    </div>

    <div class="mb-3">
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

    <button type="submit" class="btn btn-success">{{ $button }}</button>
    <a href="{{ route('admin.project.indexBanner') }}" class="btn btn-secondary">Quay lại</a>
</form>
