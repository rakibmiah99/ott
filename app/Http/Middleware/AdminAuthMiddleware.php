<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HelperController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (HelperController::TokenData($request)) {
            return $next($request);
        }

        return \response()->json(['status' => false, 'message' => 'authentication failed'], 401);
    }
}
