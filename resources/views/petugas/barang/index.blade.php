@extends('layout_petugas.petugas')

@section('title', 'Kelola Barang')
@section('page-title', 'Kelola Barang')

@section('content')
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Daftar Barang</h2>
            <p class="text-xs text-gray-500 mt-1">{{ $barangs->total() }} total barang</p>
        </div>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('petugas.barang.index') }}" class="flex flex-col sm:flex-row gap-3 mb-6">
        <input type="text"
               name="search"
               placeholder="Cari nama barang..."
               value="{{ request('search') }}"
               class="w-full sm:w-60 text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2">
        <select name="status"
                class="text-sm rounded-lg border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2">
            <option value="">Semua Status</option>
            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
            <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
        </select>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
            Filter
        </button>
        @if(request('search') || request('status'))
            <a href="{{ route('petugas.barang.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm font-medium text-center">
                Reset
            </a>
        @endif
    </form>

    <!-- Tabel -->
    @if($barangs->count() > 0)
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Barang</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wide">Kondisi</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wide">Stok</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wide">Status</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase tracking-wide">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($barangs as $barang)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        @if($barang->foto)
                                            <img src="{{ asset('storage/' . $barang->foto) }}"
                                                 alt="{{ $barang->nama_barang }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $barang->nama_barang }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ ucfirst($barang->kondisi ?? 'Baik') }}</td>
                            <td class="px-4 py-3 text-center">
                                <span class="font-bold {{ $barang->stok > 10 ? 'text-blue-600' : ($barang->stok > 0 ? 'text-orange-500' : 'text-red-600') }}">
                                    {{ $barang->stok }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full
                                    {{ $barang->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $barang->status == 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('petugas.barang.show', $barang->id) }}"
                                   class="px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $barangs->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
            <svg class="mx-auto h-20 w-20 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Barang</h3>
            <p class="text-sm text-gray-600">Tidak ada barang yang ditemukan</p>
        </div>
    @endif
@endsection