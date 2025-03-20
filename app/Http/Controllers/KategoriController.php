<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoris = Kategori::all(); // Mengambil semua data kategori
        return view('admin.kategori.index', compact('kategoris')); // Mengirim data ke view
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        // Ambil kode terakhir
        $lastCategory = Kategori::latest('id')->first();

        return view('admin.kategori.create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = Kategori::create([
            'name' => $request->name,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dibuat');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id); // Menemukan kategori berdasarkan ID
        return view('admin.kategori.edit', compact('kategori')); // Mengirim data kategori ke form edit
    }

    // Memperbarui data kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id); // Menemukan kategori berdasarkan ID
        $kategori->update([
            'name' => $request->name,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
