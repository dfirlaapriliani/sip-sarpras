<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $requiredRole): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $user = auth()->user();
        
        // Load relasi role kalau belum ter-load
        if (!$user->relationLoaded('role')) {
            $user->load('role');
        }
        
        // Pastikan role adalah object, bukan string
        $roleObject = $user->getRelation('role');
        
        // Ambil kode role
        $userRoleCode = $roleObject?->kode_role ?? null;

        // Cek apakah role user sesuai dengan yang diminta
        if (!$userRoleCode || !str_starts_with($userRoleCode, $requiredRole)) {
            abort(403, 'Role user tidak valid.');
        }

        return $next($request);
    }
}