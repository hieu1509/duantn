<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.pages.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Lấy thông tin đăng nhập
        $credentials = $request->only('email', 'password');

        // Kiểm tra xác thực và phân quyền
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            // Kiểm tra quyền user trước, cho phép cả admin vào giao diện user
            if ($user->role === 'user' || $user->role === 'admin') {
                Session::flash('success', 'Đăng nhập thành công!');
                return redirect()->route('users.index');
            }
        
            // Kiểm tra quyền admin
            if ($user->role === 'admin') {
                Session::flash('success', 'Đăng nhập thành công với quyền admin!');
                return redirect()->intended('admins');
            }
        
            // Đăng xuất và thông báo nếu vai trò không hợp lệ
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Tài khoản không được phân quyền hợp lệ.']);
        }              

        // Trả về lỗi nếu thông tin đăng nhập không hợp lệ
        return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không hợp lệ.']);
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Bạn đã đăng xuất thành công!');
        return redirect()->route('login'); 
    }
}
