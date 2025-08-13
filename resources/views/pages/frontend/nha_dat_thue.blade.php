@extends('layouts.main')
@section('title', 'Nhà đất thuê')
@section('content')


    <div class="bg-gray-100 min-h-screen">
        <!-- Breadcrumb -->
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center text-sm">
                <a href="/" class="text-gray-600 hover:text-[#E03C31]">Trang chủ</a>
                <span class="mx-2">/</span>
                <span class="text-[#E03C31]">Nhà đất thuê</span>
            </div>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- Main Search Container -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
                <!-- Search Bar -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-600"></i>
                        </div>
                        <div
                            class="relative flex items-center border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300">

                            <input type="text" id="search-text" placeholder="Tìm kiếm trên toàn quốc..."
                                class="w-72 pl-12 pr-8 py-3.5 bg-transparent border-none focus:ring-0 focus:outline-none text-gray-800 placeholder-gray-400 text-base font-normal">
                            <div id="selected-quans" class="flex flex-wrap items-center pr-40 py-2 bg-transparent w-full">
                            </div>
                            <select id="tinh-select"
                                class="absolute right-0 top-0 h-full px-4 py-3.5 bg-transparent border-l border-gray-200 text-gray-700 rounded-r-2xl focus:ring-0 focus:outline-none appearance-none transition-colors duration-200 hover:bg-gray-100">
                                <option value="all">Tất cả</option>
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-600 text-sm"></i>
                            </div>
                        </div>
                        <div id="quan-dropdown"
                            class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg max-h-64 overflow-y-auto hidden">
                            <ul id="quan-list" class="text-gray-700 text-base"></ul>
                        </div>
                    </div>

                    <button id="search-button"
                        class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-8 py-3 rounded-xl font-semibold text-sm shadow-sm hover:shadow-md transition-all duration-300">
                        Tìm kiếm
                    </button>
                </div>


                <!-- Filter Options -->
                <div class="flex items-center gap-4 flex-wrap">
                    <!-- Filter Button -->
                    <button
                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-filter text-gray-600"></i>
                        <span class="text-gray-700 font-medium">Lọc</span>
                    </button>

                    <!-- Property Type Dropdown -->
                    <div class="relative">
                        <select class="w-full border rounded-lg p-2.5 appearance-none bg-white" id="property-type">
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

                    <!-- Price Range Dropdown -->
                    <div class="relative">
                        <select class="w-36 border rounded-lg p-2.5 appearance-none bg-white" id="price-filter">
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

                    <!-- Verified Toggle -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700 font-medium">Tin xác thực</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer" id="is-verified" name="is_verified">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500">
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Professional Agent Toggle -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-user-tie text-blue-500"></i>
                            <span class="text-gray-700 font-medium">Môi giới chuyên nghiệp</span>
                            <label class="relative inline-flex items-center cursor-pointer" id="professional-agent"
                                name="professional_agent" checked>
                                <input type="checkbox" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500">
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto y-4 pb-8">
            <div class="flex gap-6">
                <!-- Main Content Area -->
                <div class="flex-1">
                    <div id="loadingSpinner"
                        class="hidden fixed inset-0 bg-gray-900 bg-opacity-40 flex items-center justify-center z-50">
                        <div class="w-12 h-12 border-4 border-white border-t-transparent rounded-full animate-spin">
                        </div>
                    </div>
                    <!-- Property Listings -->
                    <div class="space-y-4" id="property-list">
                        @include('partials.property-list', ['properties' => $properties])
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-6" id="pagination">
                        {{ $properties->links() }}
                    </div>
                </div>

                <!-- Filter Sidebar -->
                <div class="w-[300px] flex-shrink-0">
                    <div class="bg-white rounded-lg p-4 mb-4">
                        <h3 class="font-semibold mb-4">Lọc theo khoảng giá</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="price_ranges[]" value="under_1b"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">Dưới 1 tỷ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="price_ranges[]" value="1b_5b"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">1 - 5 tỷ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="price_ranges[]" value="5b_10b"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">5 - 10 tỷ</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="price_ranges[]" value="above_10b"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">Trên 10 tỷ</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-4 mb-4">
                        <h3 class="font-semibold mb-4">Lọc theo diện tích</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" name="area_ranges[]" value="under_30"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">Dưới 30 m²</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="area_ranges[]" value="30_50"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">30 - 50 m²</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="area_ranges[]" value="50_100"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">50 - 100 m²</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="area_ranges[]" value="above_100"
                                    class="rounded border-gray-300 filter-checkbox">
                                <span class="ml-2">Trên 100 m²</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactivity
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                console.log(`${this.parentElement.previousElementSibling.textContent}: ${this.checked}`);
            });
        });

        $(document).ready(function() {
            const defaultTinhId = 48;
            const maxSelections = 3;
            let selectedQuans = [];

            let propertyType = '';
            let priceFilter = '';
            let isVerified = false;
            let searchTinh = '';
            let searchQuan = '';

            function showLoading() {
                $("#loadingSpinner").removeClass("hidden");
            }

            function hideLoading() {
                $("#loadingSpinner").addClass("hidden");
            }

            // Hàm lấy dữ liệu bất động sản
            function loadProperties(page = 1) {

                let priceRanges = [];
                let areaRanges = [];
                $('.filter-checkbox[name="price_ranges[]"]:checked').each(function() {
                    priceRanges.push($(this).val());
                });
                $('.filter-checkbox[name="area_ranges[]"]:checked').each(function() {
                    areaRanges.push($(this).val());
                });

                showLoading();
                $.ajax({
                    url: '{{ route('properties.indexThue') }}',
                    type: 'GET',
                    data: {
                        page: page,
                        price_ranges: priceRanges,
                        area_ranges: areaRanges,

                        property_type: propertyType,
                        price_filter: priceFilter,
                        is_verified: isVerified,
                        search_tinh: searchTinh,
                        search_quan: searchQuan,
                        // professional_agent: professionalAgent,
                    },
                    success: function(response) {
                        hideLoading();
                        // Cập nhật danh sách bất động sản
                        $('#property-list').html(response.properties.map(property => `
                    <div class="bg-white rounded-lg p-4 gap-4">
                       <a href="/nha-dat/${property.property_id}">
                        <div class="w-full mb-4">
                            <div class="grid grid-cols-3 grid-rows-2 gap-2 h-[234px]">
                                <div class="row-span-2 col-span-2">
                                    <img src="${property.images[0] ? '{{ asset('') }}' + property.images[0].image_url : '{{ asset('assets/img/placeholder.jpg') }}'}"
                                        class="w-full h-full object-cover rounded" alt="${property.title}">
                                </div>
                                <div class="grid grid-cols-2 grid-rows-2 gap-2 h-[234px]">
                                    <div class="col-span-2 row-span-1">
                                        <img src="${property.images[1] ? '{{ asset('') }}' + property.images[1].image_url : '{{ asset('assets/img/placeholder.jpg') }}'}"
                                            class="w-full h-full object-cover rounded" alt="${property.title}">
                                    </div>
                                    <div class="col-span-2 grid grid-cols-2 grid-rows-1 gap-2">
                                        <div class="col-span-1 row-span-1">
                                            <img src="${property.images[2] ? '{{ asset('') }}' + property.images[2].image_url : '{{ asset('assets/img/placeholder.jpg') }}'}"
                                                class="w-full h-full object-cover rounded" alt="${property.title}">
                                        </div>
                                        <div class="col-span-1 row-span-1">
                                            <img src="${property.images[3] ? '{{ asset('') }}' + property.images[3].image_url : '{{ asset('assets/img/placeholder.jpg') }}'}"
                                                class="w-full h-full object-cover rounded" alt="${property.title}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg text-[#E03C31] mb-2">${property.title}</h3>
                            <p class="text-[#E03C31] font-bold text-xl mb-2">${new Intl.NumberFormat('vi-VN').format(property.price)} VND</p>
                            <p class="text-gray-600 mb-2">${property.area} m² - ${property.property_types ? property.property_types.map(type => type.type_name).join(', ') : 'N/A'}</p>
                            <p class="text-gray-500 text-sm mb-4">${property.description ? property.description.substring(0, 100) : ''}</p>
                            <div class="flex justify-between items-end">
                                <div class="text-gray-500 text-sm">
                                    <p>${new Date(property.created_at).toLocaleDateString('vi-VN')}</p>
                                    <p>${property.location || 'N/A'}</p>
                                </div>
                                <a href="{{ route('properties.show', '') }}/${property.property_id}" class="text-blue-600 hover:underline">Chi tiết</a>
                            </div>
                        </div>
                        </a>
                    </div>
                `).join('') || '<p class="text-gray-600">Không tìm thấy bất động sản nào.</p>');

                        // Cập nhật phân trang
                        $('#pagination').html(response.pagination);
                    },
                    error: function(xhr) {
                        console.error('Error loading properties:', xhr);
                    }
                });
            }

            // Gọi loadProperties khi tải trang
            loadProperties();

            // Xử lý click vào liên kết phân trang
            $(document).on('click', '#pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                loadProperties(page);
            });

            // Xử lý thay đổi bộ lọc
            $('.filter-checkbox').on('change', function() {
                loadProperties();
            });

            $('#search-button').on('click', function(e) {
                e.preventDefault();

                propertyType = $('#property-type').val();
                priceFilter = $('#price-filter').val();
                isVerified = $('#is-verified').is(':checked');
                // let professionalAgent = $('#professional-agent').is(':checked');

                searchTinh = $('#tinh-select').find("option:selected").data("name");
                searchQuan = selectedQuans.map(q => q.name).join(', ');
                loadProperties(1);
            });

            // Load tỉnh
            $.getJSON("https://esgoo.net/api-tinhthanh/1/0.htm")
                .done(function(data_tinh) {
                    if (data_tinh.error === 0) {
                        $.each(data_tinh.data, function(_, t) {
                            $('#tinh-select').append(
                                `<option value="${t.id}" data-name="${t.full_name}">${t.full_name}</option>`
                            );
                        });

                        // Chọn sẵn tỉnh
                        $('#tinh-select').val(defaultTinhId).trigger('change');
                    }
                });

            // $("#tinh_name").val($('#tinh-select').find("option:selected").data("name"));

            // Xử lý khi click vào input để hiển thị dropdown quận/huyện
            $('#search-text').on('click', function() {
                const tinhId = $('#tinh-select').val();
                if (tinhId && tinhId !== 'all') {
                    // Gọi API để lấy danh sách quận/huyện
                    $.getJSON(`https://esgoo.net/api-tinhthanh/2/${tinhId}.htm`)
                        .done(function(data_quan) {
                            if (data_quan.error === 0) {
                                $('#quan-list').empty(); // Xóa danh sách cũ
                                $.each(data_quan.data, function(_, q) {
                                    const isSelected = selectedQuans.some(s => s.id === q.id);
                                    const isDisabled = selectedQuans.length >= maxSelections &&
                                        !isSelected;
                                    $('#quan-list').append(
                                        `<li class="px-4 py-2 hover:bg-gray-100 cursor-pointer ${isSelected ? 'bg-gray-100' : ''} ${isDisabled ? 'text-gray-400 cursor-not-allowed' : ''}" data-id="${q.id}" data-name="${q.full_name}" ${isDisabled ? 'data-disabled="true"' : ''}>${q.full_name}</li>`
                                    );
                                });
                                $('#quan-dropdown').removeClass('hidden');
                            }
                        });
                } else {
                    $('#quan-list').empty();
                    $('#quan-dropdown').addClass('hidden'); // Ẩn dropdown nếu không có tỉnh
                }
            });

            // Xử lý khi chọn quận/huyện
            $('#quan-list').on('click', 'li', function() {
                if ($(this).data('disabled')) return;
                const quanId = $(this).data('id');
                const quanName = $(this).data('name');
                if (!selectedQuans.some(s => s.id === quanId) && selectedQuans.length < maxSelections) {
                    selectedQuans.push({
                        id: quanId,
                        name: quanName
                    });
                    updateSelectedQuans();
                }
                $('#quan-dropdown').addClass('hidden');
            });

            // Cập nhật giao diện các quận đã chọn
            function updateSelectedQuans() {
                $('#selected-quans').empty();
                selectedQuans.forEach(quan => {
                    $('#selected-quans').append(`
                <span class="flex items-center bg-gray-100 text-gray-700 text-sm rounded-full px-3 py-1 mr-2">
                    ${quan.name}
                    <button class="ml-2 text-gray-500 hover:text-red-500 focus:outline-none" data-id="${quan.id}">
                        <i class="fas fa-times"></i>
                    </button>
                </span>
            `);
                });
                // $('#search-text').val(selectedQuans.map(q => q.name).join(', ')); // Cập nhật input
            }

            // Xử lý xóa quận đã chọn
            $('#selected-quans').on('click', 'button', function() {
                const quanId = $(this).data('id');
                selectedQuans = selectedQuans.filter(q => q.id !== quanId);
                updateSelectedQuans();
            });

            // Ẩn dropdown khi click ra ngoài
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-text, #quan-dropdown').length) {
                    $('#quan-dropdown').addClass('hidden');
                }
            });

            // Xử lý khi thay đổi tỉnh
            $('#tinh-select').on('change', function() {
                selectedQuans = [];
                $('#quan-list').empty();
                $('#selected-quans').empty();
                $('#search-text').val('');
                $('#quan-dropdown').addClass('hidden');
            });
        });
    </script>
@endsection
