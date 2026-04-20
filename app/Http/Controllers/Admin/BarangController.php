<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::with('category')->latest();

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $barangs    = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.barang.index', compact('barangs', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.barang.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'        => 'nullable|exists:categories,id',
            'foto'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_barang'        => 'required|string|max:255',
            'stok'               => 'required|integer|min:0',
            'kondisi'            => 'required|in:baik,rusak ringan,rusak berat',
            'status'             => 'required|in:tersedia,tidak tersedia',
            'minimal_peminjaman' => 'required|integer|min:1',
            'deskripsi'          => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('barang', 'public');
        }

        Barang::create($validated);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Data barang berhasil ditambahkan!');
    }

    public function show(Barang $barang)
    {
        $barang->load('category');
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.barang.edit', compact('barang', 'categories'));
    }

    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'category_id'        => 'nullable|exists:categories,id',
            'foto'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_barang'        => 'required|string|max:255',
            'stok'               => 'required|integer|min:0',
            'kondisi'            => 'required|in:baik,rusak ringan,rusak berat',
            'status'             => 'required|in:tersedia,tidak tersedia',
            'minimal_peminjaman' => 'required|integer|min:1',
            'deskripsi'          => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            $validated['foto'] = $request->file('foto')->store('barang', 'public');
        }

        $barang->update($validated);

        return redirect()->route('admin.barang.index')
            ->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }
        $barang->delete();

        return redirect()->route('admin.barang.index')
            ->with('success', 'Data barang berhasil dihapus!');
    }
}