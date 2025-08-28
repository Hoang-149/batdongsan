<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    public function getProvinces()
    {
        try {
            $response = Http::get('https://esgoo.net/api-tinhthanh/1/0.htm');
            return $response->json(); // Xem raw JSON
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Lấy danh sách quận/huyện theo tỉnh
    public function getDistricts($provinceId)
    {
        $response = Http::get("https://esgoo.net/api-tinhthanh/2/{$provinceId}.htm");
        return response()->json($response->json());
    }
    // Lấy danh sách phường/xã theo quận/huyện
    public function getWards($districtId)
    {
        $response = Http::get("https://esgoo.net/api-tinhthanh/3/{$districtId}.htm");
        return response()->json($response->json());
    }
}
