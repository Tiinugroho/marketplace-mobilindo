<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Produk;
use App\Models\Booking;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hitung total staff (role = seller)
        $totalStaff = User::where('role', 'seller')->count();

        // Hitung total client (role = client)
        $totalClient = User::where('role', 'client')->count();

        // Jika admin, total pendapatan semua seller
        if ($user->role == 'admin') {
            $totalPendapatan = Booking::where('payment_status', 'paid')->where('type_payment', 'lunas')->sum('total_price');
        }
        // Jika seller, total pendapatan hanya dari produk yang dia miliki
        elseif ($user->role == 'seller') {
            $totalPendapatan = Booking::where('payment_status', 'paid')
                ->where('type_payment', 'lunas')
                ->whereHas('produk', function ($query) use ($user) {
                    $query->where('seller_id', $user->id);
                })
                ->sum('total_price');
        } else {
            $totalPendapatan = 0;
        }

        // Ambil pendapatan per bulan selama satu tahun terakhir
        $pendapatanBulanan = Booking::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(total_price) as total'))
            ->whereYear('created_at', Carbon::now()->year)
            ->where('payment_status', 'paid')
            ->groupBy('bulan')
            ->orderBy('bulan', 'ASC');

        // Jika seller, filter berdasarkan seller_id
        if ($user->role == 'seller') {
            $pendapatanBulanan->whereHas('produk', function ($query) use ($user) {
                $query->where('seller_id', $user->id);
            });
        }

        $pendapatanBulanan = $pendapatanBulanan->get();

        // Format agar semua bulan ada, jika tidak ada transaksi set 0
        $pendapatanData = array_fill(1, 12, 0);
        foreach ($pendapatanBulanan as $data) {
            $pendapatanData[$data->bulan] = $data->total;
        }

        // Total produk berdasarkan peran
        if ($user->role == 'admin') {
            $totalProduk = Produk::count(); // Semua produk
        } elseif ($user->role == 'seller') {
            $totalProduk = Produk::where('seller_id', $user->id)->count(); // Produk milik seller
        } else {
            $totalProduk = 0;
        }

        return view('admin.dashboard', compact('totalStaff', 'totalClient', 'totalPendapatan', 'pendapatanData','totalProduk'));
    }
}
