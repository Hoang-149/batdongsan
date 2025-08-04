@extends('layouts.main')
@section('title', 'Đăng tin bất động sản')
@section('content')

    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-7xl flex gap-8">
            <!-- Sidebar -->
            <aside class="w-80 flex-shrink-0">
                <div class="bg-white rounded-xl shadow p-6 mb-6 flex flex-col items-center">
                    <div
                        class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold text-gray-500 mb-2">
                        M
                    </div>
                    <div class="font-semibold text-lg text-gray-800 truncate w-full text-center">Thắng Hoàng Minh</div>
                    <div class="text-gray-400 text-sm mb-2">0 điểm</div>
                    <div class="w-full bg-gray-50 rounded-lg p-4 mb-3">
                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                            <span>TK Chính</span>
                            <span>0</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>TK Khuyến mãi</span>
                            <span>0</span>
                        </div>
                        <div class="text-xs text-gray-500 mb-2">Mã chuyển khoản</div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-gray-700 text-sm">BDS45412558</span>
                            <button class="text-gray-400 hover:text-gray-600" title="Copy">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <rect x="9" y="9" width="13" height="13" rx="2" stroke-width="2"></rect>
                                    <rect x="3" y="3" width="13" height="13" rx="2" stroke-width="2"></rect>
                                </svg>
                            </button>
                        </div>
                        <button
                            class="w-full mt-2 py-2 border border-[#E03C31] text-[#E03C31] rounded-lg font-semibold hover:bg-[#E03C31] hover:text-white transition">Nạp
                            tiền</button>
                    </div>
                </div>
                <!-- Sidebar Nav -->
                <nav class="bg-white rounded-xl shadow p-4">
                    <ul class="space-y-2">
                        <li>
                            <a href="#"
                                class="flex items-center gap-2 text-gray-700 font-medium hover:text-[#E03C31]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                </svg>
                                Tổng quan
                            </a>
                        </li>
                        <li>
                            <div>
                                <button
                                    class="flex items-center gap-2 text-gray-700 font-medium hover:text-[#E03C31] w-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <rect x="3" y="7" width="18" height="13" rx="2" stroke-width="2">
                                        </rect>
                                        <path d="M16 3v4M8 3v4" stroke-width="2"></path>
                                    </svg>
                                    Quản lý tin đăng
                                    <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2"></path>
                                    </svg>
                                </button>
                                <ul class="ml-7 mt-2 space-y-1 text-sm text-gray-600">
                                    <li><a href="{{ route('createProperty') }}" class="hover:text-[#E03C31]">Đăng mới</a>
                                    </li>
                                    <li><a href="#" class="hover:text-[#E03C31]">Danh sách tin</a></li>
                                    <li><a href="#" class="hover:text-[#E03C31]">Tin nháp</a></li>
                                    <li><a href="#" class="hover:text-[#E03C31]">Danh sách tin tài trợ</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </aside>

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

                            <form action="{{ route('admin.properties.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="is_verified" value="0">

                                <div class="mb-6">
                                    <label for="type_id" class="block text-sm font-semibold text-gray-800 mb-2">Loại bất
                                        động sản<span class="text-red-500">*</span></label>
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

@endsection
