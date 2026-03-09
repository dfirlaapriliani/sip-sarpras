<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Peminjam\PeminjamController;
use App\Http\Controllers\Peminjam\BarangController as PeminjamBarangController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;
use App\Http\Controllers\Peminjam\NotifikasiController;
use App\Http\Controllers\Petugas\BarangController as PetugasBarangController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Admin\RoleManagementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BarangController as AdminBarangController;

// ================= WELCOME =================
Route::get('/', function () {
    return view('welcome');
});

// ================= DASHBOARD REDIRECT =================
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

// ================= ADMIN ROUTES =================
Route::middleware(['auth', 'role:ADM'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/rolemanagement', [RoleManagementController::class, 'index'])->name('rolemanagement.index');
        Route::get('/rolemanagement/{id}', [RoleManagementController::class, 'show'])->name('rolemanagement.show');
        Route::put('/rolemanagement/{id}', [RoleManagementController::class, 'updateRole'])->name('rolemanagement.update');
        Route::delete('/rolemanagement/{id}', [RoleManagementController::class, 'destroy'])->name('rolemanagement.destroy');

        Route::resource('categories', CategoryController::class);
        Route::resource('barang', AdminBarangController::class);
    });

// ================= PETUGAS ROUTES =================
Route::middleware(['auth', 'role:PTG'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');

        // Barang
        Route::get('/barang', [PetugasBarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/{id}', [PetugasBarangController::class, 'show'])->name('barang.show');

        // Peminjaman
        Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/{id}', [PetugasPeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::post('/peminjaman/{id}/approve', [PetugasPeminjamanController::class, 'approve'])->name('peminjaman.approve');
        Route::post('/peminjaman/{id}/reject', [PetugasPeminjamanController::class, 'reject'])->name('peminjaman.reject');
        Route::post('/peminjaman/{id}/pickup', [PetugasPeminjamanController::class, 'confirmPickup'])->name('peminjaman.pickup');
        Route::post('/peminjaman/{id}/return', [PetugasPeminjamanController::class, 'confirmReturn'])->name('peminjaman.return');
    });

// ================= PEMINJAM ROUTES =================
Route::middleware(['auth', 'role:PMJ'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {
        Route::get('/dashboard', [PeminjamController::class, 'index'])->name('dashboard');

        // Barang + Cart
        Route::get('/barang', [PeminjamBarangController::class, 'index'])->name('barang.index');
        Route::get('/barang/{id}', [PeminjamBarangController::class, 'show'])->name('barang.show');
        Route::post('/cart/add', [PeminjamBarangController::class, 'cartAdd'])->name('cart.add');
        Route::delete('/cart/{id}', [PeminjamBarangController::class, 'cartRemove'])->name('cart.remove');
        Route::delete('/cart', [PeminjamBarangController::class, 'cartClear'])->name('cart.clear');

        // Peminjaman — /create HARUS sebelum /{id} supaya tidak bentrok
        Route::get('/peminjaman', [PeminjamPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/create', [PeminjamPeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamPeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::get('/peminjaman/{id}', [PeminjamPeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::patch('/peminjaman/{id}/cancel', [PeminjamPeminjamanController::class, 'cancel'])->name('peminjaman.cancel');

        // Notifikasi
        Route::get('/notifikasi/{id}/baca', [NotifikasiController::class, 'baca'])->name('notifikasi.baca');
        Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('notifikasi.baca-semua');
    });

// ================= PROFILE ROUTES =================
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

// ================= DEBUG ROUTES (Hapus di production) =================
Route::get('/debug-role', function () {
    return auth()->check() ? auth()->user()->role : 'BELUM LOGIN BRO 💀';
});

Route::get('/cek-role', function () {
    dd(auth()->user()->role);
});

require __DIR__.'/auth.php';