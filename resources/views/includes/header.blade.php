<div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <!-- Logo -->
    <div class="text-2xl font-bold text-blue-600 flex items-center">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-[160px]">
        </a>
    </div>

    <!-- Hamburger button (mobile) -->
    <button id="mobileMenuBtn" class="md:hidden text-red-600 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <!-- Navigation -->
    <nav class="hidden md:flex space-x-6 flex-1 ml-8">
        <a href="/nha-dat-ban"
            class="text-gray-700 font-semibold hover:text-red-600 {{ request()->is('nha-dat-ban*') ? 'text-red-800 border-b-2 border-red-800 pb-1' : '' }}">Nhà
            đất bán</a>
        <a href="/nha-dat-thue"
            class="text-gray-700 font-semibold hover:text-red-600 {{ request()->is('nha-dat-thue*') ? 'text-red-800 border-b-2 border-red-800 pb-1' : '' }}">Nhà
            đất thuê</a>
        <a href="/du-an"
            class="text-gray-700 font-semibold hover:text-red-600 {{ request()->is('du-an*') ? 'text-red-800 border-b-2 border-red-800 pb-1' : '' }}">Dự
            án</a>
        <a href="/tin-tuc"
            class="text-gray-700 font-semibold hover:text-red-600 {{ request()->is('tin-tuc*') ? 'text-red-800 border-b-2 border-red-800 pb-1' : '' }}">Tin
            tức</a>
    </nav>

    <!-- User Actions (desktop) -->
    <div class="hidden md:flex items-center space-x-4">
        @if (!auth()->check())
            <a href="#" class="text-red-800 font-semibold hover:text-red-600 login">Đăng nhập</a>
            <a href="#" class="text-red-800 font-semibold hover:text-red-600 register">Đăng ký</a>
        @else
            {{-- <label class="block text-sm font-semibold text-gray-700 relative">
                <a href="#">
                    <i class="fa-regular fa-bell text-red-500 mr-2 text-2xl"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-[#E03C31] text-white text-xs px-2 py-0.5 rounded-full">1</span>
                </a>
            </label> --}}
            <div class="relative inline-block">
                <button id="notification-btn" class="relative">
                    <i class="fa-regular fa-bell text-red-500 mr-2 text-2xl"></i>
                    <span id="notification-count"
                        class="absolute -top-2 -right-2 bg-[#E03C31] text-white text-xs px-2 py-0.5 rounded-full hidden">
                        0
                    </span>
                </button>

                <div id="notification-dropdown"
                    class="hidden absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg z-50">
                    <ul id="notification-list"></ul>
                </div>
            </div>

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
                    <span class="text-red-600 font-semibold hover:text-red-800">{{ auth()->user()->full_name }}</span>
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 hidden group-hover:block z-10">
                    <a href="{{ route('profile') }}"
                        class="block px-4 py-2 text-red-600 hover:bg-gray-100 font-semibold">Thông tin cá nhân</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 font-semibold">Đăng
                            xuất</button>
                    </form>
                </div>
            </div>
        @endif
        <a href="{{ auth()->check() ? route('createProperty') : '#' }}" id="btnPost"
            class="border border-gray-700 font-semibold text-gray-700 px-4 py-2 rounded hover:text-red-800 mt-2">Đăng
            tin</a>
    </div>
</div>

<div id="overlay" class="hidden fixed inset-0 bg-black/50 z-40"></div>

<div id="mobileMenu" class="fixed top-0 right-0 h-full w-1/2 bg-white shadow-lg z-50 overflow-y-auto"
    style="right: -50%;">
    <nav class="flex flex-col space-y-2 p-4 mt-4">
        <a href="/nha-dat-ban" class="text-gray-700 font-semibold hover:text-red-800">Nhà đất bán</a>
        <a href="/nha-dat-thue" class="text-gray-700 font-semibold hover:text-red-800">Nhà đất thuê</a>
        <a href="/du-an" class="text-gray-700 font-semibold hover:text-red-800">Dự án</a>
        <a href="/tin-tuc" class="text-gray-700 font-semibold hover:text-red-800">Tin tức</a>
        <hr>
        @if (!auth()->check())
            <a href="#" class="text-red-800 font-semibold hover:text-red-800 login">Đăng nhập</a>
            <a href="#" class="text-red-800 font-semibold hover:text-red-800 register">Đăng ký</a>
        @else
            <a href="{{ route('profile') }}" class="text-red-800 font-semibold hover:text-red-800">Thông tin cá
                nhân</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left text-red-800 font-semibold hover:text-red-800">Đăng
                    xuất</button>
            </form>
        @endif
        <a href="{{ auth()->check() ? route('createProperty') : '#' }}" id="btnPost"
            class="border border-gray-700 font-semibold text-gray-700 px-4 py-2 rounded hover:text-red-800 mt-2 w-fit">Đăng
            tin</a>
    </nav>
</div>

<script>
    jQuery(document).ready(function($) {

        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};

        $('#btnPost').on('click', function(e) {
            if (!isAuthenticated) {
                e.preventDefault();
                alert('Vui lòng đăng nhập để đăng tin!');
            }
        });

        $('a.login').click(function() {
            $('#loginModal').toggleClass('hidden');
        });
        $('a.register').click(function() {
            $('#registerModal').toggleClass('hidden');
        });

        $('#mobileMenuBtn').on('click', function() {
            $('#overlay').fadeIn(200);
            $('#mobileMenu').animate({
                right: '0%'
            }, 300);
        });

        $('#overlay').on('click', function() {
            $('#mobileMenu').animate({
                right: '-50%'
            }, 300);
            $('#overlay').fadeOut(200);
        });


    });
</script>
