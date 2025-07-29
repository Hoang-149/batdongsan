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
        // Initialize query
        // $query = Property::query()->with('images');

        // // Search by title or description
        // if ($request->filled('search')) {
        //     $search = $request->input('search');
        //     $query->where(function ($q) use ($search) {
        //         $q->where('title', 'like', "%{$search}%")
        //             ->orWhere('description', 'like', "%{$search}%");
        //     });
        // }

        // // // Filter by property type
        // // if ($request->filled('type_id')) {
        // //     $query->where('type_id', $request->input('type_id'));
        // // }

        // // Filter by price range
        // if ($request->filled('price_range')) {
        //     $ranges = [
        //         'under_1b' => [0, 1000000000],
        //         '1b_2b' => [1000000000, 2000000000],
        //         '2b_3b' => [2000000000, 3000000000],
        //         '3b_5b' => [3000000000, 5000000000],
        //     ];
        //     if (isset($ranges[$request->input('price_range')])) {
        //         $query->whereBetween('price', $ranges[$request->input('price_range')]);
        //     }
        // }

        // // Filter by area range
        // if ($request->filled('area_range')) {
        //     $ranges = [
        //         'under_30' => [0, 30],
        //         '30_50' => [30, 50],
        //         '50_80' => [50, 80],
        //         '80_100' => [80, 100],
        //     ];
        //     if (isset($ranges[$request->input('area_range')])) {
        //         $query->whereBetween('area', $ranges[$request->input('area_range')]);
        //     }
        // }

        // // Filter by verified status
        // if ($request->filled('is_verified')) {
        //     $query->where('is_verified', $request->input('is_verified') === '1');
        // }

        // // Sorting
        // $sort = $request->input('sort', 'default');
        // if ($sort === 'newest') {
        //     $query->orderBy('created_at', 'desc');
        // } elseif ($sort === 'price_low_high') {
        //     $query->orderBy('price', 'asc');
        // } elseif ($sort === 'price_high_low') {
        //     $query->orderBy('price', 'desc');
        // }

        // // Paginate results (e.g., 10 per page)
        // $properties = $query->paginate(10);

        // // Fetch property types for dropdown
        // $propertyTypes = \App\Models\PropertyType::all();

        // return view('pages.frontend.nha_dat_ban', compact('properties', 'propertyTypes'));

        // $properties = Property::with('images')
        //     ->whereHas('propertyTypes', function ($query) {
        //         $query->where('propertytypeproperty.type_id', 2);
        //     })
        //     ->get();

        // Xây dựng truy vấn cơ bản
        // $query = Property::with('images')
        //     ->whereHas('propertyTypes', function ($query) {
        //         $query->where('propertytypeproperty.type_id', 2);
        //     });

        $query = Property::with('images')
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

        Log::info('success!  ' . auth()->user()->username);
        $propertyTypes = PropertyType::all();
        $user = auth()->user();
        $properties = $user->properties()->with(['images'])->get();
        return view('pages.frontend.create_property', compact('user', 'properties', 'propertyTypes'));
    }
}
