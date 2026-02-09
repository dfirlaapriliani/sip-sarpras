<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.dashboard');
        }

        if ($user->isPetugas()) {
            return view('dashboard.petugas');
        }

        if ($user->isPeminjam()) {
            return view('dashboard.peminjam');
        }

        abort(403, 'Access denied');
    }
}
