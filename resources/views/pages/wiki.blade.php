@extends('layouts.main')
@section('title', 'Wiki bất động sản')
@section('content')

    <div class="bg-gray-100 min-h-screen">
        <!-- Breadcrumb -->
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center text-sm">
                <a href="/" class="text-gray-600 hover:text-[#E03C31]">Trang chủ</a>
                <span class="mx-2">/</span>
                <span class="text-[#E03C31]">Wiki</span>
            </div>
        </div>

        <div class="container mx-auto px-4 py-6 max-w-7xl">
            <!-- Title -->
            <h1 class="text-3xl font-bold mb-6">Wiki bất động sản</h1>

            <!-- Wiki Categories -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div
                    class="bg-white rounded-lg shadow p-6 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="assets/img/phuyen.jpg" class="w-20 h-20 object-contain mb-4" alt="Pháp lý">
                    <h2 class="font-semibold text-lg mb-2 text-[#E03C31]">Pháp lý</h2>
                    <p class="text-gray-600 mb-2">Kiến thức pháp luật, thủ tục, quy trình mua bán, chuyển nhượng bất động
                        sản.</p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">Xem chi tiết</a>
                </div>
                <div
                    class="bg-white rounded-lg shadow p-6 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="assets/img/phuyen.jpg" class="w-20 h-20 object-contain mb-4" alt="Tài chính">
                    <h2 class="font-semibold text-lg mb-2 text-[#E03C31]">Tài chính</h2>
                    <p class="text-gray-600 mb-2">Thông tin về vay vốn, lãi suất, đầu tư, quản lý tài chính khi mua bán nhà
                        đất.</p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">Xem chi tiết</a>
                </div>
                <div
                    class="bg-white rounded-lg shadow p-6 flex flex-col items-center text-center hover:shadow-lg transition">
                    <img src="assets/img/phuyen.jpg" class="w-20 h-20 object-contain mb-4" alt="Phong thủy">
                    <h2 class="font-semibold text-lg mb-2 text-[#E03C31]">Phong thủy</h2>
                    <p class="text-gray-600 mb-2">Kiến thức phong thủy nhà ở, chọn hướng, bố trí không gian hợp mệnh.</p>
                    <a href="#" class="text-blue-600 hover:underline text-sm">Xem chi tiết</a>
                </div>
            </div>

            <!-- Wiki Articles List -->
            <h2 class="text-2xl font-bold mb-4">Bài viết nổi bật</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for ($i = 1; $i <= 6; $i++)
                    <div class="bg-white rounded-lg shadow p-4 flex flex-col h-full hover:shadow-lg transition">
                        <a href="#">
                            <img src="assets/img/phuyen.jpg" class="w-full h-40 object-cover rounded mb-3" alt="">
                        </a>
                        <h3 class="font-semibold text-lg mb-2 hover:underline cursor-pointer">
                            Tiêu đề bài viết Wiki {{ $i }}
                        </h3>
                        <p class="text-gray-600 flex-1 mb-2">
                            Mô tả ngắn về bài viết Wiki số {{ $i }}. Thông tin hữu ích về pháp lý, tài chính,
                            phong thủy...
                        </p>
                        <div class="flex items-center text-gray-400 text-xs gap-2">
                            <span>10/06/2025</span>
                            <span>|</span>
                            <span>Chuyên mục: Wiki</span>
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
