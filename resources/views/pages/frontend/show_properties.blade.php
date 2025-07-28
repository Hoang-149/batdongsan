@extends('layouts.main')
@section('title', 'Detail Property')
@section('content')

    <div class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Back to Home</a>
            <h1 class="text-3xl font-bold mb-6">{{ $property->title }}</h1>

            <!-- Image Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                @forelse ($property->images as $image)
                    <img src="{{ asset($image->image_url) }}" alt="Property Image" class="w-full h-64 object-cover rounded-lg">
                @empty
                    <img src="{{ asset('assets/img/placeholder.jpg') }}" alt="Placeholder Image"
                        class="w-full h-64 object-cover rounded-lg">
                @endforelse
            </div>

            <!-- Property Details -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-[#E03C31] font-bold text-2xl mb-2">{{ number_format($property->price, 0, ',', '.') }} VNĐ</p>
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
    </div>
@endsection
