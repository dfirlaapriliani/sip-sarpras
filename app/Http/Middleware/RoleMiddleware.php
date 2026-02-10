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
            abort(403, 'Anda tidak memiliki akses.');
        }

        // Mapping nama role ke prefix kode
        $roleMap = [
            'admin' => 'ADM',
            'petugas' => 'PTG',
            'peminjam' => 'PMJ',
        ];

        // Kalau input sudah berupa kode (ADM, PTG, PMJ), langsung pakai
        // Kalau input berupa nama (admin, petugas, peminjam), convert dulu
        $prefix = $roleMap[strtolower($role)] ?? strtoupper($role);

        if (!str_starts_with($user->role->kode_role, $prefix)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}