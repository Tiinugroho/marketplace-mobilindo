@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold mb-4">Detail Booking</h2>

            <form id="payment-form" action="{{ route('booking.payment.store', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Kode -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Kode Transaksi</label>
                    <input type="text" value="{{$booking->code_transaction}}" disabled
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Produk yang dibooking -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Mobil</label>
                    <input type="text" value="{{ $booking->produk->brand }} {{ $booking->produk->model }}" disabled
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                    <input type="hidden" name="produk_id" value="{{ $booking->produk->id }}">
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Harga</label>
                    <input type="text" value="Rp. {{ number_format($booking->produk->price, 0, ',', '.') }}" disabled
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Status Booking -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Status Booking</label>
                    <input type="text" value="{{ ucfirst($booking->booking_status) }}" disabled
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Status Pembayaran -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold">Status Pembayaran</label>
                    <input type="text" value="{{ ucfirst($booking->payment_status) }}" disabled
                        class="w-full px-4 py-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Jika sudah upload bukti pembayaran -->
                @if ($booking->payment_proof)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Bukti Pembayaran</label>
                        <img src="{{ asset('storage/' . $booking->payment_proof) }}" class="w-full h-auto rounded-lg">
                    </div>
                @else
                    <!-- Pilihan Pembayaran -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Pilih Pembayaran</label>
                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center">
                                <input type="radio" name="type_payment" value="dp" required class="mr-2">
                                DP 5% (Rp. {{ number_format($booking->produk->price * 0.05, 0, ',', '.') }})
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="type_payment" value="lunas" required class="mr-2">
                                Bayar Penuh (Rp. {{ number_format($booking->produk->price, 0, ',', '.') }})
                            </label>
                        </div>
                    </div>

                    <!-- Upload Bukti Pembayaran -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Unggah Bukti Pembayaran</label>
                        <input type="file" name="payment_proof" required class="w-full px-4 py-2 border rounded-lg focus:outline-none">
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" id="confirm-payment"
                        class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                        Konfirmasi Pembayaran
                    </button>
                @endif
            </form>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            
            Swal.fire({
                title: "Konfirmasi Pembayaran",
                text: "Apakah Anda yakin ingin mengirim pembayaran?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Konfirmasi!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        });
    </script>
@endsection
