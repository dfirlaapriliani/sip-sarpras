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

    {{-- ERROR VALIDASI --}}
    @if($errors->any())
    <div class="mb-5 px-4 py-3 bg-red-50 border border-red-300 rounded-xl text-sm text-red-700">
        <p class="font-bold mb-2 flex items-center gap-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            Peminjaman tidak dapat diajukan:
        </p>
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form hapus barang — DI LUAR form utama --}}
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

        <!-- ══ BATAS HARI INFO BANNER ══ -->
        @if($maxHariGlobal !== null)
        <div class="flex items-start gap-3 px-4 py-3 bg-amber-50 border border-amber-300 rounded-xl text-sm text-amber-800">
            <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-bold">Perhatian batas maksimal peminjaman!</p>
                <p class="mt-0.5">Durasi pinjam maksimal untuk semua barang di bawah ini adalah <strong>{{ $maxHariGlobal }} hari</strong>. Pastikan tanggal kembali tidak melebihi batas tersebut.</p>
            </div>
        </div>
        @endif

        <!-- DAFTAR BARANG DIPILIH -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-bold text-gray-900">Barang yang Dipinjam</h2>
                <span class="text-sm text-gray-500">{{ count($cart) }} barang</span>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($cart as $item)
                @php
                    $barang      = $barangData->get($item['barang_id']);
                    $maxHari     = $barang?->minimal_peminjaman;
                    $isKetat     = $maxHari !== null && $maxHariGlobal !== null && $maxHari === $maxHariGlobal && $maxHariGlobal < 99;
                @endphp
                <div class="flex items-center gap-4 px-6 py-4 {{ $isKetat ? 'bg-amber-50/50' : '' }}">
                    <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                        @if($item['foto'])
                            <img src="{{ asset('storage/' . $item['foto']) }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('img/default.png') }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 text-sm">{{ $item['nama_barang'] }}</p>
                        <div class="flex flex-wrap items-center gap-2 mt-1">
                            <span class="text-xs text-gray-400">Stok: {{ $item['stok'] }}</span>
                            @if($maxHari)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2 py-0.5 rounded-full
                                    {{ $maxHari <= 1 ? 'bg-red-100 text-red-700' : ($maxHari <= 3 ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700') }}">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Maks. {{ $maxHari }} hari
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="text-xs text-gray-500">Jumlah:</span>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-bold rounded-lg">
                            {{ $item['jumlah'] }}
                        </span>
                    </div>
                    <button type="button"
                            onclick="removeItem({{ $item['barang_id'] }})"
                            class="text-gray-300 hover:text-red-500 transition flex-shrink-0" title="Hapus">
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
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                               value="{{ old('tanggal_pinjam') }}"
                               min="{{ date('Y-m-d') }}"
                               required
                               onchange="updateMaxKembali()"
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm px-4 py-2.5 @error('tanggal_pinjam') border-red-400 @enderror">
                        @error('tanggal_pinjam')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                            Tanggal Kembali <span class="text-red-500">*</span>
                            @if($maxHariGlobal)
                                <span class="text-amber-600 font-bold">(maks. {{ $maxHariGlobal }} hari)</span>
                            @endif
                        </label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                               value="{{ old('tanggal_kembali') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               required
                               onchange="checkDurasi()"
                               class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm px-4 py-2.5 @error('tanggal_kembali') border-red-400 @enderror">
                        @error('tanggal_kembali')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <!-- Durasi hint -->
                        <p id="durasi-hint" class="mt-1 text-xs text-gray-400 hidden"></p>
                        <p id="durasi-warn" class="mt-1 text-xs text-red-600 font-semibold hidden">
                            ⚠ Melebihi batas maksimal! Silakan pilih tanggal lebih awal.
                        </p>
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
            <button type="submit" id="btn-submit"
                    class="flex-1 py-3 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 transition shadow-[0_6px_18px_rgba(37,99,235,0.35)]">
                Ajukan Peminjaman →
            </button>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
const maxHariGlobal = {{ $maxHariGlobal ?? 'null' }};

function removeItem(barangId) {
    if (confirm('Hapus barang dari daftar?')) {
        document.getElementById('remove-form-' + barangId).submit();
    }
}

function updateMaxKembali() {
    const pinjam  = document.getElementById('tanggal_pinjam').value;
    const kembali = document.getElementById('tanggal_kembali');
    if (!pinjam) return;

    // Set min tanggal kembali = tanggal pinjam + 1 hari
    const minKembali = new Date(pinjam);
    minKembali.setDate(minKembali.getDate() + 1);
    kembali.min = minKembali.toISOString().split('T')[0];

    // Set max tanggal kembali berdasarkan batas barang paling ketat
    if (maxHariGlobal) {
        const maxKembali = new Date(pinjam);
        maxKembali.setDate(maxKembali.getDate() + maxHariGlobal);
        kembali.max = maxKembali.toISOString().split('T')[0];
    }

    checkDurasi();
}

function checkDurasi() {
    const pinjam   = document.getElementById('tanggal_pinjam').value;
    const kembali  = document.getElementById('tanggal_kembali').value;
    const hint     = document.getElementById('durasi-hint');
    const warn     = document.getElementById('durasi-warn');
    const btnSubmit = document.getElementById('btn-submit');

    if (!pinjam || !kembali) return;

    const diffMs   = new Date(kembali) - new Date(pinjam);
    const diffHari = Math.round(diffMs / (1000 * 60 * 60 * 24));

    hint.textContent = 'Durasi: ' + diffHari + ' hari';
    hint.classList.remove('hidden');

    if (maxHariGlobal && diffHari > maxHariGlobal) {
        warn.classList.remove('hidden');
        hint.classList.add('text-red-500');
        hint.classList.remove('text-gray-400');
        btnSubmit.disabled = true;
        btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        warn.classList.add('hidden');
        hint.classList.remove('text-red-500');
        hint.classList.add('text-gray-400');
        btnSubmit.disabled = false;
        btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}

// Jalankan saat halaman load (jika ada old value)
document.addEventListener('DOMContentLoaded', function () {
    updateMaxKembali();
});
</script>
@endpush