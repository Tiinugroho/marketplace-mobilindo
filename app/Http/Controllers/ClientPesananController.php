<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ClientPesananController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Pesanan yang masih pending dan bisa dihapus
        $pendingBookings = Booking::with('seller','produk')->where('user_id', $userId)
            ->where('booking_status', 'pending')
            ->where('payment_status', 'paid')
            ->get();

        // Pesanan yang sudah selesai dan tidak bisa diubah
        $completedBookings = Booking::with('seller','produk')->where('user_id', $userId)
            ->where('booking_status', 'completed')
            ->where('payment_status', 'paid')
            ->get();

        return view('pesanan', compact('pendingBookings', 'completedBookings'));
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($booking->booking_status !== 'pending' || $booking->payment_status !== 'unpaid') {
            return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak bisa dihapus.');
        }

        $booking->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
