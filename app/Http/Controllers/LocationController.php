<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function getProvinces()
    {
        try {
            $response = Http::get('https://production.cas.so/address-kit/2025-07-01/provinces');
            $json = $response->json();
            return response()->json([
                'error' => false,
                'data' => $json['provinces'] ?? []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function getWards($districtId)
    {
        try {
            $response = Http::get("https://production.cas.so/address-kit/2025-07-01/provinces/{$districtId}/communes");
            $json = $response->json();
            return response()->json([
                'error' => false,
                'data' => $json['communes'] ?? []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
