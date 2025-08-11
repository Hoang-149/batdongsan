@extends('layouts.main')

@section('title', $project->project_name)

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('projects') }}" class="hover:underline">Dự án</a>
                <span class="mx-2">/</span>
                <span class="text-[#E03C31]">{{ Str::limit($project->project_name, 50) }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Nội dung chính --}}
                <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
                    {{-- Slider ảnh --}}
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($project->images as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset($img->image_url) }}" alt="{{ $project->project_name }}"
                                        class="w-full h-96 object-cover">
                                </div>
                            @endforeach
                        </div>
                        {{-- Nút điều hướng --}}
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <div class="p-6 lg:p-8">
                        {{-- Tiêu đề --}}
                        <h1 class="text-3xl font-extrabold text-gray-800 mb-4">{{ $project->project_name }}</h1>

                        {{-- Meta --}}
                        <div
                            class="flex flex-col sm:flex-row sm:items-center text-gray-500 text-sm mb-6 space-y-2 sm:space-y-0 sm:space-x-4">
                            <span><strong>Diện tích:</strong> {{ number_format($project->area, 0, ',', '.') }} m²</span>
                            <span>•</span>
                            <span><strong>Giá:</strong> {{ number_format($project->price, 0, ',', '.') }} đ</span>
                            <span>•</span>
                            <span><strong>Vị trí:</strong> {{ $project->location }}</span>
                        </div>

                        {{-- Nội dung --}}
                        <div class="prose prose-lg max-w-full text-gray-700 leading-relaxed">
                            {!! $project->description !!}
                        </div>

                        {{-- Thông tin công ty --}}
                        <div class="mt-8 border-t pt-6 flex items-center">
                            {{-- <img src="{{ asset('assets/img/company-logo.png') }}" alt="Logo" class="w-8 h-8 mr-3"> --}}
                            <span class="text-sm text-gray-800 font-semibold">Chủ đầu tư: </span>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="text-sm text-gray-800 font-medium">
                                {{ $project->user->full_name ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <aside class="space-y-8">
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Dự án khác</h2>
                        <ul class="space-y-4">
                            @foreach ($otherProjects as $item)
                                <li class="flex items-start space-x-3">
                                    <div class="w-20 h-14 flex-shrink-0 overflow-hidden rounded">
                                        <img src="{{ $item->images->first() ? asset($item->images->first()->image_url) : asset('assets/img/placeholder.jpg') }}"
                                            alt="{{ $item->project_name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <a href="{{ route('project.detail', $item->project_id) }}"
                                            class="text-sm font-semibold text-gray-800 hover:text-red-600">
                                            {{ Str::words($item->project_name, 10, '...') }}
                                        </a>
                                        <p class="text-xs text-gray-500">{{ number_format($item->price, 0, ',', '.') }} đ
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <style>
        /* Màu và kích thước nút điều hướng */
        .swiper-button-next,
        .swiper-button-prev {
            color: #E03C31;
            /* Màu đỏ */
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            padding: 8px;
            width: 40px;
            height: 40px;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
            /* Kích thước mũi tên */
            font-weight: bold;
        }

        /* Hover đổi màu */
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: #E03C31;
            color: #fff;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            autoplay: {
                delay: 3000, // 3 giây đổi ảnh
                disableOnInteraction: false, // vẫn chạy khi người dùng tương tác
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
@endsection
