<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HelperController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminDashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $s = $request->session();
        $get_session_key = $s->get('get_session_key');
        if($s->has('get_session_key') && HelperController::SessionTokenData($s->get($get_session_key))){
            return $next($request);
        }
        return redirect()->route('admin.login');
    }
}
