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
        <a href="#" class="text-red-600 font-semibold hover:text-red-800 login">Đăng nhập</a>
        <a href="#" class="text-red-600 font-semibold hover:text-red-800 logup">Đăng ký</a>
        <a href="#"
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
