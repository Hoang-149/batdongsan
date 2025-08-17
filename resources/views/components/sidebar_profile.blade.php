<aside class="w-80 flex-shrink-0">
    <div class="bg-white rounded-xl shadow p-6 mb-6 flex flex-col items-center">
        {{-- <div
            class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-3xl font-bold text-gray-500 mb-2">
            M
        </div> --}}
        @if (auth()->user()->avatar)
            <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->username }}'s Avatar"
                class="w-8 h-8 rounded-full object-cover">
        @else
            <div class="w-8 h-8 rounded-full bg-pink-600 text-white flex items-center justify-center font-semibold">
                {{ substr(auth()->user()->username, 0, 1) }}
            </div>
        @endif
        <div class="font-semibold text-lg text-gray-800 truncate w-full text-center">{{ $user->full_name }}</div>
        <div class="text-gray-400 text-sm mb-2">0 điểm</div>
        <div class="w-full bg-gray-50 rounded-lg p-4 mb-3">
            <div class="flex justify-between text-sm text-gray-600 mb-1">
                <span>TK Chính</span>
                <span>0</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mb-2">
                <span>TK Khuyến mãi</span>
                <span>0</span>
            </div>
            <div class="text-xs text-gray-500 mb-2">Mã chuyển khoản</div>
            <div class="flex items-center justify-between mb-2">
                <span class="font-semibold text-gray-700 text-sm">BDS45412558</span>
                <button class="text-gray-400 hover:text-gray-600" title="Copy">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="9" y="9" width="13" height="13" rx="2" stroke-width="2"></rect>
                        <rect x="3" y="3" width="13" height="13" rx="2" stroke-width="2"></rect>
                    </svg>
                </button>
            </div>
            <button
                class="w-full mt-2 py-2 border border-[#E03C31] text-[#E03C31] rounded-lg font-semibold hover:bg-[#E03C31] hover:text-white transition">Nạp
                tiền</button>
        </div>
    </div>
    <!-- Sidebar Nav -->
    <nav class="bg-white rounded-xl shadow p-4">
        <ul class="space-y-2">
            <li>
                <a href="#" class="flex items-center gap-2 text-gray-700 font-medium hover:text-[#E03C31]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                    </svg>
                    Tổng quan
                </a>
            </li>
            <li>
                <div>
                    <button class="flex items-center gap-2 text-gray-700 font-medium hover:text-[#E03C31] w-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="7" width="18" height="13" rx="2" stroke-width="2">
                            </rect>
                            <path d="M16 3v4M8 3v4" stroke-width="2"></path>
                        </svg>
                        Quản lý tin đăng
                        <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2"></path>
                        </svg>
                    </button>
                    <ul class="ml-7 mt-2 space-y-1 text-sm text-gray-600">
                        <li><a href="{{ route('createProperty') }}" class="hover:text-[#E03C31]">Đăng mới</a>
                        </li>
                        <li><a href="{{ route('user.properties.index') }}" class="hover:text-[#E03C31]">Danh sách
                                tin</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</aside>
