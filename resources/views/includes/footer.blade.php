       <div class="w-full max-w-[1140px] mx-auto">
           <!-- Header Section -->
           <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-12 gap-6 px-8 md:px-0">
               <!-- Logo -->
               <div class="flex items-center gap-4">
                   <a href="{{ route('home') }}">
                       <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-[140px] md:w-[160px]">
                   </a>
               </div>

               <!-- Contact Info -->
               <div class="flex flex-col sm:flex-row sm:flex-wrap gap-6 sm:gap-8 lg:gap-12">
                   <div class="flex items-center gap-3">
                       <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                           <i class="fas fa-phone text-gray-600"></i>
                       </div>
                       <div>
                           <p class="text-xs md:text-sm text-gray-600">Hotline</p>
                           <p class="font-semibold text-gray-800 text-sm md:text-base">1900 1881</p>
                       </div>
                   </div>

                   <div class="flex items-center gap-3">
                       <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                           <i class="fas fa-user text-gray-600"></i>
                       </div>
                       <div>
                           <p class="text-xs md:text-sm text-gray-600">Hỗ trợ khách hàng</p>
                           <p class="font-semibold text-gray-800 text-sm md:text-base">trogiup@Cafebizland.com</p>
                       </div>
                   </div>

                   <div class="flex items-center gap-3">
                       <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm">
                           <i class="fas fa-headset text-gray-600"></i>
                       </div>
                       <div>
                           <p class="text-xs md:text-sm text-gray-600">Chăm sóc khách hàng</p>
                           <p class="font-semibold text-gray-800 text-sm md:text-base">hotro@Cafebizland.com</p>
                       </div>
                   </div>
               </div>
           </div>

           <!-- Main Footer Content -->
           <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 px-8 md:px-0">
               <!-- Công ty -->
               <div class="lg:col-span-2">
                   <h4 class="font-bold text-gray-800 mb-4 uppercase text-sm">CÔNG TY CỔ PHẦN CAFEBIZLAND</h4>
                   <div class="space-y-3 text-sm text-gray-600">
                       <div class="flex items-start gap-2">
                           <i class="fas fa-map-marker-alt text-gray-500 mt-1"></i>
                           <p>Phạm Hùng, Nam Từ Liêm, Hà Nội</p>
                       </div>
                       <div class="flex items-center gap-2">
                           <i class="fas fa-phone text-gray-500"></i>
                           <p>(024) 1234 1234 - (024) 1234 1233</p>
                       </div>
                   </div>

                   <!-- QR & App -->
                   <div class="mt-6 flex flex-row sm:flex-row sm:items-center gap-4">
                       <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                           <!-- fake QR -->
                           <div class="grid grid-cols-3 gap-1">
                               <div class="w-2 h-2 bg-gray-800"></div>
                               <div class="w-2 h-2 bg-gray-400"></div>
                               <div class="w-2 h-2 bg-gray-800"></div>
                               <div class="w-2 h-2 bg-gray-400"></div>
                               <div class="w-2 h-2 bg-gray-800"></div>
                               <div class="w-2 h-2 bg-gray-400"></div>
                               <div class="w-2 h-2 bg-gray-800"></div>
                               <div class="w-2 h-2 bg-gray-400"></div>
                               <div class="w-2 h-2 bg-gray-800"></div>
                           </div>
                       </div>
                       <div class="flex flex-col gap-2 justify-center">
                           <div class="flex items-center gap-2 bg-gray-800 text-white px-3 py-1 rounded text-xs w-fit">
                               <i class="fab fa-google-play"></i>
                               <span>Google Play</span>
                           </div>
                           <div class="flex items-center gap-2 bg-gray-800 text-white px-3 py-1 rounded text-xs w-fit">
                               <i class="fab fa-apple"></i>
                               <span>App Store</span>
                           </div>
                       </div>
                   </div>
               </div>

               <!-- Hướng dẫn -->
               <div>
                   <h4 class="font-bold text-gray-800 mb-4 uppercase text-sm">HƯỚNG DẪN</h4>
                   <ul class="space-y-2 text-sm text-gray-600">
                       <li><a href="#" class="hover:text-red-500">Về chúng tôi</a></li>
                       <li><a href="#" class="hover:text-red-500">Báo giá và hỗ trợ</a></li>
                       <li><a href="#" class="hover:text-red-500">Câu hỏi thường gặp</a></li>
                       <li><a href="#" class="hover:text-red-500">Góp ý báo lỗi</a></li>
                       <li><a href="#" class="hover:text-red-500">Sitemap</a></li>
                   </ul>
               </div>

               <!-- Quy định -->
               <div>
                   <h4 class="font-bold text-gray-800 mb-4 uppercase text-sm">QUY ĐỊNH</h4>
                   <ul class="space-y-2 text-sm text-gray-600">
                       <li><a href="#" class="hover:text-red-500">Quy định đăng tin</a></li>
                       <li><a href="#" class="hover:text-red-500">Quy chế hoạt động</a></li>
                       <li><a href="#" class="hover:text-red-500">Điều khoản thỏa thuận</a></li>
                       <li><a href="#" class="hover:text-red-500">Chính sách bảo mật</a></li>
                       <li><a href="#" class="hover:text-red-500">Giải quyết khiếu nại</a></li>
                   </ul>
               </div>

               <!-- Đăng ký nhận tin -->
               <div>
                   <h4 class="font-bold text-gray-800 mb-4 uppercase text-sm">ĐĂNG KÝ NHẬN TIN</h4>
                   <div class="flex">
                       <input type="email" placeholder="Nhập email của bạn"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                       <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-r-lg">
                           <i class="fas fa-paper-plane"></i>
                       </button>
                   </div>

                   <!-- Ngôn ngữ -->
                   <div class="mt-6">
                       <h5 class="font-bold text-gray-800 mb-2 uppercase text-sm">QUỐC GIA & NGÔN NGỮ</h5>
                       <div class="relative">
                           <select
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-red-500 appearance-none bg-white">
                               <option>🇻🇳 Việt Nam</option>
                           </select>
                           <i
                               class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
