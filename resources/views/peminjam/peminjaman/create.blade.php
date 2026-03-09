@extends('layout_peminjam.peminjam')

@section('title', 'Form Peminjaman')
@section('page-title', 'Ajukan Peminjaman')

@section('content')

<div class="max-w-3xl mx-auto">

    <!-- BACK -->
    <a href="{{ route('peminjam.barang.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-blue-600 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Katalog
    </a>

    @if($errors->any())
    <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
        <p class="font-bold mb-1">Ada kesalahan:</p>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- ══════════════════════════════════════════════════════
         FORM HAPUS BARANG — diletakkan DI LUAR form utama
         dipanggil via JavaScript removeItem()
    ══════════════════════════════════════════════════════ --}}
    @foreach($cart as $item)
    <form id="remove-form-{{ $item['barang_id'] }}"
          action="{{ route('peminjam.cart.remove', $item['barang_id']) }}"
          method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endforeach

    {{-- FORM UTAMA --}}
    <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- DAFTAR BARANG DIPILIH -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-bold text-gray-900">Barang yang Dipinjam</h2>
                <span class="text-sm text-gray-500">{{ count($cart) }} barang</span>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($cart as $item)
                <div class="flex items-center gap-4 px-6 py-4">
                    <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($item['foto'])
                            <img src="{{ asset('storage/' . $item['foto']) }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-bold text-gray-900 text-sm">{{ $item['nama_barang'] }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Stok tersedia: {{ $item['stok'] }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500">Jumlah:</span>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-bold rounded-lg">
                            {{ $item['jumlah'] }}
                        </span>
                    </div>
                    {{-- Tombol hapus — submit form terpisah via JS --}}
                    <button type="button"
                            onclick="removeItem({{ $item['barang_id'] }})"
                            class="text-gray-300 hover:text-red-500 transition" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- DETAIL PEMINJAMAN -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="font-bold text-gray-900">Detail Peminjaman</h2>
            </div>
            <div class="px-6 py-5 space-y-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Tanggal Pinjam <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_pinjam"
                               value="{{ old('tanggal_pinjam') }}"
                               min="{{ date('Y-m-d') }}"
                               required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm px-4 py-2.5 @error('tanggal_pinjam') border-red-400 @enderror">
                        @error('tanggal_pinjam')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Tanggal Kembali <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_kembali"
                               value="{{ old('tanggal_kembali') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               required
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm px-4 py-2.5 @error('tanggal_kembali') border-red-400 @enderror">
                        @error('tanggal_kembali')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Keperluan / Alasan Pinjam <span class="text-red-500">*</span>
                    </label>
                    <textarea name="keperluan" rows="3" required
                              placeholder="Contoh: Untuk keperluan praktikum kimia semester 5..."
                              class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm px-4 py-2.5 resize-none @error('keperluan') border-red-400 @enderror">{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                        Catatan Tambahan <span class="text-gray-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="catatan_peminjam" rows="2"
                              placeholder="Catatan lain jika ada..."
                              class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm px-4 py-2.5 resize-none">{{ old('catatan_peminjam') }}</textarea>
                </div>

            </div>
        </div>

        <!-- SUBMIT -->
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('peminjam.barang.index') }}"
               class="flex-1 sm:flex-initial text-center px-6 py-3 rounded-xl border-2 border-gray-300 text-gray-700 font-bold text-sm hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                    class="flex-1 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition shadow-[0_6px_18px_rgba(37,99,235,0.35)]">
                Ajukan Peminjaman →
            </button>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
function removeItem(barangId) {
    if (confirm('Hapus barang dari daftar?')) {
        document.getElementById('remove-form-' + barangId).submit();
    }
}
</script>
@endpush