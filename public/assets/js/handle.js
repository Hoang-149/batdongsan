$(document).ready(function (e) {
    console.log("Test");

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
        }
    });
});
