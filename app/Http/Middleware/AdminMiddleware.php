<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            if ($request->is('admin/login')) {
                return redirect()->route('admin.dashboard');
            }
            if ($request->is('admin/admins') && auth('admin')->user()->role != 'super_admin') {
                return redirect()->route('admin.dashboard');
            }

            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
