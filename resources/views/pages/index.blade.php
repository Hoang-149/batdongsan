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
                            <select class="border p-2 rounded">
                                <option>Loại bất động sản</option>
                            </select>
                            <select class="border p-2 rounded">
                                <option>Khoảng giá</option>
                            </select>
                            <select class="border p-2 rounded">
                                <option>Diện tích</option>
                            </select>
                        </div>
                    </div>
                    <div class="content hidden" id="nha-dat-thue">
                        <div class="grid grid-cols-4 gap-4">
                            <input type="text" placeholder="Tìm kiếm địa điểm, khu vực" class="border p-2 rounded">
                            <select class="border p-2 rounded">
                                <option>Khoảng giá</option>
                            </select>
                            <select class="border p-2 rounded">
                                <option>Diện tích</option>
                            </select>
                        </div>
                    </div>
                    <div class="content hidden" id="du-an">
                        <div class="grid grid-cols-4 gap-4"> <input type="text" placeholder="Tìm kiếm địa điểm, khu vực"
                                class="border p-2 rounded">
                            <select class="border p-2 rounded">
                                <option>Loại bất động sản</option>
                            </select>
                            <select class="border p-2 rounded">
                                <option>Diện tích</option>
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
            <h2 class="text-2xl font-bold mb-6">Bất động sản nổi bật</h2>
            <div class="grid grid-cols-4 gap-6">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="border rounded-lg overflow-hidden">
                        <img src="assets/img/Anh-3.webp" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2">Căn hộ chung cư cao cấp</h3>
                            <p class="text-[#E03C31] font-bold">2.5 tỷ</p>
                            <p class="text-gray-600 text-sm mt-2">Quận 7, TP HCM</p>
                            <div class="flex gap-4 mt-2 text-sm text-gray-500">
                                <span>80m²</span>
                                <span>2 PN</span>
                                <span>2 WC</span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- News Section -->
        <div class="bg-gray-100 py-8">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold mb-6">Tin tức bất động sản</h2>
                <div class="grid grid-cols-3 gap-6">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-white rounded-lg overflow-hidden">
                            <img src="assets/img/Anh-3.webp" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">Thị trường bất động sản 2025</h3>
                                <p class="text-gray-600 text-sm">Cập nhật thông tin mới nhất về thị trường BĐS...</p>
                                <p class="text-gray-500 text-sm mt-2">18/06/2025</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Location Properties Section -->
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6">Bất động sản theo địa điểm</h2>
            <div class="grid grid-cols-3 gap-6">
                <!-- TP. Hồ Chí Minh Card -->
                <div class="relative rounded-lg overflow-hidden col-span-2">
                    <img src="assets/img/Anh-3.webp" class="w-full h-[250px] object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-xl font-bold text-white">TP. Hồ Chí Minh</h3>
                        <p class="text-white">68.230 tin đăng</p>
                    </div>
                </div>

                <!-- Hà Nội Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <img src="assets/img/Anh-3.webp" class="w-full h-[250px] object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-xl font-bold text-white">Hà Nội</h3>
                        <p class="text-white">62.007 tin đăng</p>
                    </div>
                </div>

                <!-- Đà Nẵng Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <img src="assets/img/Anh-3.webp" class="w-full h-[250px] object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-xl font-bold text-white">Đà Nẵng</h3>
                        <p class="text-white">10.593 tin đăng</p>
                    </div>
                </div>

                <!-- Bình Dương Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <img src="assets/img/Anh-3.webp" class="w-full h-[250px] object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-xl font-bold text-white">Bình Dương</h3>
                        <p class="text-white">8.551 tin đăng</p>
                    </div>
                </div>

                <!-- Đồng Nai Card -->
                <div class="relative rounded-lg overflow-hidden">
                    <img src="assets/img/Anh-3.webp" class="w-full h-[250px] object-cover">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <h3 class="text-xl font-bold text-white">Đồng Nai</h3>
                        <p class="text-white">3.979 tin đăng</p>
                    </div>
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
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition h-fit">
                    <a href="#"> <img src="assets/img/company.jpg" alt="Manga Cover"
                            class="w-full h-40 object-contain"></a>
                </div>
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
