@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md m-5">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="" method="POST">
            @csrf

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-medium mb-2">Alamat</label>
                <textarea id="address" name="address" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Selection -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-2">Daftar Sebagai</label>
                <select id="role" name="role" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="seller">Seller</option>
                    <option value="client">Customer</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                Register
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>
</div>

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
@endif
@endsection