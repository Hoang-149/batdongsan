@extends('layouts.main')
@section('title', '403 - Không có quyền truy cập')
@section('content')

    <div class="bg-gray-100 min-h-screen py-8">
        <div class="text-center">
            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-4">Bạn không có quyền truy cập trang này.</p>
            <p class="text-gray-500 mt-2">Nếu bạn nghĩ đây là lỗi, vui lòng liên hệ quản trị viên.</p>

            <div class="mt-6">
                <a href="{{ url('/') }}"
                    class="px-6 py-3 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 transition">
                    ⬅️ Về trang chủ
                </a>
                <a href="javascript:history.back()"
                    class="px-6 py-3 bg-gray-300 text-gray-800 rounded-lg shadow-md hover:bg-gray-400 transition">
                    🔙 Quay lại
                </a>
            </div>
        </div>
    </div>

@endsection
