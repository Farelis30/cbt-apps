<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script>
        function toggleSidebarCollapsed() {
            const sidebarCollapsed = document.getElementById('sidebar-collapsed');
            const sidebarTextElements = document.querySelectorAll('.sidebar-text');
            const sidebarLogo = document.getElementById('sidebar-logo');

            sidebarCollapsed.classList.toggle('w-20');
            sidebarCollapsed.classList.toggle('w-64');

            sidebarLogo.classList.toggle('hidden');

            sidebarTextElements.forEach(text => {
                text.classList.toggle('hidden');
            });
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }


    </script>
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />

</head>
<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <aside id="sidebar-collapsed" class="hidden md:block w-64 bg-gradient-to-r from-blue-600 to-blue-500 shadow-md p-5 transition-all duration-300">
            <div class="mb-3 flex items-center justify-center">
                <img src="{{ asset('logo.png') }}" id="sidebar-logo" class="w-20 h-20 bg-white rounded-full" alt="">
            </div>
            <hr class="border-gray-50 mb-2 opacity-50">
            <nav>
                <ul class="space-y-2">
                    <li class="mb-4">
                        <a href="{{ route('guru.dashboard') }}" wire:navigate class="py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            <i class="fas fa-gauge mr-2"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                        <hr class="border-gray-50 mb-2 opacity-50">
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('guru.ujian.index') }}" wire:navigate class="py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            <i class="fas fa-pen mr-2"></i>
                            <span class="sidebar-text">Ujian</span>
                        </a>
                    </li>
                    <li class="mb-2 p-1">
                        <h2 class="text-sm font-bold text-white uppercase sidebar-text">Menu Guru</h2>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('guru.setting.index') }}" wire:navigate class="py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            <i class="fas fa-gear mr-2"></i>
                            <span class="sidebar-text">Profile</span>
                        </a>
                    </li>
                    <li class="mb-4">
                        <form action="{{ route('logout') }}" method="POST" class="cursor-pointer py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            @csrf
                            <button type="submit" class="cursor-pointer w-full text-left flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span class="sidebar-text">
                                    Logout
                                </span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Sidebar Mobile -->
        <aside id="sidebar" class="fixed md:hidden z-40 inset-y-0 left-0 w-4/5 bg-gradient-to-r from-blue-600 to-blue-500 shadow-md p-5 transition-transform duration-300 transform -translate-x-full md:translate-x-0 md:w-64" aria-label="Sidebar">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-white text-center sidebar-text uppercase">Exam Apps</h2>
                <button onclick="toggleSidebar()" class="p-2 shadow w-12 bg-blue-600 hover:bg-blue-500 rounded-md cursor-pointer text-xl"><i class="fas fa-times text-white"></i></button>
            </div>
            <hr class="border-gray-50 mb-2 opacity-50">
            <nav>
                <ul class="space-y-2">
                    <!-- Dashboard Link -->
                    <li class="mb-4">
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            <i class="fas fa-home mr-2"></i>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                        <hr class="border-gray-50 mb-2 opacity-50">
                    </li>
                    <!-- Mata Pelajaran Link -->
                    <li class="mb-4">
                        <a href="{{ route('admin.mapel.index') }}" wire:navigate class="py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            <i class="fas fa-book mr-2"></i>
                            <span class="sidebar-text">Mata Pelajaran</span>
                        </a>
                    </li>
                    <!-- Admin Menu Heading -->
                    <li class="mb-2 p-1">
                        <h2 class="text-sm font-bold text-white uppercase">Menu Guru</h2>
                    </li>
                    <li class="mb-4">
                        <a href="{{ route('admin.setting.index') }}" wire:navigate class="py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            <i class="fas fa-gear mr-2"></i>
                            <span class="sidebar-text">Profile</span>
                        </a>
                    </li>
                    <!-- Logout Link -->
                    {{-- <li class="mb-4">
                        <form action="{{ route('logout') }}" method="POST" class="cursor-pointer py-2 px-3 rounded-md text-white hover:bg-blue-50 hover:text-blue-600 flex items-center transition-colors duration-200 mb-2">
                            @csrf
                            <button type="submit" class="cursor-pointer w-full text-left flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                <span class="sidebar-text">Logout</span>
                            </button>
                        </form>
                    </li> --}}
                </ul>
            </nav>
        </aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="hidden md:flex bg-white p-4 justify-between items-center shadow-md">
                <div class="flex items-center gap-5">
                    <button onclick="toggleSidebarCollapsed()" class="p-2 shadow w-12 bg-blue-400 hover:bg-blue-500 rounded-md cursor-pointer"><i class="fas fa-bars text-white"></i></button>
                    <h2 class="text-md font-semibold text-blue-600 text-center sidebar-text">{{ Auth::user()->username }}</h2>
                </div>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 cursor-pointer text-gray-700 px-4 py-2 rounded-md">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Header Mobile -->
            <header class="md:hidden bg-white p-4 flex justify-between items-center shadow-md">
                <button onclick="toggleSidebar()" class="p-2 shadow w-12 bg-blue-400 hover:bg-blue-500 rounded-md cursor-pointer"><i class="fas fa-bars text-white"></i></button>
                <div class="flex items-center space-x-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-gray-200 hover:bg-gray-300 cursor-pointer text-gray-700 px-4 py-2 rounded-md">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Header -->
            <div class="px-8 py-4">
                {{ $header }}
            </div>

            <!-- Content -->
            <main class="px-8 flex-1 relative">
                <div class="p-6 bg-white shadow-md rounded">
                    {{ $slot }}
                </div>
            </main>
            <!-- Footer -->
            <footer class="bg-white shadow-sm border-t border-gray-200 p-4 text-center text-gray-600 mt-4">
                <p>© 2025 Sistem Ujian Online SD. All rights reserved.</p>
            </footer>
        </div>
    </div>

    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts
</body>
</html>
