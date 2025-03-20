@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="" method="POST">
            @csrf

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

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium mb-2">Login Sebagai</label>
                <select name="role" id="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="admin">Admin</option>
                    <option value="seller">Seller</option>
                    <option value="client">Customer</option>
                </select>

                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-700 text-sm">Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-4">
            Belum punya akun? <a href="{{ ('register') }}" class="text-blue-500 hover:underline">Daftar</a>
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
