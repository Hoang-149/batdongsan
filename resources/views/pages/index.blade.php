@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <div class="bg-gray-100">

        <div class="container mx-auto py-4">
        </div>

        <!-- Header Search Section -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 py-6 my-6">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-lg p-6">

                    <!-- Search Tabs -->
                    <nav class="flex gap-2 mb-6 border-b border-gray-200 nav-search">
                        <a href="#"
                            class="py-2 px-6 font-medium text-gray-700 hover:text-red-500 border-b-2 border-transparent hover:border-red-500 transition-all active-tab"
                            data-id="ban">
                            <i class="fas fa-home mr-2"></i>Nhà đất bán
                        </a>
                        <a href="#"
                            class="py-2 px-6 font-medium text-gray-700 hover:text-red-500 border-b-2 border-transparent hover:border-red-500 transition-all"
                            data-id="thue">
                            <i class="fas fa-key mr-2"></i>Nhà đất cho thuê
                        </a>
                        <a href="#"
                            class="py-2 px-6 font-medium text-gray-700 hover:text-red-500 border-b-2 border-transparent hover:border-red-500 transition-all"
                            data-id="du-an">
                            <i class="fas fa-building mr-2"></i>Dự án
                        </a>
                    </nav>

                    <x-search-bar type="ban" />
                    <x-search-bar type="thue" />

                    <div class="tab-content hidden" id="du-an" data-type="du-an">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div class="relative">
                                <select id="tinh-select-du-an"
                                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-red-500">
                                    <option value="all">Tỉnh thành</option>
                                </select>
                            </div>
                            <!-- Price Range Dropdown -->
                            <div class="relative">
                                <select class="w-full border rounded-lg p-2.5 appearance-none bg-white"
                                    id="price-filter-du-an">
                                    <option value="">Chọn mức giá</option>
                                    <option value="under_5">Dưới 5 triệu/m²</option>
                                    <option value="5m_50m">5 - 50 triệu/m²</option>
                                    <option value="50m_100m">50 - 100 triệu/m²</option>
                                    <option value="over_100">Trên 100 triệu/m²</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>

                            <!-- status filter -->
                            <div class="relative">
                                <select id="status"
                                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-red-500">
                                    <option value="">Trạng thái</option>
                                    <option value="0">Sắp mở bán</option>
                                    <option value="1">Đang mở bán</option>
                                    <option value="2">Đã bàn giao</option>
                                </select>
                            </div>
                            <button id="search-button-du-an"
                                class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-8 py-3 rounded-xl font-semibold text-sm shadow-sm hover:shadow-md transition-all duration-300">
                                Tìm kiếm
                            </button>
                        </div>
                        <div id="quan-dropdown-du-an"
                            class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg max-h-64 overflow-y-auto hidden">
                            <ul id="quan-list-du-an" class="text-gray-700 text-base"></ul>
                        </div>
                    </div>
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
                        <a href="{{ route('properties.show', $property->slug) }}">
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
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-3 gap-6">
                    @forelse ($news as $nws)
                        <div
                            class="border rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                            <a href="{{ route('news.detail', $nws->slug) }}">
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
                    <a href="{{ url('/nha-dat-ban') }}?search_tinh={{ urlencode('Hồ Chí Minh') }}">
                        <img src="assets/img/hcmcity.webp" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">TP. Hồ Chí Minh</h3>
                            <p class="text-white">99+ tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Hà Nội Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="{{ url('/nha-dat-ban') }}?search_tinh={{ urlencode('Hà Nội') }}">
                        <img src="assets/img/HN.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Hà Nội</h3>
                            <p class="text-white">99+ tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Đà Nẵng Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="{{ url('/nha-dat-ban') }}?search_tinh={{ urlencode('Đà Nẵng') }}">
                        <img src="assets/img/DN.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Đà Nẵng</h3>
                            <p class="text-white">99 tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Bình Dương Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="{{ url('/nha-dat-ban') }}?search_tinh={{ urlencode('Bình Dương') }}">
                        <img src="assets/img/BD.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Bình Dương</h3>
                            <p class="text-white">99+ tin đăng</p>
                        </div>
                    </a>
                </div>

                <!-- Đồng Nai Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <a href="{{ url('/nha-dat-ban') }}?search_tinh={{ urlencode('Đồng Nai') }}">
                        <img src="assets/img/DNN.jpg" class="w-full h-[250px] object-cover">
                        <div
                            class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent hover:underline text-white">
                            <h3 class="text-xl font-bold text-white">Đồng Nai</h3>
                            <p class="text-white">3.979 tin đăng</p>
                        </div>
                    </a>
                </div>
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

    @vite('resources/js/index.js')

    @if (session('error_login'))
        <script>
            alert("{{ session('error_login') }}");
        </script>
    @endif

@endsection
