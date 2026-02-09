<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = auth()->user();

        if (!$user || !$user->role) {
            abort(403);
        }

        // contoh: ADM, PTG, PMJ
        if (!str_starts_with($user->role->kode_role, strtoupper(substr($role, 0, 3)))) {
            abort(403);
        }

        return $next($request);
    }
}
