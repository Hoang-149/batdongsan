@extends('layouts.main')
@section('title', 'Detail Property')
@section('content')

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <a href="{{ route('home') }}" class="text-red-600 hover:underline mb-4 inline-block">&larr; Back to Home</a>
            <h1 class="text-3xl font-bold mb-6">{{ $property->title }}</h1>

            <!-- Image Gallery -->
            {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                @forelse ($property->images as $image)
                    <img src="{{ asset($image->image_url) }}" alt="Property Image" class="w-full h-64 object-cover rounded-lg">
                @empty
                    <img src="{{ asset('assets/img/placeholder.jpg') }}" alt="Placeholder Image"
                        class="w-full h-64 object-cover rounded-lg">
                @endforelse
            </div> --}}
            <div class="mb-6 mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
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

                    <!-- Property Details -->
                    <div class="mt-8">
                        <p class="text-[#E03C31] font-bold text-2xl mb-2">{{ number_format($property->price, 0, ',', '.') }}
                            VNĐ</p>
                        <p class="text-gray-600 mb-2"><strong>Location:</strong> {{ $property->location }}</p>
                        <p class="text-gray-600 mb-2"><strong>Area:</strong> {{ $property->area }}m²</p>
                        <p class="text-gray-600 mb-2"><strong>Description:</strong>
                            {{ $property->description ?: 'No description available.' }}</p>
                        @if ($property->isVipActive())
                            <p class="text-green-600 font-semibold mb-2">VIP Property (Expires:
                                {{ $property->vip_expires_at->format('d/m/Y') }})</p>
                        @endif
                    </div>
                </div>
                <div class="md:col-span-1 p-4 bg-gray-100 rounded-lg">
                    <!-- Profile Section -->
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center mb-6">
                            <img src="https://via.placeholder.com/50" alt="Profile Picture"
                                class="w-12 h-12 rounded-full mr-4 border-2 border-blue-500">
                            <div>
                                <div class="font-bold text-xl text-gray-800">{{ $property->user->full_name }}</div>
                                <div class="text-sm text-gray-500">Xem thêm 3 tin khác</div>
                            </div>
                        </div>
                        <a href="#"
                            class="inline-block text-black px-6 py-3 rounded-lg border-solid border-2 mb-3 text-center w-full font-medium transition-colors duration-200">Chat
                            qua Zalo</a>
                        <a href="tel:{{ $property->user->phone_number }}"
                            class="inline-block bg-teal-600 text-white px-6 py-3 rounded-lg text-center w-full font-medium hover:bg-teal-700 transition-colors duration-200">📞
                            {{ $property->user->phone_number }} - Hiện số</a>
                    </div>

                    <!-- Property List Section -->
                    <div
                        class="mt-6 text-gray-700 bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <p class="text-lg font-semibold text-gray-900">Bán căn hộ chung cư theo dự án tại</p>
                        <p class="text-md text-gray-600 mt-1">Quận Nam Từ Liêm</p>
                        <ul class="list-disc pl-6 mt-4 space-y-2">
                            <li class="text-gray-800 hover:text-blue-600 transition-colors duration-200"><span
                                    class="font-medium">The Sapphire - Vinhomes Smart City</span> (122)</li>
                            <li class="text-gray-800 hover:text-blue-600 transition-colors duration-200"><span
                                    class="font-medium">Vinhomes Grandenia</span> (112)</li>
                            <li class="text-gray-800 hover:text-blue-600 transition-colors duration-200"><span
                                    class="font-medium">The Zei Mỹ Đình</span> (77)</li>
                            <li class="text-gray-800 hover:text-blue-600 transition-colors duration-200"><span
                                    class="font-medium">Golden Palace</span> (74)</li>
                            <li class="text-gray-800 hover:text-blue-600 transition-colors duration-200"><span
                                    class="font-medium">The Matrix One Premium</span> (70)</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Main Slider
            $('.main-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev absolute left-4 top-1/2 -translate-y-1/2 text-white p-3 z-10"><</button>',
                nextArrow: '<button type="button" class="slick-next absolute right-4 top-1/2 -translate-y-1/2 text-white p-3 z-10"></button>',
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
