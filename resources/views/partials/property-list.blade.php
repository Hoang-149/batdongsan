@forelse ($properties as $property)
    <div class="bg-white rounded-lg p-4 gap-4">
        <a href="{{ route('properties.show', $property->slug) }}">
            <div class="w-full mb-4">
                <div class="grid grid-cols-3 grid-rows-2 gap-2 h-[234px]">
                    @php
                        $images = $property->images;
                    @endphp
                    <div class="row-span-2 col-span-2">
                        <img src="{{ isset($images[0]) ? asset($images[0]->image_url) : asset('assets/img/placeholder.jpg') }}"
                            class="w-full h-full object-cover rounded" alt="{{ $property->title }}">
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 gap-2 h-[234px]">
                        <div class="col-span-2 row-span-1">
                            <img src="{{ isset($images[1]) ? asset($images[1]->image_url) : asset('assets/img/placeholder.jpg') }}"
                                class="w-full h-full object-cover rounded" alt="{{ $property->title }}">
                        </div>
                        <div class="col-span-2 grid grid-cols-2 grid-rows-1 gap-2">
                            <div class="col-span-1 row-span-1">
                                <img src="{{ isset($images[2]) ? asset($images[2]->image_url) : asset('assets/img/placeholder.jpg') }}"
                                    class="w-full h-full object-cover rounded" alt="{{ $property->title }}">
                            </div>
                            <div class="col-span-1 row-span-1">
                                <img src="{{ isset($images[3]) ? asset($images[3]->image_url) : asset('assets/img/placeholder.jpg') }}"
                                    class="w-full h-full object-cover rounded" alt="{{ $property->title }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-[#E03C31] mb-2">
                    {{ $property->title }}
                </h3>
                <p class="text-[#E03C31] font-bold text-xl mb-2">
                    {{ number_format($property->price, 0, ',', '.') }} VND
                </p>
                <p class="text-gray-600 mb-2">
                    {{ $property->area }} m² -
                    {{ $property->propertyTypes->pluck('type_name')->implode(', ') ?? 'N/A' }}
                </p>
                <p class="text-gray-500 text-sm mb-4">
                    {{ \Illuminate\Support\Str::limit(strip_tags($property->description), 200) }}
                </p>
                <div class="flex justify-between items-end">
                    <div class="text-gray-500 text-sm">
                        <p>{{ $property->created_at->format('d/m/Y') }}</p>
                        <p>{{ $property->location ?? 'N/A' }}</p>
                    </div>
                    <a href="{{ route('properties.show', $property->slug) }}" class="text-blue-600 hover:underline">
                        Chi tiết
                    </a>
                </div>
            </div>
        </a>
    </div>
@empty
    <p class="text-gray-600">Không tìm thấy bất động sản nào.</p>
@endforelse
