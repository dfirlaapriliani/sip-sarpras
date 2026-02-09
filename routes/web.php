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

// Dashboard user umum
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ================= ADMIN =================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
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
Route::middleware(['auth', 'role.code:PTG001'])->group(function () {
    Route::get('/petugas', [PetugasDashboardController::class, 'index'])
        ->name('petugas.dashboard');
});

// ================= PEMINJAM =================
Route::middleware(['auth', 'role.code:PMJ'])->group(function () {
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
