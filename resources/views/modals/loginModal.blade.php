<!-- Modal Overlay -->
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-lg flex w-full max-w-2xl overflow-hidden">
        <!-- Left illustration -->
        <div class="hidden md:flex flex-col justify-center items-center bg-[#ffeaea] w-1/2 p-8 relative">
            <img src="assets/img/logo.png" alt="Login Illustration" class="w-40 mb-6 absolute top-2 left-2">
            <img src="assets/img/ill.png" alt="Login Illustration" class="w-40 mb-6">
            <div class="text-gray-700 font-semibold text-lg mb-2">Tìm nhà đất<br>Batdongsan.com.vn dẫn lối</div>
        </div>
        <!-- Right form -->
        <div class="flex-1 p-8">
            <button onclick="document.getElementById('loginModal').classList.add('hidden')"
                class="float-right text-gray-400 hover:text-gray-700 text-2xl font-bold">&times;</button>
            <div class="mb-6 mt-2">
                <div class="text-gray-600 text-sm">Xin chào bạn</div>
                <div class="text-2xl font-bold mb-2">Đăng nhập để tiếp tục</div>
            </div>
            <form>
                <div class="mb-4">
                    <div class="relative">
                        <input type="text" placeholder="SĐT chính hoặc email"
                            class="w-full border rounded-lg py-3 pl-12 pr-4 focus:ring-2 focus:ring-red-400 outline-none text-gray-700">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg font-size="24px" width="1em" height="1em" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path xmlns="http://www.w3.org/2000/svg"
                                    d="M20 21V19C20 16.7909 18.2091 15 16 15H8C5.79086 15 4 16.7909 4 19V21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="relative">
                        <input type="password" placeholder="Mật khẩu"
                            class="w-full border rounded-lg py-3 pl-12 pr-10 focus:ring-2 focus:ring-red-400 outline-none text-gray-700">
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
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                <path
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-[#E03C31] hover:bg-red-600 text-white font-semibold py-3 rounded-lg mb-2 transition">Đăng
                    nhập</button>
                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center text-gray-600 text-sm">
                        <input type="checkbox" class="mr-2 rounded border-gray-300"> Nhớ tài khoản
                    </label>
                    <a href="#" class="text-[#E03C31] text-sm hover:underline">Quên mật khẩu?</a>
                </div>
                <div class="flex items-center my-4">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="mx-3 text-gray-400 text-sm">Hoặc</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>
                <button type="button"
                    class="w-full border border-gray-300 rounded-lg py-2 flex items-center justify-center gap-2 mb-2 font-medium hover:bg-gray-50">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.4933 17.5861C20.1908 18.2848 19.8328 18.928 19.418 19.5193C18.8526 20.3255 18.3897 20.8835 18.0329 21.1934C17.4798 21.702 16.8872 21.9625 16.2527 21.9773C15.7972 21.9773 15.2478 21.8477 14.6083 21.5847C13.9667 21.323 13.3771 21.1934 12.838 21.1934C12.2726 21.1934 11.6662 21.323 11.0176 21.5847C10.3679 21.8477 9.84463 21.9847 9.44452 21.9983C8.83602 22.0242 8.22949 21.7563 7.62408 21.1934C7.23767 20.8563 6.75436 20.2786 6.17536 19.4601C5.55415 18.586 5.04342 17.5725 4.64331 16.417C4.21481 15.1689 4 13.9603 4 12.7902C4 11.4498 4.28962 10.2938 4.86973 9.32509C5.32564 8.54696 5.93216 7.93316 6.69127 7.48255C7.45038 7.03195 8.2706 6.80233 9.15391 6.78763C9.63723 6.78763 10.271 6.93714 11.0587 7.23096C11.8441 7.52576 12.3484 7.67526 12.5695 7.67526C12.7348 7.67526 13.295 7.50045 14.2447 7.15195C15.1429 6.82874 15.9009 6.69492 16.5218 6.74764C18.2045 6.88343 19.4686 7.54675 20.3094 8.74177C18.8045 9.6536 18.06 10.9307 18.0749 12.5691C18.0884 13.8452 18.5514 14.9071 19.4612 15.7503C19.8736 16.1417 20.334 16.4441 20.8464 16.6589C20.7353 16.9812 20.618 17.2898 20.4933 17.5861ZM16.6342 2.40011C16.6342 3.40034 16.2687 4.33425 15.5404 5.19867C14.6614 6.22629 13.5982 6.8201 12.4453 6.7264C12.4306 6.60641 12.4221 6.48011 12.4221 6.3474C12.4221 5.38718 12.8401 4.35956 13.5824 3.51934C13.953 3.09392 14.4244 2.74019 14.9959 2.45801C15.5663 2.18005 16.1058 2.02632 16.6132 2C16.628 2.13371 16.6342 2.26744 16.6342 2.4001V2.40011Z"
                            fill="black"></path>
                    </svg>
                    Đăng nhập với Apple
                </button>
                <button type="button"
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
                    Bằng việc tiếp tục, bạn đồng ý với <a href="#" class="text-[#E03C31] underline">Điều khoản sử
                        dụng</a>, <a href="#" class="text-[#E03C31] underline">Chính sách bảo mật</a>, <a
                        href="#" class="text-[#E03C31] underline">Quy chế</a>, <a href="#"
                        class="text-[#E03C31] underline">Chính sách</a> của chúng tôi.
                </div>
                <div class="text-center mt-4 text-sm">
                    Chưa là thành viên? <a href="#" class="text-[#E03C31] font-semibold hover:underline">Đăng ký
                        tại đây</a>
                </div>
            </form>
        </div>
    </div>
</div>
