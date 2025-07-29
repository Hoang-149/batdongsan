<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\TypicalBusiness;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $businesses = TypicalBusiness::all();
        $properties = Property::with(['images', 'user'])
            ->orderBy('created_at', 'desc')
            ->orderBy('price', 'desc')
            ->take(8)
            ->get();
        return view('pages.index', compact('businesses', 'properties'));
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
}
