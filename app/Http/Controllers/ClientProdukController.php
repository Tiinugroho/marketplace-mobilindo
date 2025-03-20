<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Booking;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $search = $request->query('search');
        $kategori_id = $request->query('kategori');

        $produks = Produk::with('kategori')
            ->when($search, function ($query) use ($search) {
                return $query->where('brand', 'like', "%$search%")->orWhere('model', 'like', "%$search%");
            })
            ->when($kategori_id, function ($query) use ($kategori_id) {
                return $query->where('category_id', $kategori_id);
            })
            ->paginate(9);

        return view('detail', compact('produks', 'kategoris', 'search', 'kategori_id'));
    }

    public function show($id)
    {
        $produk = Produk::with(['seller', 'kategori'])->findOrFail($id);
        return view('detail', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        Booking::create([
            'code_transaction' => 'TRX-' . Str::upper(Str::random(10)),
            'produk_id' => $produk->id,
            'user_id' => Auth::id(),
            'total_price' => null,
            'date' => now(),
            'payment_proof' => null,
            'booking_status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan.');
    }
}
