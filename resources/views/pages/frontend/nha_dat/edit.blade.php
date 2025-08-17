@extends('layouts.main')
@section('title', 'Chỉnh sửa tin đăng')

@section('content')
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-7xl flex gap-8">

            <!-- Sidebar -->
            <x-sidebar_profile :user="$user" />

            <!-- Main Content -->
            <main class="flex-1">
                <div class="bg-white rounded-xl shadow p-6">

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

                    <h3 class="text-2xl font-bold text-[#E03C31] mb-6">Chỉnh sửa tin đăng</h3>

                    <form action="{{ route('user.properties.update', $property->property_id) }}" method="POST"
                        enctype="multipart/form-data" id="editPropertyForm" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Tiêu đề --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tiêu đề</label>
                            <input type="text" name="title" value="{{ old('title', $property->title) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-red-300">
                        </div>

                        <div class="mb-6">
                            <label for="type_id" class="block text-sm font-semibold text-gray-800 mb-2">Loại bất
                                động sản(Có thể chọn nhiều)<span class="text-red-500">*</span></label>
                            <select name="type_id[]" id="type_id" multiple
                                class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('type_id.*') border-red-500 @enderror"
                                required>
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type->type_id }}"
                                        {{ in_array($type->type_id, old('type_id', $property->propertyTypes->pluck('type_id')->toArray())) ? 'selected' : '' }}>
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
                                <option value="0" {{ old('demande', $property->demande) == 0 ? 'selected' : '' }}>Thuê
                                </option>
                                <option value="1" {{ old('demande', $property->demande) == 1 ? 'selected' : '' }}>Bán
                                </option>
                                <option value="2" {{ old('demande', $property->demande) == 2 ? 'selected' : '' }}>Thuê
                                    và Bán
                                </option>
                            </select>
                            @error('demande')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Địa chỉ --}}
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                            <input type="text" name="location" value="{{ old('location', $property->location) }}"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-red-300">
                        </div> --}}

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

                        {{-- Diện tích và Giá --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Diện tích (m²)</label>
                                <input type="number" name="area" value="{{ old('area', $property->area) }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-red-300">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Giá (triệu VNĐ)</label>
                                <input type="number" name="price" value="{{ old('price', $property->price) }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-red-300">
                            </div>
                        </div>

                        {{-- Mô tả --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả</label>
                            <textarea name="description" id="content" rows="4"
                                class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-red-300">{{ old('description', $property->description) }}</textarea>
                        </div>

                        {{-- Ảnh hiện tại --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh hiện tại</label>
                            <div id="currentImages" class="flex flex-wrap gap-3">
                                @forelse ($property->images as $image)
                                    <div class="relative group">
                                        <img src="{{ asset($image->image_url) }}"
                                            class="w-24 h-24 rounded-lg object-cover border">
                                        <button type="button" data-id="{{ $image->image_id }}"
                                            class="absolute top-1 right-1 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                @empty
                                    <div class="col-span-full text-center text-gray-500">
                                        No images found.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Upload ảnh mới --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Thêm ảnh mới</label>
                            <input type="file" name="images[]" id="imageUpload" multiple
                                class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-red-300">
                            <div id="previewImages" class="flex flex-wrap gap-3 mt-3"></div>
                        </div>

                        <div class="mb-6">
                            <label for="is_for_sale" class="block text-sm font-semibold text-gray-800 mb-2">Giảm
                                giá</label>
                            <select name="is_for_sale" id="is_for_sale"
                                class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/50 shadow-sm transition-colors duration-200 @error('is_for_sale') border-red-500 @enderror"
                                required>
                                <option value="1"
                                    {{ old('is_for_sale', $property->is_for_sale) == 1 ? 'selected' : '' }}>Có
                                </option>
                                <option value="0"
                                    {{ old('is_for_sale', $property->is_for_sale) == 0 ? 'selected' : '' }}>Không
                                </option>
                            </select>
                            @error('is_for_sale')
                                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>


                        {{-- Nút submit --}}
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('user.properties.index') }}"
                                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Hủy</a>
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Cập
                                nhật</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <style>
        svg,
        i {
            pointer-events: none;
        }
    </style>

    <script>
        $(document).ready(function($) {

            $('body').on('click', '#currentImages button', function() {
                let imageId = $(this).data('id');

                $.ajax({
                    url: '/properties/images/' + imageId,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.success) {
                            $('#image-' + imageId).remove();
                            alert('Xóa ảnh thành công');
                        }
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });

            // Preview ảnh mới
            $('#imageUpload').on('change', function() {
                $('#previewImages').html('');
                let files = this.files;
                if (files.length > 0) {
                    Array.from(files).forEach(file => {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#previewImages').append(`
                        <img src="${e.target.result}" class="w-24 h-24 rounded-lg object-cover border">
                    `);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });

            window.locationDefault = {
                tinh: "{{ $property->location ? explode(', ', $property->location)[0] : '' }}",
                quan: "{{ $property->location ? explode(', ', $property->location)[1] : '' }}",
                phuong: "{{ $property->location ? explode(', ', $property->location)[2] : '' }}"
            };

        });
    </script>
@endsection
