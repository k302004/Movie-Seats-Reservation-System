<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        \Log::info('CheckRole middleware', [
            'user_id' => $user?->id,
            'email' => $user?->email,
            'role' => $user?->role,
            'isAdmin' => $user?->isAdmin(),
            'role_param' => $role
        ]);
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }
        
        if ($role === 'admin' && !$user->isAdmin()) {
            return redirect()->route('movies.index')->with('error', 'Access denied. Admin only.');
        }
        
        return $next($request);
    }
}
