<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::with('user', 'images')->paginate(10);
        return view('pages.admin.project.index', compact('project'));
    }
    public function create()
    {
        $users = User::all();
        return view('pages.admin.project.create', compact('users'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|exists:Users,user_id',
                'phuong_name' => 'required|string|not_in:0',
                'quan_name' => 'required|string|not_in:0',
                'tinh_name' => 'required|string|not_in:0',
                'project_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0|max:99999999999999999.99',
                'area' => 'nullable|numeric|min:0',
                'status' => 'required',
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

            $project = Project::create([
                'user_id' => $request->user_id,
                'location' => $location,
                'project_name' => $request->project_name,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'is_verified' => $request->is_verified,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            // Handle multiple image uploads
            if ($files = $request->file('images')) {
                $path = 'uploads/project/';
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0755, true);
                }

                foreach ($files as $file) {
                    $ex = $file->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $ex;
                    $file->move($path, $filename);

                    ProjectImage::create([
                        'project_id' => $project->project_id,
                        'image_url' => $path . $filename,
                    ]);
                }
            }

            // if (auth()->user()->role == 'admin') {
            return redirect()->route('admin.project.create')->with('success', 'Project created successfully.');
            // } else {
            //     return redirect()->route('profile')->with('success', 'Project created successfully.');
            // }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create Project. Please try again.' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $project = Project::with('user', 'images')->findOrFail($id);

        $users = User::all();

        return view('pages.admin.project.edit', compact('project', 'users'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required|exists:Users,user_id',
                'phuong_name' => 'required|string|not_in:0',
                'quan_name' => 'required|string|not_in:0',
                'tinh_name' => 'required|string|not_in:0',
                'project_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric|min:0|max:99999999999999999.99',
                'area' => 'nullable|numeric|min:0',
                'is_verified' => 'required|boolean',
                'status' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
                'images' => 'nullable|array',
                'delete_images' => 'nullable|array',
                'delete_images.*' => 'exists:project_images,image_id',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Tạo chuỗi location từ tỉnh, quận, phường
            $location = $request->tinh_name . ', ' . $request->quan_name . ', ' . $request->phuong_name;

            // Update property with validated data
            $project->update([
                'user_id' => $request->user_id,
                'location' => $location,
                'project_name' => $request->project_name,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'status' => $request->status,
                'is_verified' => $request->is_verified,
                'updated_at' => now(),
            ]);

            // Handle image deletions
            if ($request->has('delete_images')) {
                foreach ($request->delete_images as $imageId) {
                    $image = ProjectImage::find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image_url);
                        $image->delete();
                    }
                }
            }

            // Kiểm tra tổng số hình ảnh sau khi xóa
            $remainingImages = $project->images()->count();
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
                    $path = $file->storeAs('uploads/project', $filename, 'public');

                    ProjectImage::create([
                        'project_id' => $project->project_id,
                        'image_url' => $path,
                    ]);
                }
            }

            return redirect()->route('admin.project.edit', $project->project_id)
                ->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update project: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            foreach ($project->images as $image) {
                Storage::disk('public')->delete($image->image_url);
                $image->delete();
            }
            $project->delete();
            return redirect()->route('admin.project.index')->with('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.project.index')->with('error', 'Failed to delete project. Please try again.');
        }
    }

    // Banner
    public function createBanner()
    {
        return view('pages.admin.banner_project_page.create');
    }

    public function storeBanner(Request $request)
    {
        $request->validate([
            'title' => 'required|string|not_in:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'phuong_name' => 'required|string|not_in:0',
            'quan_name' => 'required|string|not_in:0',
            'tinh_name' => 'required|string|not_in:0',
        ]);

        $path = 'uploads/banner/';
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0755, true);
        }

        $file = $request->file('image');
        $ex = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $ex;
        $file->move(public_path($path), $filename);

        $location = $request->tinh_name . ', ' . $request->quan_name . ', ' . $request->phuong_name;

        Banner::create([
            'title' => $request->title,
            'image' => $path . $filename,
            'location' => $location
        ]);

        return redirect()->route('admin.project.indexBanner')
            ->with('success', 'Tạo banner thành công.');
    }

    public function indexBanner()
    {
        $allBanner = Banner::all();
        return view('pages.admin.banner_project_page.index', compact('allBanner'));
    }

    public function editBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('pages.admin.banner_project_page.edit', compact('banner'));
    }
    public function updateBanner(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|not_in:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'phuong_name' => 'required|string|not_in:0',
            'quan_name' => 'required|string|not_in:0',
            'tinh_name' => 'required|string|not_in:0',
        ]);

        $banner = Banner::findOrFail($id);

        $path = 'uploads/banner/';
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0755, true);
        }

        $location = $request->tinh_name . ', ' . $request->quan_name . ', ' . $request->phuong_name;
        $data = [
            'title' => $request->title,
            'location' => $location
        ];

        if ($file = $request->file('image')) {
            // Xóa ảnh cũ nếu có
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
            $data['image'] = $path . $filename;
        }

        $banner->update($data);

        return redirect()->route('admin.project.indexBanner')
            ->with('success', 'Cập nhật banner thành công.');
    }

    public function destroyBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.project.indexBanner')->with('success', 'Xóa banner thành công!');
    }
}
