@extends('layouts.app')

@section('content')
    <!-- Banner -->
    <div class="relative w-full h-[100vh] bg-gray-300 rounded-lg overflow-hidden">
        <img src="{{ asset('abel.jpg') }}" alt="Banner" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white">
            <h1 class="text-4xl font-bold">Selamat Datang di Mobilindo</h1>
            <p class="text-lg mt-2">Temukan mobil bekas berkualitas dengan harga terbaik</p>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- Sidebar Filter (col-span-4) -->
            <div class="col-span-12 md:col-span-4 bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Filter Pencarian</h2>

                <form action="{{ route('home') }}" method="GET">
                    <!-- Search -->
                    <div class="mb-4">
                        <input type="text" name="search" placeholder="Cari mobil..."
                            value="{{ request()->query('search') }}"
                            class="px-4 py-2 w-full border rounded-lg focus:outline-none">
                    </div>

                    <!-- Dropdown Kategori -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                        <select name="kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ request()->query('kategori') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                        Terapkan Filter
                    </button>
                </form>
            </div>

            <!-- Daftar Produk (col-span-8) -->
            <div class="col-span-12 md:col-span-8">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Mobil</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($produks as $produk)
                        <div class="bg-white border rounded-lg shadow transition overflow-hidden">
                            <img src="{{ asset('storage/' . $produk->image) }}"
                                alt="{{ $produk->brand }} {{ $produk->model }}" class="w-full h-56 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $produk->brand }} {{ $produk->model }}</h3>
                                <p class="text-gray-600">Tahun: {{ $produk->year }}</p>
                                <p class="text-gray-600">Pemilik: {{ $produk->seller->username }}</p>
                                <p class="text-gray-600">Kategori: {{ $produk->kategori->name ?? '-' }}</p>
                                <p class="text-green-500 font-bold text-lg">Rp.
                                    {{ number_format($produk->price, 0, ',', '.') }}</p>

                                <a href="{{ route('produk.detail', $produk->id) }}"
                                    class="block text-center mt-3 bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition text-xs font-bold">
                                    Lihat Detail
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $produks->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
