@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Halaman Detail</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gambar Produk -->
            <div class="bg-white p-4 rounded-lg shadow">
                <img src="{{ asset('storage/' . $produk->image) }}" alt="{{ $produk->brand }} {{ $produk->model }}"
                    class="w-full h-96 object-cover rounded-lg">
            </div>

            <!-- Detail Produk -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h1 class="text-3xl font-bold text-gray-800">{{ $produk->brand }} {{ $produk->model }}</h1>
                <p class="text-gray-600 mt-2">Tahun: {{ $produk->year }}</p>
                <p class="text-gray-600">Pemilik: {{ $produk->seller->username }}</p>
                <p class="text-gray-600">Kategori: {{ $produk->kategori->name ?? '-' }}</p>
                <p class="text-green-500 font-bold text-2xl mt-4">Rp. {{ number_format($produk->price, 0, ',', '.') }}</p>

                <p class="text-gray-700 mt-6">Deskripsi: {{ $produk->description }}</p>
                <br>

                <!-- Tombol Booking -->
                @auth
                    <form id="booking-form" action="{{ route('detail.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <button type="button" id="btn-booking"
                            class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition text-lg font-bold">
                            Booking Sekarang
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btn-booking').addEventListener('click', function() {
            Swal.fire({
                title: "Konfirmasi Booking",
                text: "Apakah Anda yakin ingin melakukan booking?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Booking Sekarang!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('booking-form').submit();
                }
            });
        });
    </script>
@endsection
