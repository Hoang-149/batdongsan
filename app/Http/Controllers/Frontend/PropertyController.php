<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function indexBan(Request $request)
    {
        $query = Property::with('images')
            ->where('is_verified', 1)
            ->whereIn('demande', [0, 1]);

        // Xử lý bộ lọc giá
        if ($request->has('price_ranges')) {
            $priceRanges = $request->input('price_ranges', []);
            $query->where(function ($q) use ($priceRanges) {
                if (in_array('under_1b', $priceRanges)) {
                    $q->orWhere('price', '<', 1000000000);
                }
                if (in_array('1b_5b', $priceRanges)) {
                    $q->orWhereBetween('price', [1000000000, 5000000000]);
                }
                if (in_array('5b_10b', $priceRanges)) {
                    $q->orWhereBetween('price', [5000000000, 10000000000]);
                }
                if (in_array('above_10b', $priceRanges)) {
                    $q->orWhere('price', '>', 10000000000);
                }
            });
        }

        // Xử lý bộ lọc diện tích
        if ($request->has('area_ranges')) {
            $areaRanges = $request->input('area_ranges', []);
            $query->where(function ($q) use ($areaRanges) {
                if (in_array('under_30', $areaRanges)) {
                    $q->orWhere('area', '<', 30);
                }
                if (in_array('30_50', $areaRanges)) {
                    $q->orWhereBetween('area', [30, 50]);
                }
                if (in_array('50_100', $areaRanges)) {
                    $q->orWhereBetween('area', [50, 100]);
                }
                if (in_array('above_100', $areaRanges)) {
                    $q->orWhere('area', '>', 100);
                }
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('location', 'like', "%{$search}%");
        }

        if ($request->filled('property_type')) {
            $type = $request->input('property_type');
            $query->whereHas('propertyTypes', function ($query) use ($type) {
                $query->where('propertytypeproperty.type_id', $type);
            });
        }


        if ($request->filled('price_filter')) {
            switch ($request->input('price_filter')) {
                case 'under_1b':
                    $query->where('price', '<', 1000000000);
                    break;
                case '1b_3b':
                    $query->whereBetween('price', [1000000000, 3000000000]);
                    break;
                case 'over_3b':
                    $query->where('price', '>', 3000000000);
                    break;
            }
        }
        // Log::info($request->boolean('is_verified') ? 1 : 0);
        if ($request->boolean('is_verified')) {
            $query->where('is_verified', true);
        }

        // if ($request->has('professional_agent') && $request->professional_agent) {
        //     $query->whereHas('user', function ($q) {
        //         // Giả sử bảng users có cột is_professional_agent để xác định môi giới chuyên nghiệp
        //         $q->where('is_professional_agent', true);
        //     });
        // }


        // Phân trang
        $perPage = 2; // Số bất động sản mỗi trang
        $properties = $query->paginate($perPage);

        // Trả về JSON nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return response()->json([
                'properties' => $properties->items(), // Danh sách bất động sản
                'pagination' => view('partials.pagination', ['paginator' => $properties])->render(),

                'total' => $properties->total(), // Tổng số bản ghi
                'current_page' => $properties->currentPage(), // Trang hiện tại
                'last_page' => $properties->lastPage(), // Trang cuối
            ]);
        }

        return view('pages.frontend.nha_dat_ban', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::with('images')->findOrFail($id);
        return view('pages.frontend.show_properties', compact('property'));
    }

    public function indexThue(Request $request)
    {

        $query = Property::with('images')
            ->where('is_verified', 1)
            ->whereIn('demande', [1, 2]);

        // Xử lý bộ lọc giá
        if ($request->has('price_ranges')) {
            $priceRanges = $request->input('price_ranges', []);
            $query->where(function ($q) use ($priceRanges) {
                if (in_array('under_1b', $priceRanges)) {
                    $q->orWhere('price', '<', 1000000000);
                }
                if (in_array('1b_5b', $priceRanges)) {
                    $q->orWhereBetween('price', [1000000000, 5000000000]);
                }
                if (in_array('5b_10b', $priceRanges)) {
                    $q->orWhereBetween('price', [5000000000, 10000000000]);
                }
                if (in_array('above_10b', $priceRanges)) {
                    $q->orWhere('price', '>', 10000000000);
                }
            });
        }

        // Xử lý bộ lọc diện tích
        if ($request->has('area_ranges')) {
            $areaRanges = $request->input('area_ranges', []);
            $query->where(function ($q) use ($areaRanges) {
                if (in_array('under_30', $areaRanges)) {
                    $q->orWhere('area', '<', 30);
                }
                if (in_array('30_50', $areaRanges)) {
                    $q->orWhereBetween('area', [30, 50]);
                }
                if (in_array('50_100', $areaRanges)) {
                    $q->orWhereBetween('area', [50, 100]);
                }
                if (in_array('above_100', $areaRanges)) {
                    $q->orWhere('area', '>', 100);
                }
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('location', 'like', "%{$search}%");
        }

        if ($request->filled('property_type')) {
            $type = $request->input('property_type');
            $query->whereHas('propertyTypes', function ($query) use ($type) {
                $query->where('propertytypeproperty.type_id', $type);
            });
        }


        if ($request->filled('price_filter')) {
            switch ($request->input('price_filter')) {
                case 'under_1b':
                    $query->where('price', '<', 1000000000);
                    break;
                case '1b_3b':
                    $query->whereBetween('price', [1000000000, 3000000000]);
                    break;
                case 'over_3b':
                    $query->where('price', '>', 3000000000);
                    break;
            }
        }
        // Log::info($request->boolean('is_verified') ? 1 : 0);
        if ($request->boolean('is_verified')) {
            $query->where('is_verified', true);
        }

        // if ($request->has('professional_agent') && $request->professional_agent) {
        //     $query->whereHas('user', function ($q) {
        //         // Giả sử bảng users có cột is_professional_agent để xác định môi giới chuyên nghiệp
        //         $q->where('is_professional_agent', true);
        //     });
        // }


        // Phân trang
        $perPage = 2; // Số bất động sản mỗi trang
        $properties = $query->paginate($perPage);

        // Trả về JSON nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return response()->json([
                'properties' => $properties->items(), // Danh sách bất động sản
                'pagination' => view('partials.pagination', ['paginator' => $properties])->render(),

                'total' => $properties->total(), // Tổng số bản ghi
                'current_page' => $properties->currentPage(), // Trang hiện tại
                'last_page' => $properties->lastPage(), // Trang cuối
            ]);
        }

        return view('pages.frontend.nha_dat_thue', compact('properties'));
    }

    public function createProperty()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đăng tin.');
        }

        // Log::info('success!  ' . auth()->user()->username);
        $propertyTypes = PropertyType::all();
        $user = auth()->user();
        $properties = $user->properties()->with(['images'])->get();
        return view('pages.frontend.create_property', compact('user', 'properties', 'propertyTypes'));
    }
}
