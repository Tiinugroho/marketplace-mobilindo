<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobilindo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-gray-50 vh-100">

    <!-- Header -->
    <header class="bg-gray-800 text-white py-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <a href="{{ '/' }}" class="text-2xl font-semibold">Abel Mobilindo</a>

            <!-- Search Form -->
            <div class="relative flex items-center">
                <form action="" method="GET" class="flex items-center">
                    <!-- Input pencarian -->
                    <input type="text" name="search" placeholder="Search products..."
                        value="{{ request()->input('search') }}"
                        class="px-4 py-2 rounded-lg text-sm bg-gray-800 text-white placeholder-gray-400 focus:outline-none border border-white focus:border-green-500 focus:ring-2 focus:ring-green-500 w-full sm:w-64 md:w-80 lg:w-96" />
                    <!-- Tombol submit dengan ikon pencarian -->
                    <button type="submit"
                        class="absolute top-0 right-0 px-4 py-2 bg-green-500 text-white rounded-r-lg flex items-center justify-center group transition-all duration-300 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <!-- Ikon pencarian -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 group-hover:scale-110 transition-all duration-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M16.5 10a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Navbar -->
            <nav>
                <div class="block lg:hidden">
                    <button onclick="toggleMenu()" class="text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
                <ul id="menu" class="hidden lg:flex items-center space-x-6">
                    <li>
                        <a href="{{ '/' }}" class="hover:text-green-500 transition duration-300">Home</a>
                    </li>
                    <li>
                        <a href="{{ 'about' }}" class="hover:text-green-400 transition duration-300">Tentang</a>
                    </li>
                    <li>
                        <a href="{{ 'pesanan' }}" class="hover:text-green-400 transition duration-300">Pesanan Anda</a>
                    </li>
                    <li>
                        @auth
                            <a href="#" class="inline-block px-6 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition duration-300">
                                {{ Auth::user()->username }}
                            </a>
                            <button onclick="confirmLogout()" class="ml-4 px-6 py-2 bg-red-500 text-white text-sm font-semibold rounded-lg hover:bg-red-600 transition duration-300">
                                Logout
                            </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition duration-300">
                                Login
                            </a>
                        @endauth
                    </li>                    
                    
                </ul>
            </nav>

        </div>
    </header>

    

    <!-- Main Content -->
    @yield('content')


    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 kelompok 6. All rights reserved.</p>
            <div class="mt-4">
                <ul class="flex justify-center space-x-6">
                    <li><a href="/privacy" class="hover:text-green-500 transition duration-300">Privacy Policy</a></li>
                    <li><a href="/terms" class="hover:text-green-500 transition duration-300">Terms of Service</a></li>
                    <li><a href="/contact" class="hover:text-green-500 transition duration-300">Contact</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleMenu() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        }
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: "Apakah Anda yakin ingin logout?",
            text: "Anda akan keluar dari akun ini.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Logout",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>


</body>

</html>
