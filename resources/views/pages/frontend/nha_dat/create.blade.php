@extends('layouts.main')
@section('title', 'Đăng tin bất động sản')
@section('content')

    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-7xl flex gap-8">
            <!-- Sidebar -->
            <x-sidebar_profile :user="$user" />

            <!-- Main Content -->
            <main class="flex-1">
                <div class="bg-white rounded-xl shadow py-8">
                    <div class="max-w-4xl mx-auto">
                        <h3 class="text-2xl font-bold text-[#E03C31] tracking-tight pl-6">Thêm mới</h3>
                        <hr class="h-px m-4 mb-0 bg-gray-200 border-0 dark:bg-gray-500">
                        <div class="p-6 sm:p-8">
                            @if (session('success'))
                                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg flex items-center justify-between"
                                    role="alert">
                                    <span class="font-medium">{{ session('success') }}</span>
                                    <button type="button" class="text-green-700 hover:text-green-900 text-lg font-bold"
                                        data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg flex items-center justify-between"
                                    role="alert">
                                    <span class="font-medium">{{ session('error') }}</span>
                                    <button type="button" class="text-red-700 hover:text-red-900 text-lg font-bold"
                                        data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg flex items-center justify-between"
                                    role="alert">
                                    <ul class="mb-0 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li class="font-medium">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="text-red-700 hover:text-red-900 text-lg font-bold"
                                        data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                            @endif

                            <form action="{{ route('storeProperty') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-6">
                                    <label for="type_id" class="block text-sm font-semibold text-gray-800 mb-2">Loại bất
                                        động sản(Có thể chọn nhiều)<span class="text-red-500">*</span></label>
                                    <select name="type_id[]" id="type_id" multiple
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('type_id.*') border-red-500 @enderror"
                                        required>
                                        @foreach ($propertyTypes as $type)
                                            <option value="{{ $type->type_id }}"
                                                {{ in_array($type->type_id, old('type_id', [])) ? 'selected' : '' }}>
                                                {{ $type->type_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_id.*')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="demande" class="block text-sm font-semibold text-gray-800 mb-2">Nhu
                                        cầu</label>
                                    <select name="demande" id="demande"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('demande') border-red-500 @enderror"
                                        required>
                                        <option value="0">Thuê</option>
                                        <option value="1">Bán</option>
                                        <option value="2">Thuê và Bán</option>
                                    </select>
                                    @error('demande')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">Địa chỉ <span
                                            class="text-red-500">*</span></label>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <select
                                            class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200"
                                            id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                                            <option value="0">Tỉnh Thành</option>
                                        </select>
                                        <select
                                            class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200"
                                            id="quan" name="quan" title="Chọn Quận Huyện">
                                            <option value="0">Quận Huyện</option>
                                        </select>
                                        <select
                                            class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200"
                                            id="phuong" name="phuong" title="Chọn Phường Xã">
                                            <option value="0">Phường Xã</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="tinh_name" id="tinh_name" />
                                    <input type="hidden" name="quan_name" id="quan_name" />
                                    <input type="hidden" name="phuong_name" id="phuong_name" />
                                    @error('tinh')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                    @error('quan')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                    @error('phuong')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="title" class="block text-sm font-semibold text-gray-800 mb-2">Tiêu đề
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="title" id="title"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('title') border-red-500 @enderror"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="description" class="block text-sm font-semibold text-gray-800 mb-2">Mô
                                        tả</label>
                                    <textarea name="description" id="content" rows="6"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="images" class="block text-sm font-semibold text-gray-800 mb-2">Hình
                                        ảnh (Tối
                                        thiểu
                                        4 hình)</label>
                                    <input type="file" id="images" name="images[]"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 transition-colors duration-200 @error('images.*') border-red-500 @enderror"
                                        multiple accept="image/jpeg,image/png,image/jpg">
                                    <div id="image-preview" class="mt-3 flex flex-wrap gap-3"></div>
                                    <div id="image-error" class="mt-1 text-sm text-red-600 font-medium hidden">Vui
                                        lòng chọn ít
                                        nhất 4 hình ảnh.</div>
                                    @error('images.*')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="price" class="block text-sm font-semibold text-gray-800 mb-2">Giá
                                        (VND)</label>
                                    <input type="number" name="price" id="price" step="0.01"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('price') border-red-500 @enderror"
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="area" class="block text-sm font-semibold text-gray-800 mb-2">Diện
                                        tích</label>
                                    <input type="number" name="area" id="area" step="0.01"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('area') border-red-500 @enderror"
                                        value="{{ old('area') }}">
                                    @error('area')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="is_for_sale" class="block text-sm font-semibold text-gray-800 mb-2">Giảm
                                        giá</label>
                                    <select name="is_for_sale" id="is_for_sale"
                                        class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('is_for_sale') border-red-500 @enderror"
                                        required>
                                        <option value="1" {{ old('is_for_sale', 1) == 1 ? 'selected' : '' }}>Có
                                        </option>
                                        <option value="0" {{ old('is_for_sale', 1) == 0 ? 'selected' : '' }}>không
                                        </option>
                                    </select>
                                    @error('is_for_sale')
                                        <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end space-x-4">
                                    <button type="submit"
                                        class="bg-red-600 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-red-700 transition-colors duration-300">Đăng
                                        tin</button>
                                    <a href="{{ route('admin.properties.index') }}"
                                        class="bg-gray-200 text-gray-800 px-6 py-2.5 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-300">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#images").on("change", function() {
                let files = this.files;
                let preview = $("#image-preview");
                let error = $("#image-error");

                preview.empty(); // Xóa preview cũ
                error.addClass("hidden");

                if (files.length < 4) {
                    error.removeClass("hidden");
                }

                // Duyệt qua từng file và tạo preview
                $.each(files, function(i, file) {
                    if (file.type.match("image.*")) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            let img = $("<img>")
                                .attr("src", e.target.result)
                                .addClass("w-32 h-32 object-cover rounded-lg shadow");
                            preview.append(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>

@endsection
