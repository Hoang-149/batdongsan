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
        $properties = Property::with(['user', 'propertyType', 'location', 'project', 'images'])
            ->orderByRaw('vip_expires_at IS NOT NULL DESC')
            ->orderBy('vip_expires_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $users = User::all();
        $propertyTypes = PropertyType::all();
        $locations = Location::all();
        $projects = Project::all();
        return view('pages.admin.properties.create', compact('users', 'propertyTypes', 'locations', 'projects'));
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
                'type_id' => 'required|exists:PropertyTypes,type_id',
                'location_id' => 'required|exists:Locations,location_id',
                'project_id' => 'nullable|exists:Projects,project_id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0|max:99999999999999999.99',
                'area' => 'nullable|numeric|min:0',
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
            $property = Property::create([
                'user_id' => $request->user_id,
                'type_id' => $request->type_id,
                'location_id' => $request->location_id,
                'project_id' => $request->project_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'is_for_sale' => $request->is_for_sale,
                'is_verified' => $request->is_verified,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $imageData = [];

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

            return redirect()->route('admin.properties.create')->with('success', 'Property created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create property. Please try again.' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing a property.
     */
    public function edit($id)
    {
        $property = Property::with('images')->findOrFail($id);
        $users = User::all();
        $propertyTypes = PropertyType::all();
        $locations = Location::all();
        $projects = Project::all();
        return view('pages.admin.properties.edit', compact('property', 'users', 'propertyTypes', 'locations', 'projects'));
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
                'type_id' => 'required|exists:PropertyTypes,type_id',
                'location_id' => 'required|exists:Locations,location_id',
                'project_id' => 'nullable|exists:Projects,project_id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0|max:99999999999999999.99',
                'area' => 'nullable|numeric|min:0',
                'is_for_sale' => 'required|boolean',
                'is_verified' => 'required|boolean',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:10240',
                'delete_images' => 'nullable|array',
                'delete_images.*' => 'exists:property_images,image_id',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Update property with validated data
            $property->update([
                'user_id' => $request->user_id,
                'type_id' => $request->type_id,
                'location_id' => $request->location_id,
                'project_id' => $request->project_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'is_for_sale' => $request->is_for_sale,
                'is_verified' => $request->is_verified,
                'updated_at' => now(),
            ]);

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

            return redirect()->route('admin.properties.edit', $property->property_id)
                ->with('success', 'Property updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update property: ' . $e->getMessage())
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
            return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.properties.index')->with('error', 'Failed to delete property. Please try again.');
        }
    }

    /**
     * Mark a property as VIP.
     */
    public function markAsVip(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $user = auth()->user();

        // Check if user has enough credits
        $subscription = VipSubscription::where('user_id', $user->user_id)
            ->where('credits', '>=', 1)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$subscription) {
            return redirect()->back()->with('error', 'You do not have enough credits or an active VIP subscription.');
        }

        try {
            // Determine VIP duration based on level
            $durationDays = $subscription->level <= 5 ? 3 : 10;
            $property->update([
                'vip_expires_at' => now()->addDays($durationDays),
                'updated_at' => now(),
            ]);

            // Deduct 1 credit
            $subscription->decrement('credits');

            return redirect()->back()->with('success', 'Property marked as VIP successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to mark property as VIP. Please try again.');
        }
    }
}
