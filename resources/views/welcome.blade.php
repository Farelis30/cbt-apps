<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sistem Ujian Online SDN Aren Jaya X</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-gray-50">
        <div class="min-h-[calc(100vh-144px)] md:min-h-screen flex items-center justify-center bg-cover bg-center">
            <div class="w-full max-w-4xl md:border border-gray-100 bg-white md:rounded-xl md:shadow-xl overflow-hidden flex flex-col md:flex-row">
                <!-- Content Section -->
                <div class="w-full md:w-1/2 p-8 md:p-12">
                    <div class="flex items-center justify-center md:hidden mb-4">
                        <img
                            src="{{ asset('logo.png') }}"
                            alt="Logo Sekolah"
                            class="w-30 h-30 max-w-xs md:hidden mb-2"
                        >
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-blue-600 mb-2 text-center md:text-left">Selamat Datang</h1>
                    <p class="text-gray-500 text-sm md:text-base mb-6 text-center md:text-left">Sistem Ujian Online untuk Siswa SDN Aren Jaya X</p>

                    <div class="mb-6">
                        <h2 class="text-lg font-medium text-gray-700 mb-4">Informasi Penting:</h2>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span class="text-gray-600">Pastikan koneksi internet stabil selama ujian berlangsung</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span class="text-gray-600">Gunakan perangkat yang mendukung, seperti laptop atau tablet</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span class="text-gray-600">Login dengan akun yang telah diberikan oleh guru</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-check text-green-500 mt-0.5"></i>
                                <span class="text-gray-600">Kerjakan soal dengan jujur dan mandiri</span>
                            </li>
                        </ul>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                                Mulai Ujian
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium">
                                Masuk
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Image Section -->
                <div class="hidden md:flex md:w-1/2 bg-blue-100 flex-col justify-center items-center p-8">
                    <div class="bg-white p-4 rounded-full">
                        <img
                            src="{{ asset('logo.png') }}"
                            alt="Ilustrasi Sekolah"
                            class="w-40 h-40 max-w-xs"
                        >
                    </div>
                    <h2 class="text-xl font-bold text-blue-900 mt-6">Ujian Online SD</h2>
                    <p class="text-gray-600 text-center mt-2">Belajar dan ujian jadi lebih menyenangkan</p>
                </div>
            </div>
        </div>

        <footer class="py-4 text-center text-sm text-gray-500">
            <p>© {{ date('Y') }} Sistem Ujian Online SD. All rights reserved.</p>
        </footer>
    </body>
</html>
