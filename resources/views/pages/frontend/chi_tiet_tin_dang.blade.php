@extends('layouts.main')
@section('title', $property->title)
@section('content')

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <a href="{{ route('home') }}" class="text-red-600 hover:underline mb-4 inline-block">&larr; Trở về Home</a>
            <h1 class="text-3xl font-bold mb-6">{{ $property->title }}</h1>

            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <!-- Main Slider -->
                    <div class="main-slider relative">
                        @forelse ($property->images as $image)
                            <div class="relative">
                                <img src="{{ asset($image->image_url) }}" alt="Property Image"
                                    class="w-full h-[400px] object-cover rounded-lg">
                            </div>
                        @empty
                            <div class="relative">
                                <img src="{{ asset('assets/img/placeholder.jpg') }}" alt="Placeholder Image"
                                    class="w-full h-[400px] object-cover rounded-lg">
                            </div>
                        @endforelse
                    </div>

                    <!-- Thumbnail Slider (Syncing) -->
                    <div class="thumbnail-slider mt-4 px-12">
                        @forelse ($property->images as $image)
                            <div class="px-1">
                                <img src="{{ asset($image->image_url) }}" alt="Property Thumbnail"
                                    class="w-full h-20 object-cover rounded cursor-pointer opacity-50 hover:opacity-100">
                            </div>
                        @empty
                            <div class="px-1">
                                <img src="{{ asset('assets/img/placeholder.jpg') }}" alt="Placeholder Thumbnail"
                                    class="w-full h-20 object-cover rounded cursor-pointer opacity-50 hover:opacity-100">
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Đặc điểm bất động sản</h3>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-y-4 border border-gray-200 rounded-lg divide-y md:divide-y-0 md:divide-x">
                            <!-- Mức giá -->
                            <div class="flex items-center justify-between px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-dollar-sign text-red-500"></i>
                                    <span class="font-semibold">Mức giá</span>
                                </div>
                                <span class="text-gray-700">
                                    @if ($property->price)
                                        {{ format_price($property->price) }}
                                    @else
                                        Liên hệ <a href="tel:{{ $property->user->phone_number }}"
                                            class="font-semibold">{{ $property->user->phone_number }}</a>
                                    @endif
                                </span>

                            </div>

                            <!-- Nhu cầu -->
                            <div class="flex items-center justify-between px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-home text-red-500"></i>
                                    <span class="font-semibold">Nhu cầu</span>
                                </div>
                                <span class="text-gray-700">
                                    @if ($property->demande == 0)
                                        Thuê
                                    @elseif($property->demande == 1)
                                        Bán
                                    @elseif($property->demande == 2)
                                        Thuê và Bán
                                    @endif
                                </span>
                            </div>

                            <!-- Diện tích -->
                            <div class="flex items-center justify-between px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-vector-square text-red-500"></i>
                                    <span class="font-semibold">Diện tích</span>
                                </div>
                                <span class="text-gray-700">{{ $property->area }} m²</span>
                            </div>

                            <!-- Vị trí -->
                            <div class="flex items-center justify-between px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                    <span class="font-semibold w-12">Vị trí</span>
                                </div>
                                <span class="text-gray-700">{{ $property->location }}</span>
                            </div>
                        </div>
                    </div>


                    <!-- Property Details -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Thông tin mô tả</h3>
                        <p class="text-gray-600 mb-2">
                            {!! $property->description !!}
                        </p>
                        @if ($property->isVipActive())
                            <p class="text-green-600 font-semibold mb-2">VIP Property (Expires:
                                {{ $property->vip_expires_at->format('d/m/Y') }})</p>
                        @endif
                    </div>

                    <div class="mt-8 border-t pt-6 flex flex-wrap gap-4">
                        <span class="font-semibold text-gray-600">Chia sẻ:</span>
                        <a href="#" class="text-red-600 hover:underline">Facebook</a>
                        <a href="#" class="text-red-500 hover:underline">Zalo</a>
                        <button onclick="copyLink()" class="text-red-400 hover:underline">Sao chép liên kết</button>
                    </div>
                </div>
                <div class="md:col-span-1 p-4 bg-gray-100 rounded-lg">
                    <!-- Profile Section -->
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <img src="{{ $property->user->avatar ? asset($property->user->avatar) : 'https://via.placeholder.com/120' }}"
                                alt="avatar" class="w-12 h-12 rounded-full mr-4 border-2 border-blue-500">
                            <div>
                                <div class="font-bold text-xl text-gray-800">{{ $property->user->full_name }}</div>
                                <div class="text-sm text-gray-500">Xem thêm 3 tin khác</div>
                            </div>
                        </div>
                        <a href="https://zalo.me/{{ $property->user->phone_number }}" id="btnZalo"
                            class="inline-block text-black px-6 py-3 rounded-lg border-solid border-2 mb-3 text-center w-full font-medium transition-colors duration-200">Chat
                            qua Zalo</a>
                        <a href="tel:{{ $property->user->phone_number }}" id="btnCall"
                            class="inline-block bg-teal-600 text-white px-6 py-3 rounded-lg text-center w-full font-medium hover:bg-teal-700 transition-colors duration-200">
                            <i class="fa-solid fa-phone-volume"></i>
                            {{ $property->user->phone_number }}
                            @if (!auth()->user())
                                ?? - Hiện số
                            @endif
                        </a>
                    </div>

                    <!-- Property List Section -->
                    <div
                        class="mt-6 text-gray-700 bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Tin liên quan</h2>
                        <ul class="space-y-4">
                            @foreach ($otherProperty as $item)
                                <li class="flex items-start space-x-3">
                                    <div class="w-20 h-14 flex-shrink-0 overflow-hidden rounded">
                                        <img src="{{ $item->images->first() ? asset($item->images->first()->image_url) : asset('assets/img/placeholder.jpg') }}"
                                            alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <a href="{{ route('properties.show', $item->slug) }}"
                                            class="text-sm font-semibold text-gray-800 hover:text-red-600">
                                            {{ Str::words($item->title, 5, '...') }}
                                        </a>
                                        <p class="text-xs text-gray-500">{{ Str::words($item->location, 10, '...') }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href)
                .then(() => alert('Link đã được sao chép!'));
        }

        $(document).ready(function() {

            const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

            $('#btnZalo, #btnCall').on('click', function(e) {
                if (!isAuthenticated) {
                    e.preventDefault();
                    alert('Vui lòng đăng nhập để chat qua Zalo!');
                }
            });

            // Main Slider
            $('.main-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev absolute left-4 top-1/2 -translate-y-1/2 text-white p-3 z-10"><</button>',
                nextArrow: '<button type="button" class="slick-next absolute right-8 top-1/2 -translate-y-1/2 text-white p-3 z-10"></button>',
                fade: true,
                asNavFor: '.thumbnail-slider',
                adaptiveHeight: true
            });

            // Thumbnail Slider
            $('.thumbnail-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.main-slider',
                dots: false,
                arrows: false,
                centerMode: true,
                focusOnSelect: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2
                        }
                    }
                ]
            });
        });
    </script>
@endsection
