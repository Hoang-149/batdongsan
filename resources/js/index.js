jQuery(document).ready(function ($) {
    const tabs = ["ban", "thue", "du-an"];
    // const defaultTinhId = 48;
    const maxSelections = 3;

    // Chuyển tab
    $("nav.nav-search a").click(function (e) {
        e.preventDefault();
        const target = $(this).data("id");

        $(".tab-content").addClass("hidden");
        $("nav.nav-search a").removeClass("active-tab");

        $(this).addClass("active-tab");
        $("#" + target).removeClass("hidden");
    });

    tabs.forEach(function (type) {
        let selectedQuans = [];

        // Load tỉnh
        $.getJSON("/api/tinh").done(function (data_tinh) {
            if (data_tinh.error === 0) {
                $.each(data_tinh.data, function (_, t) {
                    $(`#tinh-select-${type}`).append(
                        `<option value="${t.id}" data-name="${t.full_name}">${t.full_name}</option>`
                    );
                });
                // $(`#tinh-select-${type}`).val(defaultTinhId).trigger("change");
            }
        });

        // Click ô nhập địa điểm
        $(`#search-text-${type}`).on("click", function () {
            const tinhId = $(`#tinh-select-${type}`).val();
            if (tinhId && tinhId !== "all") {
                $.getJSON(`/api/quan/${tinhId}`).done(function (data_quan) {
                    if (data_quan.error === 0) {
                        $(`#quan-list-${type}`).empty();
                        $.each(data_quan.data, function (_, q) {
                            const isSelected = selectedQuans.some(
                                (s) => s.id === q.id
                            );
                            const isDisabled =
                                selectedQuans.length >= maxSelections &&
                                !isSelected;
                            $(`#quan-list-${type}`).append(
                                `<li class="px-4 py-2 hover:bg-gray-100 cursor-pointer ${
                                    isSelected ? "bg-gray-100" : ""
                                } ${
                                    isDisabled
                                        ? "text-gray-400 cursor-not-allowed"
                                        : ""
                                }" data-id="${q.id}" data-name="${
                                    q.full_name
                                }" ${
                                    isDisabled ? 'data-disabled="true"' : ""
                                }>${q.full_name}</li>`
                            );
                        });
                        $(`#quan-dropdown-${type}`).removeClass("hidden");
                    }
                });
            } else {
                $(`#quan-list-${type}`).empty();
                $(`#quan-dropdown-${type}`).addClass("hidden");
            }
        });

        // Chọn quận
        $(`#quan-list-${type}`).on("click", "li", function () {
            if ($(this).data("disabled")) return;
            const quanId = $(this).data("id");
            const quanName = $(this).data("name");
            if (
                !selectedQuans.some((s) => s.id === quanId) &&
                selectedQuans.length < maxSelections
            ) {
                selectedQuans.push({ id: quanId, name: quanName });
                updateSelectedQuans();
            }
            $(`#quan-dropdown-${type}`).addClass("hidden");
        });

        // Update danh sách quận đã chọn
        function updateSelectedQuans() {
            $(`#selected-quans-${type}`).empty();
            selectedQuans.forEach((quan) => {
                $(`#selected-quans-${type}`).append(`
                    <span class="flex items-center bg-gray-100 text-gray-700 text-sm rounded-full px-3 py-1 mr-2">
                        ${quan.name}
                        <button class="ml-2 text-gray-500 hover:text-red-500" data-id="${quan.id}">
                            <i class="fas fa-times"></i>
                        </button>
                    </span>
                `);
            });
        }

        // Xóa quận đã chọn
        $(`#selected-quans-${type}`).on("click", "button", function () {
            const quanId = $(this).data("id");
            selectedQuans = selectedQuans.filter((q) => q.id !== quanId);
            updateSelectedQuans();
        });

        // Ẩn dropdown khi click ngoài
        $(document).on("click", function (e) {
            if (
                !$(e.target).closest(
                    `#search-text-${type}, #quan-dropdown-${type}`
                ).length
            ) {
                $(`#quan-dropdown-${type}`).addClass("hidden");
            }
        });

        // Khi đổi tỉnh
        $(`#tinh-select-${type}`).on("change", function () {
            selectedQuans = [];
            $(`#quan-list-${type}`).empty();
            $(`#selected-quans-${type}`).empty();
            $(`#search-text-${type}`).val("");
            $(`#quan-dropdown-${type}`).addClass("hidden");
        });

        // Nút tìm kiếm
        $(`#search-button-${type}`).on("click", function (e) {
            e.preventDefault();
            let propertyType = $(`#property-type-${type}`).val();
            let priceFilter = $(`#price-filter-${type}`).val();
            let statusFilter = $(`#status`).val();
            let areaRanges = $(`#area-filter-${type}`).val();
            let searchTinh = $(`#tinh-select-${type}`)
                .find("option:selected")
                .data("name");
            let searchQuan = selectedQuans.map((q) => q.name).join(", ");
            let searchQuanIds = selectedQuans.map((q) => q.id).join(",");

            const query_nha_dat = $.param({
                property_type: propertyType,
                price_filter: priceFilter,
                "area_ranges[]": areaRanges,
                search_tinh: searchTinh,
                search_quan: searchQuan,
                search_quan_ids: searchQuanIds,
            });

            const query_du_an = $.param({
                tinh_name: searchTinh,
                price_filter: priceFilter,
                status: statusFilter,
            });

            window.location.href =
                type == "du-an"
                    ? `/${type}?` + query_du_an
                    : `/nha-dat-${type}?` + query_nha_dat;
        });
    });

    // Mặc định mở tab đầu tiên
    $("nav.nav-search a").first().trigger("click");
});
