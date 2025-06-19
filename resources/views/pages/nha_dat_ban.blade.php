@extends('layouts.main')
@section('title', 'Nhà đất bán')
@section('content')


    <div class="bg-gray-100 min-h-screen">
        <!-- Breadcrumb -->
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center text-sm">
                <a href="/" class="text-gray-600 hover:text-[#E03C31]">Trang chủ</a>
                <span class="mx-2">/</span>
                <span class="text-[#E03C31]">Nhà đất bán</span>
            </div>
        </div>

        <div class="bg-[#E03C31] py-6">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-lg p-4">
                    <div class="content active" id="nha-dat-ban">
                        <!-- Main Search -->
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="col-span-3">
                                <input type="text" placeholder="Tìm kiếm địa điểm, khu vực"
                                    class="w-full border rounded-lg p-2.5 focus:outline-none focus:border-[#E03C31]">
                            </div>

                            <div class="relative">
                                <select class="w-full border rounded-lg p-2.5 appearance-none bg-white">
                                    <option>Loại nhà đất</option>
                                    <option>Căn hộ chung cư</option>
                                    <option>Nhà riêng</option>
                                    <option>Đất nền</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select class="w-full border rounded-lg p-2.5 appearance-none bg-white">
                                    <option>Mức giá</option>
                                    <option>Dưới 1 tỷ</option>
                                    <option>1 - 2 tỷ</option>
                                    <option>2 - 3 tỷ</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select class="w-full border rounded-lg p-2.5 appearance-none bg-white">
                                    <option>Diện tích</option>
                                    <option>Dưới 30 m²</option>
                                    <option>30 - 50 m²</option>
                                    <option>50 - 80 m²</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Search -->
                        <div class="grid grid-cols-4 gap-4">
                            <div class="relative">
                                <select class="w-full border rounded-lg p-2.5 appearance-none bg-white">
                                    <option>Phòng ngủ</option>
                                    <option>1+</option>
                                    <option>2+</option>
                                    <option>3+</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select class="w-full border rounded-lg p-2.5 appearance-none bg-white">
                                    <option>Hướng nhà</option>
                                    <option>Đông</option>
                                    <option>Tây</option>
                                    <option>Nam</option>
                                    <option>Bắc</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                            </div>

                            <div class="col-span-2 text-right">
                                <button
                                    class="px-8 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-[#ca372d] transition-colors">
                                    Xem bản đồ
                                </button>
                                <button
                                    class="px-8 py-2.5 bg-[#E03C31] text-white rounded-lg hover:bg-[#ca372d] transition-colors">
                                    Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-4">
            <div class="flex gap-6">
                <!-- Left Sidebar Filters -->
                <div class="w-[300px] flex-shrink-0">
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <h3 class="font-semibold mb-4">Lọc theo khoảng giá</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">Dưới 1 tỷ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">1 - 2 tỷ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">2 - 3 tỷ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">3 - 5 tỷ</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-4 mb-4">
                        <h3 class="font-semibold mb-4">Lọc theo diện tích</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">Dưới 30 m²</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">30 - 50 m²</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">50 - 80 m²</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300">
                                <span class="ml-2">80 - 100 m²</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="flex-1">
                    <!-- Sort and View Options -->
                    <div class="bg-white rounded-lg p-4 mb-4 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            <span class="text-gray-600">108,234 kết quả</span>
                            <select class="border rounded px-2 py-1">
                                <option>Thông thường</option>
                                <option>Tin mới nhất</option>
                                <option>Giá thấp đến cao</option>
                                <option>Giá cao đến thấp</option>
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 border rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            <button class="p-2 border rounded hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Property Listings -->
                    <div class="space-y-4">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="bg-white rounded-lg p-4 flex gap-4">
                                <div class="w-[260px] flex-shrink-0">
                                    <img src="assets/img/Anh-3.webp" class="w-full h-[180px] object-cover rounded">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg text-[#E03C31] mb-2">
                                        Bán nhà riêng 80m² tại Quận 7
                                    </h3>
                                    <p class="text-[#E03C31] font-bold text-xl mb-2">2.8 tỷ</p>
                                    <p class="text-gray-600 mb-2">80m² - 3 PN - 2 WC</p>
                                    <p class="text-gray-500 text-sm mb-4">
                                        Nhà đẹp, vị trí thuận tiện, gần trường học, chợ, siêu thị...
                                    </p>
                                    <div class="flex justify-between items-end">
                                        <div class="text-gray-500 text-sm">
                                            <p>Đăng hôm nay</p>
                                            <p>Quận 7, TP HCM</p>
                                        </div>
                                        <button class="text-blue-600 hover:underline">
                                            Chi tiết
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-6">
                        <div class="flex gap-2">
                            <button class="px-4 py-2 border rounded hover:bg-gray-100">Trước</button>
                            <button class="px-4 py-2 border rounded bg-[#E03C31] text-white">1</button>
                            <button class="px-4 py-2 border rounded hover:bg-gray-100">2</button>
                            <button class="px-4 py-2 border rounded hover:bg-gray-100">3</button>
                            <button class="px-4 py-2 border rounded hover:bg-gray-100">...</button>
                            <button class="px-4 py-2 border rounded hover:bg-gray-100">Sau</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
