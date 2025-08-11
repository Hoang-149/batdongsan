@extends('layouts.main')
@section('title', 'Danh sách tin đăng')
@section('content')

    <div class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto px-4 max-w-7xl flex gap-8">

            <!-- Sidebar -->
            <x-sidebar_profile :user="$user" />

            <!-- Main Content -->
            <main class="flex-1">
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-2xl font-bold text-[#E03C31] mb-6">Danh sách tin đăng</h3>

                    @if ($properties->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($properties as $property)
                                <div
                                    class="border rounded-xl overflow-hidden shadow hover:shadow-lg transition duration-300">
                                    <div class="relative">
                                        @if ($property->images->count())
                                            <img src="{{ $property->images->first() ? asset($property->images->first()->image_url) : asset('assets/img/placeholder.jpg') }}"
                                                alt="{{ $property->title }}" class="w-full h-48 object-cover">
                                        @else
                                            <div
                                                class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                                Không có ảnh
                                            </div>
                                        @endif
                                        @if ($property->is_for_sale)
                                            <span
                                                class="absolute top-2 left-2 bg-green-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                                Giảm giá
                                            </span>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-semibold text-lg line-clamp-2">{{ $property->title }}</h4>
                                        <p class="text-sm text-gray-500 mb-2">
                                            {{ $property->location }}
                                        </p>
                                        <p class="text-red-600 font-bold mb-3">
                                            {{ number_format($property->price) }} VND
                                        </p>
                                        <div class="flex justify-between items-center text-sm">
                                            <a href="{{ route('admin.properties.index', $property->property_id) }}"
                                                class="text-blue-600 hover:underline">Xem</a>
                                            <a href="{{ route('user.properties.edit', $property->property_id) }}"
                                                class="text-yellow-600 hover:underline">Sửa</a>
                                            <form action="{{ route('admin.properties.destroy', $property->property_id) }}"
                                                method="POST" onsubmit="return confirm('Bạn chắc chắn xóa tin này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $properties->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">Bạn chưa đăng tin nào.</p>
                    @endif
                </div>
            </main>
        </div>
    </div>

@endsection
