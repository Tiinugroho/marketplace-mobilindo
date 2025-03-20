<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiController extends Controller
{
    public function index()
    {
        $query = Booking::with('seller', 'buyer', 'produk')->where('booking_status', 'completed')->where('payment_status', 'paid')->where('type_payment', 'lunas');

        // Jika user adalah seller, filter berdasarkan produk yang dimilikinya
        if (auth()->user()->role == 'seller') {
            $query->whereHas('produk', function ($q) {
                $q->where('seller_id', auth()->id());
            });
        }

        $bookings = $query->get();

        return view('admin.mutasi.index', compact('bookings'));
    }

    public function exportPDF(Request $request)
    {
        $query = Booking::whereBetween('date', [$request->start_date, $request->end_date])
            ->where('booking_status', 'completed')
            ->where('payment_status', 'paid')
            ->where('type_payment', 'lunas');

        // Jika user adalah seller, filter berdasarkan produk yang dimilikinya
        if (auth()->user()->role == 'seller') {
            $query->whereHas('produk', function ($q) {
                $q->where('seller_id', auth()->id());
            });
        }

        $bookings = $query->get();

        $pdf = Pdf::loadView('admin.mutasi.pdf', compact('bookings'));
        return $pdf->download('mutasi.pdf');
    }
}
