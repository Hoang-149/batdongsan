<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Project;
use App\Models\Property;
use App\Models\TypicalBusiness;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $businesses = TypicalBusiness::all();
        $properties = Property::with(['images', 'user'])
            ->where('is_verified', 1)
            ->orderBy('created_at', 'desc')
            ->orderBy('price', 'desc')
            ->take(8)
            ->get();
        $news = News::where('is_verified', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('pages.index', compact('businesses', 'properties', 'news'));
    }
    public function profile()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem trang cá nhân.');
        }

        $user = auth()->user();
        $properties = $user->properties()->with(['images'])->get();

        return view('pages.frontend.profile', compact('user', 'properties'));
    }

    public function projects(Request $request)
    {
        $query = Project::with(['images', 'user'])
            ->where('is_verified', true);

        // Filter Location
        if ($request->filled('tinh_name')) {
            // Lấy trước dấu phẩy đầu tiên
            $locationParts = explode(',', $request->tinh_name);
            $city = trim($locationParts[0]);
            $query->where('location', 'like', "%$city%");
        }

        // Filter Area
        if ($request->filled('area_range')) {
            [$min, $max] = explode('-', $request->area_range);
            if ($max === '+') {
                $query->where('area', '>=', (int) $min);
            } else {
                $query->whereBetween('area', [(int) $min, (int) $max]);
            }
        }

        // Filter Price
        if ($request->filled('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            if ($max === '+') {
                $query->where('price', '>=', (int) $min);
            } else {
                $query->whereBetween('price', [(int) $min, (int) $max]);
            }
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(6);

        $allNews = News::where('is_verified', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Check Ajax bằng request()->ajax()
        if ($request->ajax()) {
            $html = view('partials.project_list', compact('projects'))->render();
            $pagination = $projects->links('pagination::tailwind')->toHtml();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('pages.frontend.du_an', compact('projects', 'allNews'));
    }


    public function projectDetail($id)
    {
        $project = Project::with(['images', 'user'])
            ->findOrFail($id);

        $otherProjects = Project::with('images')
            ->where('is_verified', true)
            ->where('project_id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('pages.frontend.chi_tiet_du_an', compact('project', 'otherProjects'));
    }


    public function news()
    {
        $news = News::where('is_verified', true)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        return view('pages.frontend.tin_tuc', compact('news'));
    }

    public function newsDetail($id)
    {
        $news = News::findOrFail($id);
        $allNews = News::where('is_verified', true)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        return view('pages.frontend.chi_tiet_tin_tuc', compact('news', 'allNews'));
    }
}
