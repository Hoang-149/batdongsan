<?php

namespace App\Http\Controllers\Admin;

use App\Models\TypicalBusiness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypicalBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $businesses = TypicalBusiness::paginate(10);
        return view('pages.admin.typical_business.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.typical_business.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = 'uploads/typical_business/';
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0755, true);
        }

        $file = $request->file('image');
        $ex = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $ex;
        $file->move(public_path($path), $filename);

        TypicalBusiness::create([
            'image_url' => $path . $filename,
        ]);

        return redirect()->route('admin.typical_business.index')
            ->with('success', 'Tạo logo doanh nghiệp tiêu biểu thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $business = TypicalBusiness::findOrFail($id);
        return view('pages.admin.typical_business.edit', compact('business'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $business = TypicalBusiness::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [];
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($business->image_url && file_exists(public_path($business->image_url))) {
                unlink(public_path($business->image_url));
            }

            $path = 'uploads/typical_business/';
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }

            $file = $request->file('image');
            $ex = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $ex;
            $file->move(public_path($path), $filename);

            $data['image_url'] = $path . $filename;
        }

        $business->update($data);

        return redirect()->route('admin.typical_business.index')
            ->with('success', 'Typical business updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $business = TypicalBusiness::findOrFail($id);

        // Delete image from storage
        if ($business->image_url && file_exists(public_path($business->image_url))) {
            unlink(public_path($business->image_url));
        }

        $business->delete();

        return redirect()->route('admin.typical_business.index')
            ->with('success', 'Typical business deleted successfully.');
    }
}
