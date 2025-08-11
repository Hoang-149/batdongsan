@forelse ($projects as $project)
    <div class="bg-white shadow rounded-lg overflow-hidden hover:shadow-lg transition border border-gray-200 mb-4">
        <a href="{{ route('project.detail', $project->project_id) }}" class="grid grid-cols-1 md:grid-cols-3 gap-0">

            {{-- Cột ảnh --}}
            <div class="relative flex flex-col">
                {{-- Ảnh chính --}}
                <img src="{{ $project->images->first() ? asset($project->images->first()->image_url) : asset('assets/img/placeholder.jpg') }}"
                    class="w-full h-32 object-cover" alt="{{ $project->project_name }}">

                {{-- Badge --}}
                <span
                    class="absolute top-2 left-2 bg-purple-100 text-purple-700 text-xs font-semibold px-2 py-1 rounded">
                    Đang cập nhật
                </span>

                {{-- Ảnh nhỏ bên dưới (2 ảnh) --}}
                @if ($project->images->count() > 1)
                    <div class="grid grid-cols-2 gap-1 mt-1 p-1">
                        @foreach ($project->images->skip(1)->take(2) as $img)
                            <img src="{{ asset($img->image_url) }}" class="w-full h-20 object-cover rounded"
                                alt="">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Cột thông tin (chiếm 2/3) --}}
            <div class="col-span-2 flex flex-col justify-between">
                {{-- Thông tin chi tiết --}}
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $project->project_name }}
                    </h3>
                    <div class="flex items-center text-base text-gray-600 mt-1 space-x-3">
                        <span>{{ number_format($project->area, 0, ',', '.') }} m²</span>
                        {{-- <span>•</span>
                                                <span>1 🏢</span> --}}
                    </div>
                    <p class="text-sm text-gray-500 mt-1">{{ $project->location }}</p>
                    <p class="text-sm text-gray-700 mt-2 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 1000) }}
                    </p>
                </div>

                {{-- Công ty --}}
                {{-- <div class="flex items-center px-4 py-3 border-t border-gray-100">
                                                <img src="{{ asset('assets/img/company-logo.png') }}" alt="Logo"
                                                    class="w-6 h-6 mr-2">
                                                <span class="text-sm text-gray-800 font-medium">
                                                    {{ $project->user->username ?? 'Công ty CP Đầu tư Xây dựng Dân dụng Hà Nội' }}
                                                </span>
                                            </div> --}}
            </div>
        </a>
    </div>
@empty
    <p>Không tìm thấy.</p>
@endforelse
