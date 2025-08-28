<!-- Modal Overlay -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-lg flex w-full max-w-4xl overflow-hidden mx-2 sm:mx-0">
        <!-- Left illustration -->
        <div class="hidden md:flex flex-col justify-center items-center bg-[#ffeaea] w-1/2 p-8 relative">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Login Illustration" class="w-40 mb-6 absolute top-2 left-2">
            <img src="{{ asset('assets/img/ill.png') }}" alt="Login Illustration" class="w-40 mb-6">
            <div class="text-gray-700 font-semibold text-lg mb-2">Tìm nhà đất<br>Cafebizland.com dẫn lối</div>
        </div>
        <!-- Right form -->
        <div class="flex-1 p-8">
            <button onclick="document.getElementById('loginModal').classList.add('hidden')"
                class="float-right text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>
            <div class="mb-6 mt-2">
                <div class="text-gray-600 text-sm">Xin chào bạn</div>
                <div class="text-2xl font-bold mb-2">Đăng nhập để tiếp tục</div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mb-4">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible mb-4">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" name="identifier" placeholder="SĐT chính hoặc email"
                            class="w-full border rounded-lg py-3 pl-12 pr-4 focus:ring-2 focus:ring-red-400 outline-none text-gray-700 @error('identifier') is-invalid @enderror"
                            value="{{ old('identifier') }}">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg font-size="24px" width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path xmlns="http://www.w3.org/2000/svg"
                                    d="M20 21V19C20 16.7909 18.2091 15 16 15H8C5.79086 15 4 16.7909 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        @error('identifier')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <div class="relative">
                        <input type="password" name="password" placeholder="Mật khẩu"
                            class="w-full border rounded-lg py-3 pl-12 pr-10 focus:ring-2 focus:ring-red-400 outline-none text-gray-700 @error('password') is-invalid @enderror">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" font-size="24px">
                                <path
                                    d="M18.7691 21H5.23076C4.90434 21 4.59129 20.8712 4.36048 20.642C4.12967 20.4128 4 20.1019 4 19.7778V11.2222C4 10.8981 4.12967 10.5872 4.36048 10.358C4.59129 10.1288 4.90434 10 5.23076 10H18.7691C19.0955 10 19.4086 10.1288 19.6394 10.358C19.8702 10.5872 19.9999 10.8981 19.9999 11.2222V19.7778C19.9999 20.1019 19.8702 20.4128 19.6394 20.642C19.4086 20.8712 19.0955 21 18.7691 21Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M7.42859 9.85709V6.99997C7.42859 5.93911 7.91022 4.9217 8.76752 4.17156C9.62482 3.42142 10.7876 3 12 3C13.2124 3 14.3751 3.42142 15.2324 4.17156C16.0897 4.9217 16.5714 5.93911 16.5714 6.99997V9.85709"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <button type="button"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 toggle-password">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-[#E03C31] hover:bg-red-600 text-white font-semibold py-3 rounded-lg mb-2 transition">Đăng
                    nhập</button>
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center text-gray-600 text-sm">
                        <input type="checkbox" class="mr-2 rounded border-gray-300" name="remember"> Nhớ tài khoản
                    </label>
                    <a href="#" class="text-[#E03C31] text-sm hover:underline">Quên mật khẩu?</a>
                </div>
                <div class="flex items-center my-4">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="mx-3 text-gray-400 text-sm">Hoặc</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>
                <button type="button" onclick="window.location.href='{{ route('google.login') }}'"
                    class="w-full border border-gray-300 rounded-lg py-2 flex items-center justify-center gap-2 font-medium hover:bg-gray-50">
                    <svg class="w-5 h-5" viewBox="0 0 48 48">
                        <g>
                            <path fill="#4285F4"
                                d="M24 9.5c3.54 0 6.36 1.53 7.82 2.81l5.75-5.75C34.36 3.54 29.64 1.5 24 1.5 14.82 1.5 6.87 7.98 3.69 16.44l6.91 5.36C12.13 15.09 17.56 9.5 24 9.5z" />
                            <path fill="#34A853"
                                d="M46.1 24.5c0-1.64-.15-3.22-.42-4.74H24v9.24h12.42c-.54 2.91-2.18 5.38-4.66 7.04l7.18 5.59C43.91 37.36 46.1 31.41 46.1 24.5z" />
                            <path fill="#FBBC05"
                                d="M10.6 28.09a14.5 14.5 0 0 1 0-8.18l-6.91-5.36A23.97 23.97 0 0 0 0 24c0 3.77.9 7.34 2.49 10.45l7.11-5.36z" />
                            <path fill="#EA4335"
                                d="M24 46.5c6.48 0 11.93-2.15 15.9-5.86l-7.18-5.59c-2.01 1.35-4.59 2.16-8.72 2.16-6.44 0-11.87-5.59-13.4-12.95l-7.11 5.36C6.87 40.02 14.82 46.5 24 46.5z" />
                        </g>
                    </svg>
                    Đăng nhập với Google
                </button>
                <div class="text-xs text-gray-400 mt-4 text-center">
                    Bằng việc tiếp tục, bạn đồng ý với <a href="#" class="text-[#E03C31] underline">Điều khoản
                        sử
                        dụng</a>, <a href="#" class="text-[#E03C31] underline">Chính sách bảo mật</a>, <a
                        href="#" class="text-[#E03C31] underline">Quy chế</a>, <a href="#"
                        class="text-[#E03C31] underline">Chính sách</a> của chúng tôi.
                </div>
                <div class="text-center mt-4 text-sm">
                    Chưa là thành viên? <a href="#"
                        class="text-[#E03C31] font-semibold hover:underline linkRegister">Đăng ký
                        tại đây</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Show modal if there's an error or input to preserve
    @if (session('error') && old('identifier'))
        document.getElementById('loginModal').classList.remove('hidden');
    @endif

    @if (session('register_success'))
        document.getElementById('loginModal').classList.remove('hidden');
        alert("{{ session('register_success') }}");
    @endif

    @if (session('login_success'))
        document.getElementById('loginModal').classList.add('hidden');
        alert("{{ session('login_success') }}");
    @endif


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery(document).ready(function($) {
        $('.linkRegister').on('click', function(e) {
            e.preventDefault();
            $('#loginModal').addClass('hidden');
            $('#registerModal').removeClass('hidden');
        });
    });
</script>
