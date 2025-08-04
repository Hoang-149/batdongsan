@extends('layouts.main')
@section('title', 'Dự án Bất động sản')
@section('app-container-class', 'w-full')
@section('content')


    <section class="w-full">
        <div class="w-full">
            <div class="slider-projects">
                <div>
                    <img src="https://mdbootstrap.com/img/new/slides/054.jpg" class="w-full h-auto object-cover rounded-lg"
                        alt="Banner 1">
                </div>
                <div>
                    <img src="https://mdbootstrap.com/img/new/slides/043.jpg" class="w-full h-auto object-cover rounded-lg"
                        alt="Banner 2">
                </div>
                <div>
                    <img src="https://mdbootstrap.com/img/new/slides/052.jpg" class="w-full h-auto object-cover rounded-lg"
                        alt="Banner 3">
                </div>
            </div>
        </div>
    </section>

    <div class="w-full max-w-[1140px] mx-auto">

        <div class="container mx-auto px-4">
            <div class="bg-gray-100 py-6">
                <!-- Bộ lọc -->
                <div class="bg-white rounded-lg shadow p-4 mb-6">
                    <form method="GET" action="#" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Tỉnh/Thành -->
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tỉnh/Thành phố</label>
                            <select name="location" class="w-full border-gray-300 rounded-lg">
                                <option value="">Tất cả</option>
                                <option value="hanoi">Hà Nội</option>
                                <option value="hcm">TP.HCM</option>
                                <!-- Add more options -->
                            </select>
                        </div>

                        <!-- Loại hình -->
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Loại hình</label>
                            <select name="type" class="w-full border-gray-300 rounded-lg">
                                <option value="">Tất cả</option>
                                <option value="apartment">Căn hộ</option>
                                <option value="land">Đất nền</option>
                                <!-- Add more -->
                            </select>
                        </div>

                        <!-- Giá -->
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Mức giá</label>
                            <select name="price" class="w-full border-gray-300 rounded-lg">
                                <option value="">Tất cả</option>
                                <option value="duoi-1-ty">Dưới 1 tỷ</option>
                                <option value="1-2-ty">1 - 2 tỷ</option>
                                <!-- More -->
                            </select>
                        </div>

                        <!-- Button -->
                        <div class="flex items-end">
                            <button type="submit"
                                class="w-full bg-[#E03C31] text-white py-2 px-4 rounded-lg hover:bg-[#c53028] transition">
                                Tìm kiếm
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Danh sách dự án -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($projects as $project)
                        <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition">
                            <a href="#">
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}"
                                    class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $project->title }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $project->location }}</p>
                                    <p class="text-[#E03C31] font-bold mt-2">{{ number_format($project->price) }} đ</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Phân trang -->
                {{-- <div class="mt-6">
                {{ $projects->links('pagination::tailwind') }}
            </div> --}}
            </div>
        </div>
    </div>

    <style>
        .slick-initialized .slick-slide {
            margin: 0;
        }
    </style>
@endsection
