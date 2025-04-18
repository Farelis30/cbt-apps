<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDN Aren Jaya X | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col">

        {{-- Jika user sudah login --}}
        @if (Auth::check() && Auth::user()->role == 'siswa' && !request()->is('ujian'))
            <header>
                <nav class="bg-white">
                    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16 pt-10">
                            <!-- Left side - Username -->
                            <div class="flex flex-col gap-3 justify-center">
                                <p class="text-3xl font-bold text-neutral-600">Hi, {{ $username ?? Auth::user()->username }}</p>
                                <p class="text-xs font-semibold text-gray-400">Login pada: {{ now()->format('Y-m-d H:i:s') }}</p>
                            </div>

                            <!-- Right side - Desktop Navigation -->
                            <div class="hidden md:flex items-center space-x-6">
                                <a href="{{ route('siswa.home') }}" wire:navigate class="text-gray-700 hover:text-primary-600 text-sm font-medium">Home</a>
                                <a href="{{ route('siswa.jadwal') }}" wire:navigate class="text-gray-700 hover:text-primary-600 text-sm font-medium">Jadwal</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-700 hover:text-primary-600 text-sm font-medium cursor-pointer">
                                        Logout
                                    </button>
                                </form>
                            </div>

                            <!-- Mobile menu button -->
                            <div class="flex items-center md:hidden">
                                <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="mobile-menu" aria-expanded="false">
                                    <span class="sr-only">Open main menu</span>
                                    <!-- Menu icon -->
                                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu, show/hide based on menu state -->
                    <div class="md:hidden hidden" id="mobile-menu">
                        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 absolute top-24 left-0 w-full bg-white z-50 rounded-b-xl shadow">
                            <a href="{{ route('siswa.home') }}" class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors duration-150">Home</a>
                            <a href="{{ route('siswa.jadwal') }}" class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors duration-150">Jadwal</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-3 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors duration-150">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </header>
        @endif
        <main class="flex-1">
            @if (Auth::check() && Auth::user()->role == 'siswa' && !request()->is('ujian'))
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
                    {{ $slot }}
                </div>
            @else
                {{ $slot }}
            @endif
        </main>

        @if (Auth::check() && Auth::user()->role == 'siswa')
            <footer class="mt-8 mb-4 text-sm text-[#706f6c] dark:text-[#A1A09A] text-center">
                <p>© {{ date('Y') }} Sistem Ujian Online SD. All rights reserved.</p>
            </footer>
        @endif
    </div>

    @livewireScripts
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {  // Pastikan elemen ada sebelum mengaksesnya
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
