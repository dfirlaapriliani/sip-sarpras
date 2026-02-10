<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Peminjam\PeminjamController;
use App\Http\Controllers\Admin\RoleManagementController;

// Welcome
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if (!$user || !$user->role || !$user->role->kode_role) {
        Auth::logout();
        return redirect('/login')->withErrors(['role' => 'Akun Anda belum memiliki role yang valid. Silakan hubungi admin.']);
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

    Auth::logout();
    return redirect('/login')->withErrors(['role' => 'Role Anda tidak dikenali. Silakan hubungi admin.']);
})->middleware(['auth', 'verified'])->name('dashboard');

// ================= ADMIN =================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
});

// ================= ADMIN =================
Route::middleware(['auth', 'role:ADM'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
            
        Route::get('/rolemanagement', [RoleManagementController::class, 'index'])
            ->name('rolemanagement.index');
        Route::get('/rolemanagement/{id}', [RoleManagementController::class, 'show'])
            ->name('rolemanagement.show');
        Route::put('/rolemanagement/{id}', [RoleManagementController::class, 'updateRole'])
            ->name('rolemanagement.update');
        Route::delete('/rolemanagement/{id}', [RoleManagementController::class, 'destroy'])
            ->name('rolemanagement.destroy');
});

// ================= PETUGAS =================
Route::middleware(['auth', 'role:PTG'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');
});

// ================= PEMINJAM =================
Route::middleware(['auth', 'role:PMJ'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {
        Route::get('/dashboard', [PeminjamController::class, 'index'])
            ->name('dashboard');
});

// ================= PETUGAS =================
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas', [PetugasDashboardController::class, 'index'])
        ->name('petugas.dashboard');
});

// ================= PEMINJAM =================
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/peminjam', [PeminjamController::class, 'index'])
        ->name('peminjam.dashboard');
});

// ================= PROFILE =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= LOGOUT =================
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

// ================= DEBUG ROLE =================
Route::get('/debug-role', function () {
    return auth()->check() 
        ? auth()->user()->role 
        : 'BELUM LOGIN BRO 💀';
});

Route::get('/cek-role', function () {
    dd(auth()->user()->role);
});

require __DIR__.'/auth.php';
