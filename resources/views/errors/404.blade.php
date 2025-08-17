@extends('layouts.main')
@section('title', '404 - Không tìm thấy trang')
@section('content')

    <div class="bg-gray-100 min-h-screen py-8">
        <div class="text-center">
            <p class="text-2xl md:text-3xl font-bold text-gray-800 mt-4">Oops! Trang bạn tìm không tồn tại.</p>
            <p class="text-gray-500 mt-2">Có thể đường dẫn bị sai hoặc trang đã bị xóa.</p>

            <div class="mt-6">
                <a href="{{ url('/') }}"
                    class="px-6 py-3 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 transition">
                    ⬅️ Về trang chủ
                </a>
            </div>
        </div>
    </div>

@endsection
