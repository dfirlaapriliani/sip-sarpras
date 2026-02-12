@extends('layout_peminjam.peminjam')

@section('title', 'Daftar Barang')
@section('page-title', 'Daftar Barang')

@section('content')
    <!-- Header dengan Search -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Katalog Barang</h2>
            <p class="text-xs text-gray-500 mt-1">
                @if(request('search'))
                    Menampilkan hasil untuk "<span class="font-semibold">{{ request('search') }}</span>"
                @else
                    {{ $barangs->total() }} barang tersedia
                @endif
            </p>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('peminjam.barang.index') }}" class="w-full sm:w-auto">
            <div class="flex gap-2">
                <div class="relative flex-grow">
                    <input type="text"
                           name="search"
                           placeholder="Cari barang..."
                           value="{{ request('search') }}"
                           class="w-full sm:w-64 text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-4 py-2.5">
                </div>
                <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition-all">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('peminjam.barang.index') }}"
                       class="px-4 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm font-medium transition-all">
                        ✕
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Grid Barang -->
    @if($barangs->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($barangs as $barang)
            <div class="bg-white rounded-xl border border-gray-200 hover:border-blue-400 hover:shadow-lg transition-all duration-200 overflow-hidden flex flex-col">

                <!-- Image -->
                <div class="relative w-full aspect-square bg-gradient-to-br from-blue-50 to-gray-50">
                    @if($barang->foto)
                    <img src="{{ asset('storage/' . $barang->foto) }}"
                         alt="{{ $barang->nama_barang }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    @endif

                    <!-- Badge Stok -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-block px-2.5 py-1 rounded-lg text-xs font-bold shadow-sm backdrop-blur-sm
                            {{ $barang->stok > 10 ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' :
                               ($barang->stok > 0 ? 'bg-amber-100 text-amber-800 border border-amber-300' :
                                'bg-rose-100 text-rose-800 border border-rose-300') }}">
                            Stok: {{ $barang->stok }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-semibold text-gray-900 text-sm mb-3 line-clamp-2 min-h-[2.5rem]">
                        {{ $barang->nama_barang }}
                    </h3>

                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="bg-gray-50 rounded-lg p-2">
                            <p class="text-[10px] text-gray-500 mb-0.5">Kondisi</p>
                            <p class="text-xs font-semibold text-gray-900">
                                {{ ucfirst($barang->kondisi ?? 'Baik') }}
                            </p>
                        </div>

                        @if($barang->minimal_peminjaman)
                        <div class="bg-blue-50 rounded-lg p-2">
                            <p class="text-[10px] text-blue-600 mb-0.5">Min. Pinjam</p>
                            <p class="text-xs font-bold text-blue-700">
                                {{ $barang->minimal_peminjaman }} Hari
                            </p>
                        </div>
                        @endif
                    </div>

                    <a href="{{ route('peminjam.barang.show', $barang->id) }}"
                       class="mt-auto w-full text-center py-2.5 px-4 border border-blue-600 text-blue-700 rounded-lg hover:bg-blue-600 hover:text-white text-xs font-semibold transition-all duration-200">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $barangs->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>

            @if(request('search'))
                <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Ditemukan</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Pencarian "<span class="font-semibold">{{ request('search') }}</span>" tidak menemukan hasil
                </p>
                <a href="{{ route('peminjam.barang.index') }}"
                   class="inline-block px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition-all">
                    Lihat Semua Barang
                </a>
            @else
                <h3 class="text-lg font-bold text-gray-900 mb-2">Barang Tidak Tersedia</h3>
                <p class="text-sm text-gray-600">Saat ini belum ada barang yang dapat dipinjam</p>
            @endif
        </div>
    @endif
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .aspect-square {
        aspect-ratio: 1 / 1;
    }
</style>
@endpush