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
        <input type="text" name="title" class="form-control" value="{{ old('title', $news->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Nội dung</label>
        <textarea id="content" name="content" class="form-control" rows="6">{{ old('content', $news->content ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="thumbnail" class="form-label">Ảnh thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">
        @if (!empty($news->thumbnail))
            <p class="mt-2">Ảnh hiện tại:</p>
            <img src="{{ asset($news->thumbnail) }}" width="150">
        @endif
    </div>


    <div class="mb-3">
        <label for="author" class="form-label">Tác giả</label>
        <input type="text" name="author" class="form-control" value="{{ old('author', $news->author ?? '') }}">
    </div>

    <div class="mb-3">
        <label for="is_verified">Xác thực</label>
        <select name="is_verified" id="is_verified" class="form-control @error('is_verified') is-invalid @enderror"
            required>
            <option value="0" {{ old('is_verified', 0) == 0 ? 'selected' : '' }}>Không
            </option>
            <option value="1" {{ old('is_verified', 0) == 1 ? 'selected' : '' }}>Có
            </option>
        </select>
        @error('is_verified')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">{{ $button }}</button>
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
