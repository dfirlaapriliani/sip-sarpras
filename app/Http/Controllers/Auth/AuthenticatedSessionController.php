<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();

        if (!$user || !$user->role) {
            return redirect('/dashboard');
        }

        $kodeRole = $user->role->kode_role;

        if (str_starts_with($kodeRole, 'ADM')) {
            return redirect()->route('admin.dashboard');
        }

        if (str_starts_with($kodeRole, 'PTG')) {
            return redirect()->route('petugas.dashboard');
        }

        if (str_starts_with($kodeRole, 'PMJ')) {
            return redirect()->route('peminjam.dashboard');
        }

        return redirect('/dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
