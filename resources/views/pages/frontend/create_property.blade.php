@extends('layouts.main')
@section('title', 'Đăng tin bất động sản')
@section('content')

    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
                    <h3 class="text-2xl font-bold text-white">Create New Property</h3>
                </div>
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg"
                            role="alert">
                            <button type="button" class="float-right text-green-700 hover:text-green-900"
                                data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <button type="button" class="float-right text-red-700 hover:text-red-900" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <button type="button" class="float-right text-red-700 hover:text-red-900" data-dismiss="alert"
                                aria-hidden="true">&times;</button>
                            <ul class="mb-0 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="text" name="user_id" value="{{ auth()->id() }}" hidden>
                        <input type="text" name="is_verified" value="0" hidden>


                        <div class="mb-6">
                            <label for="type_id" class="block text-sm font-medium text-gray-700 mb-2">Property Type <span
                                    class="text-red-500">*</span></label>
                            <select name="type_id[]" id="type_id" multiple
                                class="w-full rounded-lg border-gray-300 shadow-sm border-solid border-2 focus:border-blue-500 focus:ring-blue-500 @error('type_id.*') border-red-500 @enderror"
                                required>
                                @foreach ($propertyTypes as $type)
                                    <option value="{{ $type->type_id }}"
                                        {{ in_array($type->type_id, old('type_id', [])) ? 'selected' : '' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="demande" class="block text-sm font-medium text-gray-700 mb-2">Demande</label>
                            <select name="demande" id="demande"
                                class="w-full border-solid border-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('demande') border-red-500 @enderror"
                                required>
                                <option value="0">Thuê</option>
                                <option value="1">Bán</option>
                                <option value="2">Thuê và Bán</option>
                            </select>
                            @error('demande')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location <span
                                    class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <select
                                    class="w-full border-solid border-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    id="tinh" name="tinh" title="Chọn Tỉnh Thành">
                                    <option value="0">Tỉnh Thành</option>
                                </select>
                                <select
                                    class="w-full border-solid border-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    id="quan" name="quan" title="Chọn Quận Huyện">
                                    <option value="0">Quận Huyện</option>
                                </select>
                                <select
                                    class="w-full border-solid border-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    id="phuong" name="phuong" title="Chọn Phường Xã">
                                    <option value="0">Phường Xã</option>
                                </select>
                            </div>
                            <input type="hidden" name="tinh_name" id="tinh_name" />
                            <input type="hidden" name="quan_name" id="quan_name" />
                            <input type="hidden" name="phuong_name" id="phuong_name" />
                            @error('tinh')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('quan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('phuong')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- 
                    <div class="form-group">
                        <label for="project_id">Project</label>
                        <select name="project_id" id="project_id"
                            class="form-control @error('project_id') is-invalid @enderror">
                            <option value="">Select Project (Optional)</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->project_id }}"
                                    {{ old('project_id') == $project->project_id ? 'selected' : '' }}>
                                    {{ $project->project_name }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> --}}

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 border-solid border-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full border-solid border-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Hình ảnh (Tối thiểu
                                4 hình)</label>
                            <input type="file" id="images" name="images[]"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('images.*') border-red-500 @enderror"
                                multiple accept="image/jpeg,image/png,image/jpg">
                            <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
                            <div id="image-error" class="mt-1 text-sm text-red-600 hidden">Vui lòng chọn ít nhất 4 hình
                                ảnh.</div>
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (VND)</label>
                            <input type="number" name="price" id="price" step="0.01"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 border-solid border-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                                value="{{ old('price') }}">
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="area" class="block text-sm font-medium text-gray-700 mb-2">Area</label>
                            <input type="number" name="area" id="area" step="0.01"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 border-solid border-2 focus:ring-blue-500 @error('area') border-red-500 @enderror"
                                value="{{ old('area') }}">
                            @error('area')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="is_for_sale" class="block text-sm font-medium text-gray-700 mb-2">For Sale</label>
                            <select name="is_for_sale" id="is_for_sale"
                                class="w-full rounded-lg border-gray-300 border-solid border-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('is_for_sale') border-red-500 @enderror"
                                required>
                                <option value="1" {{ old('is_for_sale', 1) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('is_for_sale', 1) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('is_for_sale')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex justify-end space-x-4">
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Create
                                Property</button>
                            <a href="{{ route('admin.properties.index') }}"
                                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition duration-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
