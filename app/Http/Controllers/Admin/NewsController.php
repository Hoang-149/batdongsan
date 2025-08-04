<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('pages.admin.news.index', compact('news'));
    }

    // Form tạo mới
    public function create()
    {
        return view('pages.admin.news.create');
    }

    // Lưu bài viết mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|max:100',
            'is_verified' => 'required|boolean',
        ]);

        $data = $request->only(['title', 'content', 'author', 'is_verified']);

        if ($file = $request->file('thumbnail')) {
            $path = 'uploads/news/';
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
            $data['thumbnail'] = $path . $filename;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Tạo bài viết thành công!');
    }


    // Form chỉnh sửa
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('pages.admin.news.edit', compact('news'));
    }

    // Cập nhật bài viết
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|max:100',
            'is_verified' => 'required|boolean',
        ]);

        $news = News::findOrFail($id);
        $data = $request->only(['title', 'content', 'author', 'is_verified']);

        if ($file = $request->file('thumbnail')) {
            $path = 'uploads/news/';
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }

            // Xóa ảnh cũ nếu có
            if ($news->thumbnail && file_exists(public_path($news->thumbnail))) {
                unlink(public_path($news->thumbnail));
            }

            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
            $data['thumbnail'] = $path . $filename;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    // Xóa bài viết
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Xóa bài viết thành công!');
    }
}
