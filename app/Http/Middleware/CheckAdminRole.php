<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Nếu không đăng nhập hoặc không có role_id = 1
        if (!$user || !$user->roles()->where('roles.role_id', 1)->exists()) {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        return $next($request);
    }
}
