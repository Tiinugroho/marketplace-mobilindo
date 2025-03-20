@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold mb-6">Pesanan Saya</h2>

    <!-- Table 1: Pesanan Pending -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-6">Pesanan Pending</h3>
        <table class="mb-6 w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Kode Transaksi</th>
                    <th class="border p-2">Produk</th>
                    <th class="border p-2">Nama Penjual</th>
                    <th class="border p-2">Total Harga</th>
                    <th class="border p-2">Status Booking</th>
                    <th class="border p-2">Status Pembayaran</th>
                    {{-- <th class="border p-2">Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($pendingBookings as $booking)
                <tr class="text-center">
                    <td class="border p-2">{{ $booking->code_transaction }}</td>
                    <td class="border p-2">{{ $booking->produk->brand }} {{ $booking->produk->model }}</td>
                    <td class="border p-2">{{ $booking->seller->name }}</td>
                    <td class="border p-2">Rp. {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="border p-2 text-yellow-500">{{$booking->booking_status}}</td>
                    <td class="border p-2 text-green-500">{{$booking->payment_status}}</td>
                    {{-- <td class="border p-2">
                        <form action="{{ route('pesanan.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($pendingBookings->isEmpty())
            <p class="text-center text-gray-500 mt-4">Tidak ada pesanan pending.</p>
        @endif
    </div>

    <!-- Table 2: Pesanan Completed -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-6">Pesanan Selesai</h3>
        <table class="mb-6 w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Kode Transaksi</th>
                    <th class="border p-2">Produk</th>
                    <th class="border p-2">Nama Penjual</th>
                    <th class="border p-2">Total Harga</th>
                    <th class="border p-2">Status Booking</th>
                    <th class="border p-2">Status Pembayaran</th>
                    {{-- <th class="border p-2">Aksi</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($completedBookings as $booking)
                <tr class="text-center">
                    <td class="border p-2">{{ $booking->code_transaction }}</td>
                    <td class="border p-2">{{ $booking->produk->brand }} {{ $booking->produk->model }}</td>
                    <td class="border p-2">{{ $booking->produk->seller->name }}</td>
                    <td class="border p-2">Rp. {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="border p-2 text-green-500">{{$booking->booking_status}}</td>
                    <td class="border p-2 text-green-500">{{$booking->payment_status}}</td>
                    {{-- <td class="border p-2 text-gray-500">-</td> <!-- Tidak bisa dihapus --> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($completedBookings->isEmpty())
            <p class="text-center text-gray-500 mt-4">Tidak ada pesanan selesai.</p>
        @endif
    </div>
</div>
@endsection
