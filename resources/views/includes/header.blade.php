<div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <!-- Logo -->
    <div class="text-2xl font-bold text-blue-600">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-[160px]">
        </a>
    </div>
    <!-- Navigation -->
    <nav class="hidden md:flex space-x-6 flex-1 ml-8">
        <a href="/nha-dat-ban" class="text-gray-700 font-semibold hover:text-red-800">Nhà đất bán</a>
        <a href="/nha-dat-thue" class="text-gray-700 font-semibold hover:text-red-800">Nhà đất thuê</a>
        <a href="/du-an" class="text-gray-700 font-semibold hover:text-red-800">Dự án</a>
        <a href="/tin-tuc" class="text-gray-700 font-semibold hover:text-red-800">Tin tức</a>
    </nav>
    <!-- User Actions -->
    <div class="flex items-center space-x-4">
        @if (!auth()->check())
            <a href="#" class="text-red-600 font-semibold hover:text-red-800 login">Đăng nhập</a>
            <a href="#" class="text-red-600 font-semibold hover:text-red-800 logup">Đăng ký</a>
        @else
            <div class="relative group p-4">
                <div class="flex items-center space-x-1 cursor-pointer">
                    @if (auth()->user()->avatar)
                        <img src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->username }}'s Avatar"
                            class="w-8 h-8 rounded-full object-cover">
                    @else
                        <div
                            class="w-8 h-8 rounded-full bg-pink-600 text-white flex items-center justify-center font-semibold">
                            {{ substr(auth()->user()->username, 0, 1) }}
                        </div>
                    @endif
                    <span class="text-red-600 font-semibold hover:text-red-800">{{ auth()->user()->username }}</span>
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 hidden group-hover:block z-10">
                    <a href="{{ route('profile') }}"
                        class="block px-4 py-2 text-red-600 hover:bg-gray-100 font-semibold">Thông tin cá nhân</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 font-semibold">Đăng
                            xuất</button>
                    </form>
                </div>
            </div>
        @endif
        <a href="{{ route('createProperty') }}"
            class="border border-gray-700 font-semibold text-gray-700 px-4 py-2 rounded hover:text-red-800">Đăng tin</a>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        $('a.login').click(function() {
            $('#loginModal').toggleClass('hidden');
        });
        $('a.logup').click(function() {
            $('#logupModal').toggleClass('hidden');
        });
    });
</script>
