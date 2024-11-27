<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Redirect về trang chính kèm thông báo lỗi nếu không phải Admin
        return redirect('/')->withErrors(['access_denied' => 'Bạn không có quyền truy cập trang này.']);
    }
}


