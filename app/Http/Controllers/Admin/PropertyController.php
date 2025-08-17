<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Project;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\User;
use App\Models\VipSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties.
     */
    public function index()
    {
        $properties = Property::with('user', 'project', 'propertyTypes', 'images')->paginate(10);
        return view('pages.admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $users = User::all();
        $propertyTypes = PropertyType::all();
        $projects = Project::all();
        return view('pages.admin.properties.create', compact('users', 'propertyTypes', 'projects'));
    }

    /**
     * Store a newly created property in the database.
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|exists:Users,user_id',
                'type_id' => 'required|array|min:1',
                'type_id.*' => 'exists:propertytypes,type_id',
                'phuong_name' => 'required|string|not_in:0', // Validate tỉnh
                'quan_name' => 'required|string|not_in:0', // Validate quận
                'tinh_name' => 'required|string|not_in:0', // Validate phường
                'project_id' => 'nullable|exists:projects,project_id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0|max:99999999999999999.99',
                'area' => 'nullable|numeric|min:0',
                'demande' => 'required',
                'is_for_sale' => 'required|boolean',
                'is_verified' => 'required|boolean',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:10240',
                'images' => 'required|array|min:4',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Tạo chuỗi location từ tỉnh, quận, phường
            $location = $request->tinh_name . ', ' . $request->quan_name . ', ' . $request->phuong_name;

            // dd($request->all());

            $property = Property::create([
                'user_id' => $request->user_id,
                // 'type_id' => $request->type_id,
                'location' => $location, // Lưu chuỗi location
                'project_id' => $request->project_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'demande' => $request->demande,
                'is_for_sale' => $request->is_for_sale,
                'is_verified' => $request->is_verified,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!empty($request->type_id)) {
                $property->propertyTypes()->attach($request->type_id);
            }

            // Handle multiple image uploads
            if ($files = $request->file('images')) {
                $path = 'uploads/property/';
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0755, true);
                }

                foreach ($files as $file) {
                    $ex = $file->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $ex;
                    $file->move($path, $filename);

                    PropertyImage::create([
                        'property_id' => $property->property_id,
                        'image_url' => $path . $filename,
                    ]);
                }
            }

            if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.properties.create')->with('success', 'Tạo bài đăng thành công.');
            } else {
                return redirect()->route('profile')->with('success', 'Tạo bài đăng thành công.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi tạo bài đăng' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $property = Property::with('user', 'project', 'propertyTypes', 'images')->findOrFail($id);
        $users = User::all();
        $projects = Project::all();
        $propertyTypes = PropertyType::all();

        return view('pages.admin.properties.edit', compact('property', 'users',  'projects', 'propertyTypes'));
    }

    /**
     * Update the specified property in the database.
     */
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|exists:Users,user_id',
                'type_id' => 'required|array|min:1',
                'type_id.*' => 'exists:propertytypes,type_id',
                'phuong_name' => 'required|string|not_in:0', // Validate tỉnh
                'quan_name' => 'required|string|not_in:0', // Validate quận
                'tinh_name' => 'required|string|not_in:0', // Validate phường
                'project_id' => 'nullable|exists:projects,project_id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0|max:99999999999999999.99',
                'area' => 'nullable|numeric|min:0',
                'demande' => 'required',
                'is_for_sale' => 'required|boolean',
                'is_verified' => 'required|boolean',
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
                'images' => 'nullable|array',
                'delete_images' => 'nullable|array',
                'delete_images.*' => 'exists:property_images,image_id',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Tạo chuỗi location từ tỉnh, quận, phường
            $location = $request->tinh_name . ', ' . $request->quan_name . ', ' . $request->phuong_name;

            // Update property with validated data
            $property->update([
                'user_id' => $request->user_id,
                'location' => $location,
                'project_id' => $request->project_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'demande' => $request->demande,
                'is_for_sale' => $request->is_for_sale,
                'is_verified' => $request->is_verified,
                'updated_at' => now(),
            ]);

            if (!empty($request->type_id)) {
                $property->propertyTypes()->sync($request->type_id); // Sync để cập nhật hoặc xóa các loại cũ
            }

            // Handle image deletions
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = PropertyImage::find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image_url);
                        $image->delete();
                    }
                }
            }

            // Kiểm tra tổng số hình ảnh sau khi xóa
            $remainingImages = $property->images()->count();
            $newImages = $request->file('images') ? count($request->file('images')) : 0;
            if ($remainingImages + $newImages < 4) {
                return redirect()->back()
                    ->with('error', 'Tổng số hình ảnh (hiện tại trừ đi số bị xóa + mới thêm) phải ít nhất là 4.')
                    ->withInput();
            }

            // Handle multiple image uploads
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('uploads/property', $filename, 'public');

                    PropertyImage::create([
                        'property_id' => $property->property_id,
                        'image_url' => $path,
                    ]);
                }
            }

            return redirect()->route('admin.properties.index')
                ->with('success', 'Đã cập nhật bài đăng thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Lỗi cập nhật: ' . $e->getMessage())
                ->withInput();
        }
    }
    /**
     * Delete the specified property from the database.
     */
    public function destroy($id)
    {
        try {
            $property = Property::findOrFail($id);
            foreach ($property->images as $image) {
                Storage::disk('public')->delete($image->image_url);
                $image->delete();
            }
            $property->delete();
            return redirect()->route('admin.properties.index')->with('success', 'Xóa bài đăng thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.properties.index')->with('error', 'Lỗi khi xóa bài đăng: ' . $e->getMessage());
        }
    }
}
