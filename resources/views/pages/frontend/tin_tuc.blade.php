@extends('layouts.main')
@section('title', 'Tin tức bất động sản')
@section('content')

    <div class="bg-gray-100 min-h-screen">
        <!-- Breadcrumb -->
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center text-sm">
                <a href="/" class="text-gray-600 hover:text-[#E03C31]">Trang chủ</a>
                <span class="mx-2">/</span>
                <span class="text-[#E03C31]">Tin tức</span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-6 max-w-7xl">
            <!-- Title -->
            <h1 class="text-3xl font-bold mb-6 justify-center text-center">Tin tức bất động sản mới nhất</h1>
            <p class="text-center text-xl max-w-3xl justify-center m-auto mb-8">Thông tin mới, đầy đủ, hấp dẫn về thị trường
                bất
                động sản
                Việt Nam thông
                qua
                dữ
                liệu lớn
                về giá, giao dịch, nguồn cung - cầu và khảo sát thực tế của đội ngũ phóng viên, biên tập của
                CafeBizLandGroup.</p>

            <!-- News Highlight -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="md:col-span-2 bg-white rounded-lg shadow p-4 flex flex-col md:flex-row gap-4">
                    <img src="assets/img/phuyen.jpg" alt="Tin nổi bật" class="w-full md:w-2/5 h-56 object-cover rounded-lg">
                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-bold mb-2 text-[#E03C31] hover:underline cursor-pointer">
                                Thị trường bất động sản 2025: Xu hướng và cơ hội đầu tư
                            </h2>
                            <p class="text-gray-600 mb-2">
                                Cập nhật những xu hướng mới nhất của thị trường bất động sản năm 2025, cơ hội và thách thức
                                cho nhà đầu tư...
                            </p>
                        </div>
                        <div class="flex items-center text-gray-400 text-sm gap-4">
                            <span>18/06/2025</span>
                            <span>Chuyên mục: Phân tích</span>
                        </div>
                    </div>
                </div>
                <!-- Tin phụ nổi bật -->
                <div class="flex flex-col gap-4">
                    <div class="bg-white rounded-lg shadow p-3 flex gap-3">
                        <img src="assets/img/phuyen.jpg" class="w-28 h-20 object-cover rounded" alt="">
                        <div>
                            <h3 class="font-semibold text-base mb-1 hover:underline cursor-pointer">Giá nhà đất tại TP.HCM
                                tăng mạnh</h3>
                            <span class="text-gray-400 text-xs">17/06/2025</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-3 flex gap-3">
                        <img src="assets/img/phuyen.jpg" class="w-28 h-20 object-cover rounded" alt="">
                        <div>
                            <h3 class="font-semibold text-base mb-1 hover:underline cursor-pointer">Dự án mới nổi bật tháng
                                6</h3>
                            <span class="text-gray-400 text-xs">16/06/2025</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-3 flex gap-3">
                        <img src="assets/img/phuyen.jpg" class="w-28 h-20 object-cover rounded" alt="">
                        <div>
                            <h3 class="font-semibold text-base mb-1 hover:underline cursor-pointer">Dự án mới nổi bật tháng
                                6</h3>
                            <span class="text-gray-400 text-xs">16/06/2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách tin tức -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 9; $i++)
                    <div class="bg-white rounded-lg shadow p-4 flex flex-col h-full">
                        <a href="#">
                            <img src="assets/img/phuyen.jpg" class="w-full h-44 object-cover rounded mb-3" alt="">
                        </a>
                        <h3 class="font-semibold text-lg mb-2 hover:underline cursor-pointer">
                            Tiêu đề tin tức bất động sản {{ $i }}
                        </h3>
                        <p class="text-gray-600 flex-1 mb-2">
                            Mô tả ngắn về tin tức bất động sản số {{ $i }}. Thông tin nổi bật, cập nhật mới nhất
                            về thị trường...
                        </p>
                        <div class="flex items-center text-gray-400 text-xs gap-2">
                            <span>15/06/2025</span>
                            <span>|</span>
                            <span>Chuyên mục: Tin tức</span>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                    <a href="#"
                        class="px-4 py-2 border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">Trước</a>
                    <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-[#E03C31] text-white">1</a>
                    <a href="#" class="px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">2</a>
                    <a href="#" class="px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">3</a>
                    <span class="px-4 py-2 border border-gray-300 bg-white text-gray-400">...</span>
                    <a href="#"
                        class="px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-50">Sau</a>
                </nav>
            </div>
        </div>
    </div>

@endsection
