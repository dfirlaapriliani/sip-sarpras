<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Dashboard Peminjam</h1>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                Logout
            </button>
        </form>
    </div>

    <p class="text-gray-600 mb-4">
        Halo peminjam~ siap minjem barang dengan tanggung jawab? 😌📦
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded p-4">
            <h2 class="font-semibold">Barang Dipinjam</h2>
            <p class="text-3xl font-bold text-blue-500">0</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="font-semibold">Riwayat Peminjaman</h2>
            <p class="text-3xl font-bold text-green-500">0</p>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="font-semibold">Status Akun</h2>
            <p class="text-xl font-semibold text-purple-500">Aktif ✅</p>
        </div>
    </div>
</div>
