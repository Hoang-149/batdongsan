<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\News;
use App\Models\Project;
use App\Models\Property;
use App\Models\TypicalBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate dữ liệu
            $request->validate([
                'full_name'   => 'nullable|string|max:255',
                'msThue'      =>  [
                    'nullable',
                    'regex:/^\d{10}(-\d{3})?$/'
                ],
                'phone_number' => 'required|nullable|string|max:20',
                'email'       => 'nullable|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
                'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'msThue.regex' => 'Mã số thuế phải gồm 10 hoặc 13 chữ số (có thể ở dạng 1234567890 hoặc 1234567890-123).',
            ]);

            $path = 'uploads/user/';
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }

            $data = [
                'full_name' => $request->full_name,
                'msThue' =>  $request->msThue,
                'phone_number' =>  $request->phone_number,
                'email' =>  $request->email,
            ];

            if ($file = $request->file('avatar')) {
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    unlink(public_path($user->avatar));
                }

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path($path), $filename);
                $data['avatar'] = $path . $filename;
            }

            $user->update($data);

            return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
        } catch (ValidationException $e) {
            Log::error('Validation failed', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }


    public function projects(Request $request)
    {
        $allBanner = Banner::all();

        $query = Project::with(['images', 'user'])
            ->where('is_verified', true);

        // Filter Location
        if ($request->filled('tinh_name') && $request->tinh_name !== '' && $request->tinh_name !== '0') {
            // Lấy trước dấu phẩy đầu tiên
            // $locationParts = explode(',', $request->tinh_name);
            // $city = trim($locationParts[0]);

            $city = $request->tinh_name;
            if ($city !== '' && strtolower($city) !== 'tỉnh thành') {
                $query->where('location', 'like', "%$city%");
            }
        }

        // Filter price
        $priceFilter = $request->input('price_filter');
        if (!empty($priceFilter)) {
            switch ($priceFilter) {
                case 'under_5':
                    $query->where('price', '<', 5);
                    break;
                case '5m_50m':
                    $query->whereBetween('price', [5, 50]);
                    break;
                case '50m_100m':
                    $query->whereBetween('price', [50, 100]);
                    break;
                case 'over_100':
                    $query->where('price', '>', 100);
                    break;
            }
        }

        // Filter status
        $statusFilter = $request->input('status');
        if ($statusFilter !== null && $statusFilter !== '') {
            $query->where('status', $statusFilter);
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

        return view('pages.frontend.du_an', compact('allBanner', 'projects', 'allNews'));
    }


    public function projectDetail($slug)
    {
        $project = Project::with(['images', 'user'])->where('slug', $slug)->firstOrFail();

        $otherProjects = Project::with('images')
            ->where('is_verified', true)
            ->where('project_id', '!=', $project->project_id)
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

    public function newsDetail($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $allNews = News::where('is_verified', true)
            ->where('id', '!=', $news->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        return view('pages.frontend.chi_tiet_tin_tuc', compact('news', 'allNews'));
    }
}
