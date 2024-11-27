<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UseradminController extends Controller
{
    public function index()
    {
        // Lấy danh sách người dùng
        $users = User::all();
        return view('admin.pages.users.index', compact('users'));
    }

    public function edit($id)
    {
        // Hiển thị form chỉnh sửa người dùng
    }

    public function update(Request $request, $id)
    {
        // Xác thực và cập nhật thông tin người dùng
    }

    public function destroy($id)
    {
        // Xóa người dùng
    }
}
