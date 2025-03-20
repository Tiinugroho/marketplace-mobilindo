<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Booking;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

        return view('welcome', compact('produks', 'kategoris', 'search', 'kategori_id'));
    }

}
