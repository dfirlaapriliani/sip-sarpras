@extends('layout_admin.admin')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')
<div class="p-4 sm:p-6">
    <div class="mb-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg sm:text-xl font-semibold text-gray-800">Edit Data Barang</h1>
                    <p class="text-gray-500 text-sm">{{ $barang->nama_barang }}</p>
                </div>
            </div>
            <a href="{{ route('admin.barang.index') }}"
               class="hidden sm:inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('admin.barang.update', $barang) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- LEFT COLUMN -->
                    <div class="space-y-4">

                        <!-- Foto -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Barang</label>
                            <div id="imagePreviewContainer" class="mb-3">
                                <div id="imagePreview">
                                    @if($barang->foto)
                                        <div class="relative inline-block">
                                            <img id="previewImg" src="{{ asset('storage/' . $barang->foto) }}" alt="Current" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                                            <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            </button>
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">Foto saat ini</p>
                                    @else
                                        <div class="w-32 h-32 rounded-lg bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">Belum ada foto</p>
                                    @endif
                                </div>
                            </div>
                            <input type="file" class="hidden" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                            <label for="foto" class="flex items-center justify-center gap-2 w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-blue-50 text-gray-600 hover:text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span class="text-sm font-medium">Ganti Foto</span>
                            </label>
                            @error('foto')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Nama Barang -->
                        <div>
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-2">Nama Barang <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_barang" name="nama_barang"
                                   value="{{ old('nama_barang', $barang->nama_barang) }}"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('nama_barang') border-red-500 @enderror"
                                   required>
                            @error('nama_barang')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Stok <span class="text-red-500">*</span></label>
                            <input type="number" id="stok" name="stok"
                                   value="{{ old('stok', $barang->stok) }}" min="0"
                                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('stok') border-red-500 @enderror"
                                   required>
                            @error('stok')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Kondisi -->
                        <div>
                            <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-2">Kondisi Barang <span class="text-red-500">*</span></label>
                            <select id="kondisi" name="kondisi"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kondisi') border-red-500 @enderror"
                                    required>
                                <option value="">-- Pilih Kondisi --</option>
                                <option value="baik" {{ old('kondisi', $barang->kondisi) == 'baik' ? 'selected' : '' }}>✓ Baik</option>
                                <option value="rusak ringan" {{ old('kondisi', $barang->kondisi) == 'rusak ringan' ? 'selected' : '' }}>⚠ Rusak Ringan</option>
                                <option value="rusak berat" {{ old('kondisi', $barang->kondisi) == 'rusak berat' ? 'selected' : '' }}>✕ Rusak Berat</option>
                            </select>
                            @error('kondisi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                    </div>

                    <!-- RIGHT COLUMN -->
                    <div class="space-y-4">

                        <!-- ★ KATEGORI ★ -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Kategori
                                </div>
                            </label>
                            <select id="category_id" name="category_id"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                                <option value="">-- Tanpa Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $barang->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Ketersediaan <span class="text-red-500">*</span></label>
                            <select id="status" name="status"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                                    required>
                                <option value="">-- Pilih Status --</option>
                                <option value="tersedia" {{ old('status', $barang->status) == 'tersedia' ? 'selected' : '' }}>✓ Tersedia</option>
                                <option value="tidak tersedia" {{ old('status', $barang->status) == 'tidak tersedia' ? 'selected' : '' }}>✕ Tidak Tersedia</option>
                            </select>
                            @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Minimal Peminjaman -->
                        <div>
                            <label for="minimal_peminjaman" class="block text-sm font-medium text-gray-700 mb-2">Minimal Peminjaman <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" id="minimal_peminjaman" name="minimal_peminjaman"
                                       value="{{ old('minimal_peminjaman', $barang->minimal_peminjaman) }}" min="1"
                                       class="w-full px-4 pr-16 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('minimal_peminjaman') border-red-500 @enderror"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">Hari</span>
                                </div>
                            </div>
                            @error('minimal_peminjaman')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Barang</label>
                            <textarea id="deskripsi" name="deskripsi" rows="6"
                                      placeholder="Masukkan deskripsi barang (opsional)"
                                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 resize-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                            @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-lg">
                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                    <a href="{{ route('admin.barang.index') }}"
                       class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm font-medium">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 rounded-lg text-white hover:bg-blue-700 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Update Barang
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('imagePreview').innerHTML = `
                <div class="relative inline-block">
                    <img src="${e.target.result}" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                    <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <p class="mt-2 text-xs text-gray-500">Preview foto baru</p>
            `;
        };
        reader.readAsDataURL(file);
    }
}
function removeImage() {
    document.getElementById('foto').value = '';
    @if($barang->foto)
        document.getElementById('imagePreview').innerHTML = `
            <div class="relative inline-block">
                <img src="{{ asset('storage/' . $barang->foto) }}" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
            </div>
            <p class="mt-2 text-xs text-gray-500">Foto saat ini</p>
        `;
    @else
        document.getElementById('imagePreview').innerHTML = `<p class="text-xs text-gray-400">Belum ada foto</p>`;
    @endif
}
</script>
@endsection