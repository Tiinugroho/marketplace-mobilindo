<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientBookingController extends Controller
{
    // Menampilkan daftar booking user
    public function index()
    {
        // Ambil booking terbaru yang dimiliki user
        $booking = Booking::with('produk', 'buyer', 'seller')->where('user_id', Auth::id())->latest()->first();

        if (!$booking) {
            return redirect()->route('home')->with('error', 'Anda belum memiliki booking aktif.');
        }

        return view('booking', compact('booking'));
    }

    public function showPaymentForm($id)
    {
        $booking = Booking::with('produk', 'buyer', 'seller')
            ->where('id', $id)
            ->where('user_id', Auth::id()) // Hanya bisa diakses oleh user yang memesan
            ->firstOrFail();

        return view('booking', compact('booking'));
    }

    public function storePayment(Request $request, $id)
    {
        $request->validate([
            'type_payment' => 'required|in:dp,lunas',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Simpan bukti pembayaran
        $filePath = $request->file('payment_proof')->store('payments', 'public');

        // Hitung jumlah pembayaran berdasarkan pilihan user
        $amountPaid =
            $request->type_payment == 'dp'
                ? $booking->produk->price * 0.05 // DP 5%
                : $booking->produk->price; // Full payment

        // Update booking dengan bukti pembayaran
        $booking->update([
            'total_price'=>$amountPaid,
            'booking_status' => 'pending', // Menunggu konfirmasi admin
            'payment_status' => 'paid', // Menunggu konfirmasi admin
            'type_payment' => $request->type_payment,
            'payment_proof' => $filePath,
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    
}
