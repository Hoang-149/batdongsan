<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Initialize query
        $query = Property::query()->with('images', 'propertyType', 'location');

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by property type
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }

        // Filter by price range
        if ($request->filled('price_range')) {
            $ranges = [
                'under_1b' => [0, 1000000000],
                '1b_2b' => [1000000000, 2000000000],
                '2b_3b' => [2000000000, 3000000000],
                '3b_5b' => [3000000000, 5000000000],
            ];
            if (isset($ranges[$request->input('price_range')])) {
                $query->whereBetween('price', $ranges[$request->input('price_range')]);
            }
        }

        // Filter by area range
        if ($request->filled('area_range')) {
            $ranges = [
                'under_30' => [0, 30],
                '30_50' => [30, 50],
                '50_80' => [50, 80],
                '80_100' => [80, 100],
            ];
            if (isset($ranges[$request->input('area_range')])) {
                $query->whereBetween('area', $ranges[$request->input('area_range')]);
            }
        }

        // Filter by verified status
        if ($request->filled('is_verified')) {
            $query->where('is_verified', $request->input('is_verified') === '1');
        }

        // Sorting
        $sort = $request->input('sort', 'default');
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'price_low_high') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high_low') {
            $query->orderBy('price', 'desc');
        }

        // Paginate results (e.g., 10 per page)
        $properties = $query->paginate(10);

        // Fetch property types for dropdown
        $propertyTypes = \App\Models\PropertyType::all();

        return view('pages.nha_dat_ban', compact('properties', 'propertyTypes'));
    }
}
