{{-- filepath: resources/views/pages/frontend/profile.blade.php --}}
@extends('layouts.main')
@section('title', 'Quản lý tài khoản')
@section('content')

    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-7xl flex flex-col md:flex-row gap-8">

            <!-- Sidebar -->
            <x-sidebar_profile :user="$user" />

            <!-- Main Content -->
            <main class="flex-1">
                <div class="bg-white rounded-xl shadow p-8">
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg flex items-center justify-between"
                            role="alert">
                            <span class="font-medium">{{ session('success') }}</span>
                            <button type="button" class="text-green-700 hover:text-green-900 text-lg font-bold"
                                data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    @endif
                    <h1 class="text-2xl font-bold mb-6">Quản lý tài khoản</h1>
                    <!-- Tabs -->
                    <div class="flex border-b mb-8 flex-wrap">
                        <button id="tab-info"
                            class="py-2 px-4 border-b-2 border-[#E03C31] text-[#E03C31] font-semibold focus:outline-none">Chỉnh
                            sửa thông tin</button>
                        <button id="tab-setting"
                            class="py-2 px-4 text-gray-600 hover:text-[#E03C31] font-semibold focus:outline-none">Cài
                            đặt tài khoản</button>
                        <button id="tab-pro-agent"
                            class="py-2 px-4 text-gray-600 hover:text-[#E03C31] font-semibold focus:outline-none relative">
                            Đăng ký Môi giới chuyên nghiệp
                            <span
                                class="absolute -top-2 -right-4 bg-[#E03C31] text-white text-xs px-2 py-0.5 rounded-full">Mới</span>
                        </button>
                    </div>

                    <!-- Popup Đăng ký môi giới chuyên nghiệp -->
                    <div id="pro-agent-popup"
                        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                        <div class="bg-purple-700 text-white rounded-lg shadow-lg p-5 relative w-full max-w-md mx-auto">
                            <button id="close-pro-agent"
                                class="absolute top-2 right-2 text-white text-lg font-bold">&times;</button>
                            <div class="font-semibold mb-1">Đăng ký Môi giới chuyên nghiệp</div>
                            <div class="text-sm mb-3">Nâng tầm thương hiệu cá nhân, tiếp cận nhiều khách hàng tiềm năng
                                với vị trí hiển thị nổi bật và độc quyền</div>
                            <button
                                class="w-full bg-white text-purple-700 font-semibold py-2 rounded hover:bg-purple-100 transition">Đăng
                                ký miễn phí</button>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-xl font-semibold mb-4">Thông tin cá nhân</h3>
                        <div class="flex justify-center mb-4">
                            <div class="avatar-upload">
                                <label for="avatar" class="avatar-label ">
                                    <i class="fas fa-camera"></i>
                                    <input type="file" id="avatar" name="avatar" accept="image/*" hidden>
                                </label>
                                <img id="avatarPreview"
                                    src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : 'https://via.placeholder.com/120' }}"
                                    alt="avatar" class="avatar-img" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Họ và tên</label>
                                <input type="text" name="full_name" value="{{ $user->full_name }}"
                                    class="w-full border rounded-lg px-4 py-2 bg-gray-50" />
                                @error('full_name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1">Mã số thuế cá nhân</label>
                                <input type="text" name="msThue" placeholder="Ví dụ: 1234567890 hoặc 1234567890-123"
                                    value="{{ $user->msThue }}" class="w-full border rounded-lg px-4 py-2 bg-gray-50" />
                                @error('msThue')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-8">
                        <div>
                            <h2 class="text-lg font-semibold mb-4">Thông tin liên hệ</h2>
                            <div class="block w-full gap-4 mb-4">
                                <label class="block text-gray-700 font-medium mb-1">Số điện thoại chính</label>
                                <input type="phone" name="phone_number"
                                    class="w-full border rounded-lg px-4 py-2 bg-gray-50"
                                    value="{{ $user->phone_number }}" />
                                @error('phone_number')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror

                                <div class="flex-1 mt-4">
                                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                                    <input type="email" name="email"
                                        class="w-full border rounded-lg px-4 py-2 bg-gray-50" value="{{ $user->email }}" />
                                    @error('email')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
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

    <style>
        .avatar-upload {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 2px dashed #ddd;
        }

        .avatar-label {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #fff;
            border-radius: 50%;
            padding: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .avatar-label i {
            font-size: 16px;
            color: #333;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            // Avatar preview
            $("#avatar").on("change", function(e) {
                let file = e.target.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $("#avatarPreview").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Popup môi giới chuyên nghiệp
            $("#tab-pro-agent").on("click", function(e) {
                e.preventDefault();
                $("#pro-agent-popup").removeClass("hidden");
            });
            $("#close-pro-agent").on("click", function() {
                $("#pro-agent-popup").addClass("hidden");
            });
            // Đóng popup khi click nền tối
            $("#pro-agent-popup").on("click", function(e) {
                if (e.target === this) {
                    $(this).addClass("hidden");
                }
            });
        });
    </script>
@endsection
