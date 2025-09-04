<?php

if (!function_exists('format_price')) {
    function format_price($price)
    {
        if (!$price) {
            return 'Thỏa thuận';
        }

        if ($price >= 1000) {
            // từ 1 tỷ trở lên
            $value = $price / 1000;
            return rtrim(rtrim(number_format($value, 2), '0'), '.') . ' tỷ';
        } elseif ($price >= 1) {
            // từ 1 triệu trở lên
            $value = $price / 1;
            return rtrim(rtrim(number_format($value, 2), '0'), '.') . ' triệu';
        }

        // nhỏ hơn 1 triệu thì giữ nguyên
        return number_format($price) . ' VNĐ';
    }
}
