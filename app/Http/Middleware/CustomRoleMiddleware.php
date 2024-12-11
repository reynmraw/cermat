<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomRoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        dd('Middleware loaded');
        if (session('role') !== $role) {
            return response('Unauthorized', 403);
        }

        return $next($request);
    }
}
