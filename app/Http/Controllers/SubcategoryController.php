<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('admin.pages.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('subcategories', 'public');
            $request->merge(['image' => $imagePath]);
        }

        Subcategory::create($request->all());
        return redirect()->route('subcategories.index')->with('success', 'Thêm danh mục con thành công.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('admin.pages.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu cần
            if ($subcategory->image) {
                Storage::disk('public')->delete($subcategory->image); // Sửa 'Storeage' thành 'Storage'
            }
            $imagePath = $request->file('image')->store('subcategories', 'public');
            $request->merge(['image' => $imagePath]);
        }

        $subcategory->update($request->all());
        return redirect()->route('subcategories.index')->with('success', 'Cập nhật danh mục con thành công.');
    }

    public function destroy(Subcategory $subcategory)
    {
        // Xóa hình ảnh nếu có
        if ($subcategory->image) {
            Storage::disk('public')->delete($subcategory->image);
        }

        if ($subcategory->products()->count() > 0) {
            return redirect()->back()->with('error', 'Không thể xóa danh mục này vì vẫn còn sản phẩm tồn tại.');
        }

        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Xóa danh mục con thành công.');
    }
}


