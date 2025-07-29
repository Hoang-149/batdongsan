@extends('layouts.main')
@section('title', 'Quản lý tài khoản')
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
                <div class="bg-white rounded-xl shadow p-8">
                    <h1 class="text-2xl font-bold mb-6">Quản lý tài khoản</h1>
                    <!-- Tabs -->
                    <div class="flex border-b mb-8">
                        <button
                            class="py-2 px-4 border-b-2 border-[#E03C31] text-[#E03C31] font-semibold focus:outline-none">Chỉnh
                            sửa thông tin</button>
                        <button class="py-2 px-4 text-gray-600 hover:text-[#E03C31] font-semibold focus:outline-none">Cài
                            đặt tài khoản</button>
                        <button
                            class="py-2 px-4 text-gray-600 hover:text-[#E03C31] font-semibold focus:outline-none relative">
                            Đăng ký Môi giới chuyên nghiệp
                            <span
                                class="absolute -top-2 -right-4 bg-[#E03C31] text-white text-xs px-2 py-0.5 rounded-full">Mới</span>
                        </button>
                    </div>

                    <!-- Popup Đăng ký môi giới chuyên nghiệp -->
                    {{-- <div class="relative mb-8">
                        <div class="absolute right-0 -top-4 w-96 z-10">
                            <div class="bg-purple-700 text-white rounded-lg shadow-lg p-5 relative">
                                <button class="absolute top-2 right-2 text-white text-lg font-bold">&times;</button>
                                <div class="font-semibold mb-1">Đăng ký Môi giới chuyên nghiệp</div>
                                <div class="text-sm mb-3">Nâng tầm thương hiệu cá nhân, tiếp cận nhiều khách hàng tiềm năng
                                    với vị trí hiển thị nổi bật và độc quyền</div>
                                <button
                                    class="w-full bg-white text-purple-700 font-semibold py-2 rounded hover:bg-purple-100 transition">Đăng
                                    ký miễn phí</button>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Form -->
                    <form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Họ và tên</label>
                                <input type="text" value="Thắng Hoàng Minh"
                                    class="w-full border rounded-lg px-4 py-2 bg-gray-50" />
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Mã số thuế cá nhân</label>
                                <input type="text" placeholder="Ví dụ: 1234567890 hoặc 1234567890-123"
                                    class="w-full border rounded-lg px-4 py-2 bg-gray-50" />
                                <div class="text-xs text-gray-400 mt-1">MST gồm 10 hoặc 13 chữ số</div>
                            </div>
                        </div>
                        <hr class="my-8">
                        <div>
                            <h2 class="text-lg font-semibold mb-4">Thông tin liên hệ</h2>
                            <div class="block w-full gap-4 mb-4">
                                <label class="block text-gray-700 font-medium mb-1">Số điện thoại chính</label>
                                <div class="flex items-center">
                                    <input type="text" class="w-full border rounded-lg px-4 py-2 bg-gray-50 flex-1" />
                                    <button type="button"
                                        class="text-[#E03C31] font-semibold flex items-center gap-1 hover:underline">
                                        <span class="text-xl">+</span> Thêm số điện thoại
                                    </button>
                                </div>

                                <div class="flex-1">
                                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                                    <input type="email" class="w-full border rounded-lg px-4 py-2 bg-gray-50" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-8">
                            <button type="submit"
                                class="bg-[#E03C31] text-white font-semibold px-8 py-3 rounded-lg hover:bg-red-700 transition">Lưu
                                thay đổi</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
