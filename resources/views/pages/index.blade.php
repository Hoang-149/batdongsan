@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <div class="bg-gray-100">

        <div class="container mx-auto py-4">
        </div>
        <!-- Header Search Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 py-4 my-4">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-lg p-4">
                    <!-- Search Tabs -->
                    <nav class="flex gap-4 mb-4 nav-search">
                        <a href="#" class="block py-2 px-4 font-medium navbar" data-id="nha-dat-ban">Nhà đất bán</a>
                        <a href="#" class="block py-2 px-4 font-medium" data-id="nha-dat-thue">Nhà đất cho thuê</a>
                        <a href="#" class="block py-2 px-4 font-medium" data-id="du-an">Dự án</a>
                    </nav>

                    <div class="content acive" id="nha-dat-ban">
                        <div class="grid grid-cols-4 gap-4">
                            <input type="text" placeholder="Tìm kiếm địa điểm, khu vực" class="border p-2 rounded">
                            <select class="border p-2 rounded" id="property-type">
                                <option value="">Loại nhà đất</option>
                                <option value="1">Căn hộ chung cư</option>
                                <option value="2">Nhà riêng</option>
                                <option value="3">Đất nền</option>
                            </select>
                            <select class="border p-2 rounded" id="price-filter">
                                <option value="">Chọn mức giá</option>
                                <option value="under_1b">Dưới 1 tỷ</option>
                                <option value="1b_5b">1 - 5 tỷ</option>
                                <option value="over_5b">Trên 5 tỷ</option>
                            </select>
                            <select class="border p-2 rounded" id="area-filter">
                                <option value="">Diện tích</option>
                                <option value="under_30">Dưới 30 m²</option>
                                <option value="30_50">30 - 50 m²</option>
                                <option value="50_100">50 - 100 m²</option>
                                <option value="over_100">Trên 100 m²</option>
                            </select>
                        </div>
                    </div>
                    <div class="content hidden" id="nha-dat-thue">
                        <div class="grid grid-cols-4 gap-4">
                            <input type="text" placeholder="Tìm kiếm địa điểm, khu vực" class="border p-2 rounded">
                            <select class="border p-2 rounded" id="property-type">
                                <option value="">Loại nhà đất</option>
                                <option value="1">Căn hộ chung cư</option>
                                <option value="2">Nhà riêng</option>
                                <option value="3">Đất nền</option>
                            </select>
                            <select class="border p-2 rounded" id="price-filter">
                                <option value="">Chọn mức giá</option>
                                <option value="under_1b">Dưới 1 tỷ</option>
                                <option value="1b_5b">1 - 5 tỷ</option>
                                <option value="over_5b">Trên 5 tỷ</option>
                            </select>
                            <select class="border p-2 rounded" id="area-filter">
                                <option value="">Diện tích</option>
                                <option value="under_30">Dưới 30 m²</option>
                                <option value="30_50">30 - 50 m²</option>
                                <option value="50_100">50 - 100 m²</option>
                                <option value="over_100">Trên 100 m²</option>
                            </select>
                        </div>
                    </div>
                    <div class="content hidden" id="du-an">
                        <div class="grid grid-cols-4 gap-4"> <input type="text" placeholder="Tìm kiếm địa điểm, khu vực"
                                class="border p-2 rounded">
                            <select class="border p-2 rounded" id="price-filter">
                                <option value="">Chọn mức giá</option>
                                <option value="under_1b">Dưới 1 tỷ</option>
                                <option value="1b_5b">1 - 5 tỷ</option>
                                <option value="over_5b">Trên 5 tỷ</option>
                            </select>
                            <select class="border p-2 rounded" id="area-filter">
                                <option value="">Diện tích</option>
                                <option value="under_30">Dưới 30 m²</option>
                                <option value="30_50">30 - 50 m²</option>
                                <option value="50_100">50 - 100 m²</option>
                                <option value="over_100">Trên 100 m²</option>
                            </select>
                        </div>
                    </div>

                    {{-- <div class="flex justify-between mt-4">
                        <div class="flex gap-4">
                            <select class="border p-2 rounded">
                                <option>Số phòng ngủ</option>
                            </select>
                            <select class="border p-2 rounded">
                                <option>Hướng nhà</option>
                            </select>
                        </div>
                    </div> --}}
                    <button class="px-8 py-2 bg-[#E03C31] text-white rounded mt-6">Tìm kiếm</button>
                </div>
            </div>
        </div>

        <!-- Featured Properties Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl font-bold">Bất động sản nổi bật</h2>
                <span class="re__content-container-link">
                    <a class="text-base hover:text-red-700" href="/nha-dat-ban">Tin nhà đất bán mới nhất</a>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <a class="text-base hover:text-red-700" href="/nha-dat-thue">Tin nhà đất cho thuê mới nhất</a>
                </span>
            </div>
            <div class="grid grid-cols-4 gap-6">
                @forelse ($properties as $property)
                    <div
                        class="border rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                        <a href="{{ route('properties.show', $property->property_id) }}">
                            <img src="{{ $property->images->first() ? asset($property->images->first()->image_url) : asset('assets/img/placeholder.jpg') }}"
                                class="w-full h-48 object-cover" alt="{{ $property->title }}">
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $property->title }}</h3>
                                <p class="text-[#E03C31] font-bold">{{ number_format($property->price, 0, ',', '.') }} VNĐ
                                </p>
                                <p class="text-gray-600 text-sm mt-2">{{ $property->location ?? 'N/A' }}</p>
                                <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                    <span>{{ $property->area }}m²</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        No featured properties found.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- News Section -->
        <div class="bg-gray-100 py-8">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Tin tức bất động sản</h2>
                    <a href="{{ route('news') }}"
                        class="inline-flex items-center text-[#E03C31] hover:underline text-sm font-medium">
                        Xem thêm
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    @forelse ($news as $nws)
                        <div
                            class="border rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                            <a href="{{ route('news.detail', $nws->id) }}">
                                <img src="{{ $nws->thumbnail ? asset($nws->thumbnail) : asset('assets/img/placeholder.jpg') }}"
                                    class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2 hover:underline">{{ $nws->title }}</h3>
                                    <p class="text-gray-600 text-sm">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($nws->content), 100) }}</p>
                                    <p class="text-gray-500 text-sm mt-2">{{ $nws->create_ad }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            No news found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Location Properties Section -->
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6">Bất động sản theo địa điểm</h2>
            <div class="grid grid-cols-3 gap-6">
                <!-- TP. Hồ Chí Minh Card -->
                <div class="relative rounded-lg overflow-hidden col-span-2">
                    <a href="#">
                        <img src="assets/img/hcmcity.webp" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">TP. Hồ Chí Minh</h3>
                            <p class="text-white">68.230 tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Hà Nội Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="#">
                        <img src="assets/img/HN.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Hà Nội</h3>
                            <p class="text-white">62.007 tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Đà Nẵng Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="#">
                        <img src="assets/img/DN.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Đà Nẵng</h3>
                            <p class="text-white">10.593 tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Bình Dương Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="#">
                        <img src="assets/img/BD.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Bình Dương</h3>
                            <p class="text-white">8.551 tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Đồng Nai Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="#">
                        <img src="assets/img/DNN.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Đồng Nai</h3>
                            <p class="text-white">3.979 tin đăng</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Project Tags -->
            <div class="flex gap-3 mt-6 flex-wrap">
                <span class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 cursor-pointer">
                    Vinhomes Central Park
                </span>
                <span class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 cursor-pointer">
                    Vinhomes Grand Park
                </span>
                <span class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 cursor-pointer">
                    Vinhomes Smart City
                </span>
                <span class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 cursor-pointer">
                    Vinhomes Ocean Park
                </span>
                <span class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 cursor-pointer">
                    Vũng Tàu Pearl
                </span>
                <span class="px-4 py-2 bg-gray-100 rounded-full text-sm hover:bg-gray-200 cursor-pointer">
                    Bcons Green View
                </span>
            </div>
        </div>

        <div class="bg-gray-100 py-8">
            <h2 class="container mx-auto text-2xl font-bold mb-6">Doanh nghiệp tiêu biểu</h2>
            <div class="slider-section1-home ">
                {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div> --}}
                @forelse ($businesses as $business)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                        <a href="#">
                            <img src="{{ asset($business->image_url) }}" alt="Business Image"
                                class="w-full h-40 object-contain">
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        No typical businesses found.
                    </div>
                @endforelse
            </div>
        </div>


    </div>
    <script>
        jQuery(document).ready(function($) {
            $('nav.nav-search a').click(function(e) {
                e.preventDefault();
                var target = $(this).data('id');
                $('.content').addClass('hidden');
                $('nav a').removeClass('navbar');
                $(this).addClass('navbar');
                $('#' + target).removeClass('hidden');
            });
        });
    </script>

@endsection
