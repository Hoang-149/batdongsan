@extends('layouts.main')

@section('title', $news->title)

@section('content')
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-gray-500 mb-6">
                <a href="{{ route('news') }}" class="hover:underline">Tin tức</a>
                <span class="mx-2">/</span>
                <span class="text-[#E03C31]">{{ Str::limit($news->title, 50) }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
                    {{-- Ảnh bìa --}}
                    <div class="w-full overflow-hidden">
                        <img src="{{ asset($news->thumbnail) }}" alt="Thumbnail"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    </div>

                    <div class="p-6 lg:p-8">
                        {{-- Tiêu đề --}}
                        <h1 class="text-3xl font-extrabold text-gray-800 mb-4">{{ $news->title }}</h1>

                        {{-- Meta: ngày & tác giả --}}
                        <div
                            class="flex flex-col sm:flex-row sm:items-center text-gray-500 text-sm mb-6 space-y-2 sm:space-y-0 sm:space-x-4">
                            <span><strong>Đăng ngày:</strong> {{ $news->created_at->format('d/m/Y') }}</span>
                            <span><strong>Tác giả:</strong> {{ $news->author }}</span>
                        </div>

                        {{-- Nội dung --}}
                        <div class="prose prose-lg max-w-full text-gray-700 leading-relaxed">
                            {!! $news->content !!}
                        </div>

                        {{-- Chia sẻ --}}
                        <div class="mt-8 border-t pt-6 flex flex-wrap gap-4">
                            <span class="font-semibold text-gray-600">Chia sẻ:</span>
                            <a href="#" class="text-blue-600 hover:underline">Facebook</a>
                            <a href="#" class="text-blue-400 hover:underline">Zalo</a>
                            <button onclick="copyLink()" class="text-gray-600 hover:underline">Sao chép liên kết</button>
                        </div>
                    </div>
                </div>

                <aside class="space-y-8">
                    <aside class="space-y-8">
                        {{-- Tin nổi bật --}}
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h2 class="text-lg font-bold mb-4 border-b pb-2">Tin nổi bật</h2>
                            <ul class="space-y-4">
                                @foreach ($allNews as $item)
                                    <li class="flex items-start space-x-3">
                                        <div>
                                            <a href="{{ route('news.detail', $item->id) }}"
                                                class="text-sm font-semibold text-gray-800 hover:text-red-600">
                                                {{ Str::words($item->title, 10, '...') }}
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                                {{-- @foreach ($highlighted as $item)
                                    <li class="flex items-start space-x-3">
                                        <div class="w-20 h-14 flex-shrink-0 overflow-hidden rounded">
                                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <a href="{{ route('news.detail', $item->slug) }}"
                                                class="text-sm font-semibold text-gray-800 hover:text-red-600">
                                                {{ Str::limit($item->title, 60) }}
                                            </a>
                                            <p class="text-xs text-gray-500">{{ $item->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </li>
                                @endforeach --}}
                            </ul>
                        </div>
                    </aside>
                </aside>
            </div>
            {{-- Bài viết nổi bật / cùng chuyên mục --}}
            {{-- <div class="mt-10">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Bài viết khác</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($related as $item)
                        <a href="{{ route('news.detail', $item->slug) }}"
                            class="block bg-white rounded shadow hover:shadow-lg transition">
                            <div class="h-40 overflow-hidden">
                                <img src="{{ asset($item->thumbnail) }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-md text-gray-800 mb-2">{{ Str::limit($item->title, 60) }}</h3>
                                <p class="text-gray-500 text-xs">{{ $item->created_at->format('d/m/Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div> --}}
        </div>
    </section>

    <script>
        function copyLink() {
            navigator.clipboard.writeText(window.location.href)
                .then(() => alert('Link đã được sao chép!'));
        }
    </script>
@endsection
