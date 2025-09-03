$(document).ready(function ($) {
    jQuery(".toggle-password").on("click", function () {
        const $input = $(this).closest(".relative").find("input");
        const type = $input.attr("type") === "password" ? "text" : "password";
        $input.attr("type", type);

        const $icon = $(this).find("svg");
        $icon.toggleClass("fa-eye fa-eye-slash");
    });

    // Slider featured properties (mobile)
    jQuery(".slider-featured-properties").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        responsive: [
            {
                breakpoint: 9999,
                settings: "unslick",
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                },
            },
        ],
    });

    // Slider news (mobile)
    jQuery(".slider-news").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        responsive: [
            {
                breakpoint: 9999,
                settings: "unslick",
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                },
            },
        ],
    });

    jQuery(".slider-projects").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true, // Auto chạy
        autoplaySpeed: 3000,
    });

    jQuery(".slider-section1-home").slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true, // Auto chạy
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });

    ClassicEditor.create(document.querySelector("#content"), {
        ckfinder: {
            uploadUrl:
                "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        },
    }).catch((error) => {
        console.error(error);
    });

    function loadPhuong(idtinh) {
        return new Promise((resolve) => {
            $.getJSON(`/api/phuong/${idtinh}`).done(function (data_phuong) {
                if (data_phuong.error == false) {
                    $("#phuong").html('<option value="0">Phường Xã</option>');
                    $.each(data_phuong.data, function (key_phuong, val_phuong) {
                        $("#phuong").append(
                            '<option value="' +
                                val_phuong.code +
                                '" data-name="' +
                                val_phuong.name +
                                '">' +
                                val_phuong.name +
                                "</option>"
                        );
                    });
                }
                resolve();
            });
        });
    }

    // Hàm này gọi sau khi đã render option tỉnh
    async function setLocationDefault(tinhName, phuongName) {
        $("#loadingSpinner").removeClass("hidden");
        // Set tỉnh
        let tinhId = null;
        $("#tinh option").each(function () {
            if (
                ($(this).data("name") || "").toString().trim() ===
                tinhName.trim()
            ) {
                tinhId = $(this).val();
                $("#tinh").val(tinhId).trigger("change");
                $("#tinh_name").val(tinhName);
                return false;
            }
        });
        if (!tinhId) {
            $("#loadingSpinner").addClass("hidden");
            return;
        }

        // Đợi phường load xong
        await loadPhuong(tinhId);

        // Set phường
        $("#phuong option").each(function () {
            if (
                ($(this).data("name") || "").toString().trim() ===
                phuongName.trim()
            ) {
                $("#phuong").val($(this).val());
                $("#phuong_name").val(phuongName);
                return false; // dừng each
            }
        });
        $("#loadingSpinner").addClass("hidden");
    }

    $.getJSON("/api/tinh", function (data_tinh) {
        if (data_tinh.error == false) {
            $.each(data_tinh.data, function (key_tinh, val_tinh) {
                $("#tinh").append(
                    '<option value="' +
                        val_tinh.code +
                        '" data-name="' +
                        val_tinh.name +
                        '">' +
                        val_tinh.name +
                        "</option>"
                );
            });

            $("#tinh").on("change", function () {
                var idtinh = $(this).val();
                var nameTinh = $(this).find("option:selected").data("name");
                $("#tinh_name").val(nameTinh);
                $("#phuong_name").val("");
                $.getJSON(`/api/phuong/${idtinh}`).done(function (data_phuong) {
                    if (data_phuong.error == false) {
                        if (data_phuong.error == false) {
                            $("#phuong").html(
                                '<option value="0">Phường Xã</option>'
                            );
                            $.each(
                                data_phuong.data,
                                function (key_phuong, val_phuong) {
                                    $("#phuong").append(
                                        '<option value="' +
                                            val_phuong.code +
                                            '"  data-name="' +
                                            val_phuong.name +
                                            '">' +
                                            val_phuong.name +
                                            "</option>"
                                    );
                                }
                            );
                        }
                        $("#phuong").on("change", function () {
                            var namePhuong = $(this)
                                .find("option:selected")
                                .data("name");
                            $("#phuong_name").val(namePhuong);
                        });
                    }
                });
            });
            if (window.locationDefault) {
                setLocationDefault(
                    window.locationDefault.tinh,
                    window.locationDefault.phuong
                );
            }
        }
    });
});
