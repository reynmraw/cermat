<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            abort(404); // Redirect to a 404 page
        }
    
        if (Auth::user()->role !== $role) {
            abort(403); // Return a 403 Unauthorized response
        }
    
        return $next($request);
    }
}
