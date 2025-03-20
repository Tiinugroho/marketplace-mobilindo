@extends('layouts.app')

@section('content')
    <!-- Banner About -->
    <div class="relative w-full h-[60vh] bg-gray-300 rounded-lg overflow-hidden">
        <img src="abel.jpg" alt="About Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white">
            <h1 class="text-4xl font-bold">Tentang Mobilindo</h1>
            <p class="text-lg mt-2">Mitra terpercaya dalam menemukan mobil bekas berkualitas</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <!-- Deskripsi Perusahaan -->
            <div>
                <h2 class="text-3xl font-semibold text-gray-800">Siapa Kami?</h2>
                <p class="text-gray-600 mt-4 leading-relaxed">
                    Mobilindo adalah platform marketplace yang berfokus pada jual beli mobil bekas berkualitas.
                    Kami menghubungkan pembeli dengan penjual terpercaya untuk mendapatkan kendaraan impian
                    dengan harga terbaik dan transparansi penuh.
                </p>
                <p class="text-gray-600 mt-4 leading-relaxed">
                    Dengan pengalaman bertahun-tahun, kami berkomitmen memberikan layanan terbaik
                    dan memastikan setiap transaksi berjalan aman dan nyaman.
                </p>
            </div>

            <!-- Gambar Ilustrasi -->
            <div>
                <img src="about1.jpg" alt="Tentang Kami" class="w-full rounded-lg shadow-lg">
            </div>
        </div>

        <!-- Visi & Misi -->
        <div class="mt-12 text-center">
            <h2 class="text-3xl font-semibold text-gray-800">Visi & Misi</h2>
            <p class="text-gray-600 mt-4 max-w-3xl mx-auto">
                Kami bertekad menjadi marketplace mobil bekas terpercaya di Indonesia dengan menyediakan layanan
                terbaik, harga transparan, serta pengalaman jual beli yang mudah dan aman.
            </p>
        </div>
    </div>
@endsection
