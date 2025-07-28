<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\TypicalBusiness;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $businesses = TypicalBusiness::all();
        $properties = Property::with('images')
            ->orderBy('created_at', 'desc')
            ->orderBy('price', 'desc')
            ->take(8)
            ->get();
        return view('pages.index', compact('businesses', 'properties'));
    }
}
