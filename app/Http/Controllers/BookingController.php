<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $query = Booking::with('seller', 'buyer', 'produk');

        // Jika user adalah seller, filter berdasarkan produk yang dimilikinya
        if (auth()->user()->role == 'seller') {
            $query->whereHas('produk', function ($q) {
                $q->where('seller_id', auth()->id());
            });
        }

        $bookings = $query->get();

        return view('admin.reservasi.index', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->booking_status = 'completed';
            $booking->save();
            return redirect()->route('reservasi.index')->with('success', 'Reservasi telah dikonfirmasi.');
        }
        return redirect()->route('reservasi.index')->with('error', 'Reservasi tidak ditemukan.');
    }

    public function cancel($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->booking_status = 'canceled';
            $booking->save();
            return redirect()->route('reservasi.index')->with('success', 'Reservasi telah dibatalkan.');
        }
        return redirect()->route('reservasi.index')->with('error', 'Reservasi tidak ditemukan.');
    }

    public function updateTypePayment(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:bookings,id',
            'type_payment' => 'required|string',
        ]);

        $booking = Booking::findOrFail($request->id);
        $booking->type_payment = $request->type_payment;
        $booking->save();

        return response()->json(['message' => 'Tipe pembayaran diperbarui.']);
    }
}
