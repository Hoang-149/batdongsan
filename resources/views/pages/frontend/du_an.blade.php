@extends('layouts.main')
@section('title', 'Dự án Bất động sản')
@section('app-container-class', 'w-full')
@section('content')

    <section class="w-full">
        <div class="slider-projects">
            <div>
                <img src="https://mdbootstrap.com/img/new/slides/054.jpg" class="w-full h-auto object-cover rounded-lg"
                    alt="Banner 1">
            </div>
            <div>
                <img src="https://mdbootstrap.com/img/new/slides/043.jpg" class="w-full h-auto object-cover rounded-lg"
                    alt="Banner 2">
            </div>
            <div>
                <img src="https://mdbootstrap.com/img/new/slides/052.jpg" class="w-full h-auto object-cover rounded-lg"
                    alt="Banner 3">
            </div>
        </div>
    </section>

    <div class="w-full max-w-[1140px] mx-auto">
        <div class="container mx-auto px-4">
            <div class="bg-gray-100 py-6">
                <!-- Bộ lọc -->
                <div class="bg-white rounded-lg shadow p-4 mb-6">
                    <form id="filterForm"
                        class="grid grid-cols-1 md:grid-cols-5 gap-8 items-end bg-white p-4 rounded-lg shadow">
                        <!-- Location -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Khu vực
                            </label>
                            <select
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                                id="tinh" name="location" title="Chọn Tỉnh Thành">
                                <option value="0">Tỉnh Thành</option>
                            </select>
                            <input type="hidden" name="tinh_name" id="tinh_name" />
                        </div>

                        <!-- Area -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fas fa-ruler-combined text-green-500 mr-1"></i> Diện tích
                            </label>
                            <select name="area_range"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
                                <option value="">Tất cả</option>
                                <option value="0-50">Dưới 50m²</option>
                                <option value="50-100">50 - 100m²</option>
                                <option value="100-200">100 - 200m²</option>
                                <option value="200-+">Trên 200m²</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">
                                <i class="fas fa-dollar-sign text-yellow-500 mr-1"></i> Giá (triệu)
                            </label>
                            <select name="price_range"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-yellow-500 focus:border-yellow-500">
                                <option value="">Tất cả</option>
                                <option value="0-500">Dưới 500</option>
                                <option value="500-1000">500 - 1000</option>
                                <option value="1000-2000">1000 - 2000</option>
                                <option value="2000-+">Trên 2000</option>
                            </select>
                        </div>

                        <!-- Filter Button -->
                        <div>
                            <button type="button" id="btnFilter"
                                class="w-full flex items-center justify-center space-x-2 bg-red-500 hover:bg-red-600 active:scale-95 transition-transform duration-150 text-white font-bold py-2 px-4 rounded-lg shadow">
                                <i class="fas fa-filter"></i>
                                <span>Lọc</span>
                                <!-- Loading Spinner -->
                                <i id="filterLoading" class="hidden fas fa-spinner fa-spin ml-2"></i>
                            </button>
                        </div>

                        <!-- Reset Button -->
                        <div>
                            <button type="button" id="btnReset"
                                class="w-full flex items-center justify-center space-x-2 bg-gray-200 hover:bg-gray-300 active:scale-95 transition-transform duration-150 text-gray-700 font-semibold py-2 px-4 rounded-lg shadow">
                                <i class="fas fa-sync-alt"></i>
                                <span>Reset</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Danh sách dự án -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 flex flex-col space-y-6">

                        <div id="loadingSpinner"
                            class="hidden fixed inset-0 bg-gray-900 bg-opacity-40 flex items-center justify-center z-50">
                            <div class="w-12 h-12 border-4 border-white border-t-transparent rounded-full animate-spin">
                            </div>
                        </div>

                        <div class="" id="projectList">
                            @include('partials.project_list', ['projects' => $projects])
                        </div>

                        <div id="projectPagination">
                            @include('partials.pagination', ['paginator' => $projects])
                        </div>
                    </div>


                    <aside class="space-y-8">
                        <aside class="space-y-8">
                            {{-- Tin nổi bật --}}
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <h2 class="text-lg font-bold mb-4 border-b pb-2">Tin tức</h2>
                                <ul class="space-y-4">
                                    @foreach ($allNews as $item)
                                        <li class="flex items-start space-x-3">
                                            <div>
                                                <a href="{{ route('news.detail', $item->id) }}"
                                                    class="text-sm font-semibold text-gray-800 hover:text-red-600">
                                                    {{ Str::words($item->title, 10, '...') }}
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </aside>
                    </aside>
                </div>

            </div>
        </div>
    </div>

    <style>
        .slick-initialized .slick-slide {
            margin: 0;
        }
    </style>

    <script>
        $(document).ready(function() {
            const route = "{{ route('projects') }}";

            function showLoading() {
                $("#loadingSpinner").removeClass("hidden");
            }

            function hideLoading() {
                $("#loadingSpinner").addClass("hidden");
            }

            function fetchProjects(url = route) {
                showLoading();
                $.ajax({
                    url: url,
                    type: "GET",
                    data: $("#filterForm").serialize(),
                    dataType: "json",
                    success: function(data) {
                        $("#projectList").html(data.html);
                        $("#projectPagination").html(data.pagination);
                        bindPaginationLinks();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            }

            $("#btnFilter").on("click", function() {
                fetchProjects();
            });

            $("#btnReset").on("click", function() {
                $("#filterForm")[0].reset();
                fetchProjects();
            });

            function bindPaginationLinks() {
                $("#projectPagination").find("a").on("click", function(e) {
                    e.preventDefault();
                    let url = $(this).attr("href");
                    if (url) fetchProjects(url);
                });
            }

            bindPaginationLinks();
        });
    </script>

@endsection
