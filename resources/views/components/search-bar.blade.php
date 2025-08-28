@props(['type'])

<div class="tab-content hidden" id="{{ $type }}" data-type="{{ $type }}">
    <!-- Search Bar -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-28 sm:gap-4 mb-2 sm:mb-10">
        <div class="flex-1 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-600"></i>
            </div>

            <div
                class="relative flex items-center border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300">

                <input type="text" id="search-text-{{ $type }}" placeholder="Nhập tối đa 3 quận..."
                    class="w-full sm:w-64 pl-8 sm:pl-12 pr-8 py-3 bg-transparent border-none focus:ring-0 focus:outline-none text-gray-800 placeholder-gray-400 text-base font-normal">

                {{-- <div id="selected-quans-{{ $type }}"
                    class="flex flex-wrap items-center pr-32 py-2 bg-transparent w-full">
                </div> --}}

                <div id="selected-quans-{{ $type }}"
                    class="absolute left-0 top-full w-full  p-2 max-h-40 overflow-y-auto z-10 flex flex-wrap gap-2">
                </div>

                <select id="tinh-select-{{ $type }}"
                    class="absolute right-0 top-0 h-full px-4 py-3 bg-transparent border-l border-gray-200 text-gray-700 rounded-r-2xl focus:ring-0 focus:outline-none appearance-none transition-colors duration-200 hover:bg-gray-200 bg-gray-100 z-10">
                    <option value="all">Tất cả</option>
                </select>
                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-600 text-sm"></i>
                </div>
            </div>

            <div id="quan-dropdown-{{ $type }}"
                class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg max-h-64 overflow-y-auto hidden">
                <ul id="quan-list-{{ $type }}" class="text-gray-700 text-base"></ul>
            </div>
        </div>

        <!-- Nút tìm kiếm -->
        <button id="search-button-{{ $type }}"
            class="w-full sm:w-auto bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 sm:px-8 py-3 rounded-xl font-semibold text-sm shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-center">
            <i class="fas fa-search mr-2"></i>
            <span>Tìm kiếm</span>
        </button>
    </div>

    <!-- Bộ lọc -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
        <!-- Loại nhà đất -->
        <div class="relative">
            <select class="w-full border rounded-lg p-2.5 appearance-none bg-white"
                id="property-type-{{ $type }}">
                <option value="">Loại nhà đất</option>
                <option value="1">Căn hộ chung cư</option>
                <option value="2">Nhà riêng</option>
                <option value="3">Đất nền</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <!-- Giá -->
        <div class="relative">
            <select class="w-full border border-gray-300 rounded-lg p-2.5 appearance-none bg-white"
                id="price-filter-{{ $type }}">
                <option value="">Chọn mức giá</option>
                <option value="under_1b">Dưới 1 tỷ</option>
                <option value="1b_5b">1 - 5 tỷ</option>
                <option value="over_5b">Trên 5 tỷ</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <!-- Diện tích -->
        <div class="relative">
            <select id="area-filter-{{ $type }}"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-red-500">
                <option value="">Diện tích</option>
                <option value="under_30">Dưới 30 m²</option>
                <option value="30_50">30 - 50 m²</option>
                <option value="50_100">50 - 100 m²</option>
                <option value="over_100">Trên 100 m²</option>
            </select>
        </div>
    </div>
</div>
