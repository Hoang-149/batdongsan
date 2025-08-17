$(document).ready(function (e) {
    $(".toggle-password").on("click", function () {
        const $input = $(this).closest(".relative").find("input");
        const type = $input.attr("type") === "password" ? "text" : "password";
        $input.attr("type", type);

        const $icon = $(this).find("svg");
        $icon.toggleClass("fa-eye fa-eye-slash");
    });

    $(".slider-projects").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        autoplay: true, // Auto chạy
        autoplaySpeed: 3000,
    });

    $(".slider-section1-home").slick({
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

    function loadQuan(idtinh) {
        return new Promise((resolve) => {
            $.getJSON(
                "https://esgoo.net/api-tinhthanh/2/" + idtinh + ".htm",
                function (data_quan) {
                    if (data_quan.error == 0) {
                        $("#quan").html(
                            '<option value="0">Quận Huyện</option>'
                        );
                        $("#phuong").html(
                            '<option value="0">Phường Xã</option>'
                        );
                        $.each(data_quan.data, function (key_quan, val_quan) {
                            $("#quan").append(
                                '<option value="' +
                                    val_quan.id +
                                    '" data-name="' +
                                    val_quan.full_name +
                                    '">' +
                                    val_quan.full_name +
                                    "</option>"
                            );
                        });
                    }
                    resolve();
                }
            );
        });
    }

    function loadPhuong(idquan) {
        return new Promise((resolve) => {
            $.getJSON(
                "https://esgoo.net/api-tinhthanh/3/" + idquan + ".htm",
                function (data_phuong) {
                    if (data_phuong.error == 0) {
                        $("#phuong").html(
                            '<option value="0">Phường Xã</option>'
                        );
                        $.each(
                            data_phuong.data,
                            function (key_phuong, val_phuong) {
                                $("#phuong").append(
                                    '<option value="' +
                                        val_phuong.id +
                                        '" data-name="' +
                                        val_phuong.full_name +
                                        '">' +
                                        val_phuong.full_name +
                                        "</option>"
                                );
                            }
                        );
                    }
                    resolve();
                }
            );
        });
    }

    // Hàm này gọi sau khi đã render option tỉnh
    async function setLocationDefault(tinhName, quanName, phuongName) {
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
        if (!tinhId) return;

        // Đợi quận load xong
        await loadQuan(tinhId);

        // Set quận
        let quanId = null;
        $("#quan option").each(function () {
            if (
                ($(this).data("name") || "").toString().trim() ===
                quanName.trim()
            ) {
                quanId = $(this).val();
                $("#quan").val(quanId).trigger("change");
                $("#quan_name").val(quanName);
                return false;
            }
        });
        if (!quanId) return;

        // Đợi phường load xong
        await loadPhuong(quanId);

        // Set phường
        $("#phuong option").each(function () {
            if (
                ($(this).data("name") || "").toString().trim() ===
                phuongName.trim()
            ) {
                $("#phuong").val($(this).val());
                $("#phuong_name").val(phuongName);
                return false;
            }
        });
    }

    $.getJSON("https://esgoo.net/api-tinhthanh/1/0.htm", function (data_tinh) {
        if (data_tinh.error == 0) {
            $.each(data_tinh.data, function (key_tinh, val_tinh) {
                $("#tinh").append(
                    '<option value="' +
                        val_tinh.id +
                        '" data-name="' +
                        val_tinh.full_name +
                        '">' +
                        val_tinh.full_name +
                        "</option>"
                );
            });

            $("#tinh").on("change", function () {
                var idtinh = $(this).val();
                var nameTinh = $(this).find("option:selected").data("name");
                $("#tinh_name").val(nameTinh);
                $("#quan_name").val("");
                $("#phuong_name").val("");
                $.getJSON(
                    "https://esgoo.net/api-tinhthanh/2/" + idtinh + ".htm",
                    function (data_quan) {
                        if (data_quan.error == 0) {
                            $("#quan").html(
                                '<option value="0">Quận Huyện</option>'
                            );
                            $("#phuong").html(
                                '<option value="0">Phường Xã</option>'
                            );

                            $.each(
                                data_quan.data,
                                function (key_quan, val_quan) {
                                    $("#quan").append(
                                        '<option value="' +
                                            val_quan.id +
                                            '" data-name="' +
                                            val_quan.full_name +
                                            '">' +
                                            val_quan.full_name +
                                            "</option>"
                                    );
                                }
                            );

                            $("#quan")
                                .off("change")
                                .on("change", function () {
                                    var idquan = $(this).val();
                                    var nameQuan = $(this)
                                        .find("option:selected")
                                        .data("name");
                                    $("#quan_name").val(nameQuan);
                                    $("#phuong_name").val("");
                                    $.getJSON(
                                        "https://esgoo.net/api-tinhthanh/3/" +
                                            idquan +
                                            ".htm",
                                        function (data_phuong) {
                                            if (data_phuong.error == 0) {
                                                $("#phuong").html(
                                                    '<option value="0">Phường Xã</option>'
                                                );
                                                $.each(
                                                    data_phuong.data,
                                                    function (
                                                        key_phuong,
                                                        val_phuong
                                                    ) {
                                                        $("#phuong").append(
                                                            '<option value="' +
                                                                val_phuong.id +
                                                                '"  data-name="' +
                                                                val_phuong.full_name +
                                                                '">' +
                                                                val_phuong.full_name +
                                                                "</option>"
                                                        );
                                                    }
                                                );
                                            }
                                        }
                                    );
                                });
                            $("#phuong").on("change", function () {
                                var namePhuong = $(this)
                                    .find("option:selected")
                                    .data("name");
                                $("#phuong_name").val(namePhuong);
                            });
                        }
                    }
                );
            });
            if (window.locationDefault) {
                setLocationDefault(
                    window.locationDefault.tinh,
                    window.locationDefault.quan,
                    window.locationDefault.phuong
                );
            }
        }
    });
});
