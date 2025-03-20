<?php

namespace App\Http\Controllers;

use App\Models\s;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Auth::user()->role == 'admin'
            ? Produk::with('kategori', 'seller')->get()
            : Produk::where('seller_id', Auth::id())->with('kategori', 'seller')->get();

        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        if (Auth::user()->role != 'seller') {
            return redirect()->route('produk.index')->with('error', 'Hanya seller yang dapat menambahkan produk.');
        }

        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'seller') {
            return redirect()->route('produk.index')->with('error', 'Hanya seller yang dapat menambahkan produk.');
        }

        $request->validate([
            'category_id' => 'required|exists:kategori,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk = new Produk([
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            $produk->image = $request->file('image')->store('produk', 'public');
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        if (Auth::user()->role != 'seller' || $produk->seller_id != Auth::id()) {
            return redirect()->route('produk.index')->with('error', 'Anda tidak memiliki izin untuk mengedit produk ini.');
        }

        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        if (Auth::user()->role != 'seller' || $produk->seller_id != Auth::id()) {
            return redirect()->route('produk.index')->with('error', 'Anda tidak memiliki izin untuk mengedit produk ini.');
        }

        $request->validate([
            'category_id' => 'required|exists:kategoris,id',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:available,sold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produk->update([
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        if ($request->hasFile('image')) {
            if ($produk->image) {
                Storage::disk('public')->delete($produk->image);
            }
            $produk->image = $request->file('image')->store('produk', 'public');
            $produk->save();
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if (Auth::user()->role != 'seller' || $produk->seller_id != Auth::id()) {
            return redirect()->route('produk.index')->with('error', 'Anda tidak memiliki izin untuk menghapus produk ini.');
        }

        if ($produk->image) {
            Storage::disk('public')->delete($produk->image);
        }

        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
