<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            if ($role === 'admin') {
                return redirect()->route('movies.index')->with('error', 'Access denied. Admin only.');
            }
        }
        return $next($request);
    }
}
