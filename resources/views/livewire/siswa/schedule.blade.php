<x-layouts.app>
    @section('title', 'Jadwal Ujian')
    <div class="max-w-6xl mx-auto py-2">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Ujian</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kalender Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden lg:col-span-2">
                <div class="p-4 bg-blue-600 text-white">
                    <div class="flex justify-between items-center">
                        <button class="p-1 rounded-full hover:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <h2 class="text-xl font-semibold">April 2025</h2>
                        <button class="p-1 rounded-full hover:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4">
                    <!-- Hari dalam minggu -->
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <div class="text-center text-sm font-medium text-gray-500">Min</div>
                        <div class="text-center text-sm font-medium text-gray-500">Sen</div>
                        <div class="text-center text-sm font-medium text-gray-500">Sel</div>
                        <div class="text-center text-sm font-medium text-gray-500">Rab</div>
                        <div class="text-center text-sm font-medium text-gray-500">Kam</div>
                        <div class="text-center text-sm font-medium text-gray-500">Jum</div>
                        <div class="text-center text-sm font-medium text-gray-500">Sab</div>
                    </div>

                    <!-- Tanggal-tanggal -->
                    <div class="grid grid-cols-7 gap-1">
                        <!-- Minggu sebelumnya -->
                        <div class="h-12 text-center text-gray-400">30</div>
                        <div class="h-12 text-center text-gray-400">31</div>

                        <!-- Bulan ini -->
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 cursor-pointer">
                                <span class="text-sm">1</span>
                            </div>
                        </div>
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 cursor-pointer">
                                <span class="text-sm">2</span>
                            </div>
                        </div>
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 cursor-pointer">
                                <span class="text-sm">3</span>
                            </div>
                        </div>
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 cursor-pointer">
                                <span class="text-sm">4</span>
                            </div>
                        </div>
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg hover:bg-gray-100 cursor-pointer">
                                <span class="text-sm">5</span>
                            </div>
                        </div>

                        <!-- Baris berikutnya -->
                        <!-- Contoh tanggal dengan ujian -->
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg bg-blue-50 border border-blue-200 cursor-pointer">
                                <span class="text-sm font-medium text-blue-600">6</span>
                                <div class="w-2 h-2 rounded-full bg-blue-500 mt-1"></div>
                            </div>
                        </div>

                        <!-- ... dan seterusnya sampai akhir bulan -->

                        <!-- Contoh tanggal dengan ujian penting -->
                        <div class="h-12 p-1">
                            <div class="h-full flex flex-col items-center justify-center rounded-lg bg-red-50 border border-red-200 cursor-pointer">
                                <span class="text-sm font-medium text-red-600">15</span>
                                <div class="w-2 h-2 rounded-full bg-red-500 mt-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Ujian Mendatang -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-blue-600 text-white">
                    <h2 class="text-xl font-semibold">Ujian Mendatang</h2>
                </div>

                <div class="p-4 space-y-4">
                    <!-- Item Ujian -->
                    <div class="p-3 border border-blue-100 rounded-lg bg-blue-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-blue-800">Ujian Matematika</h3>
                                <p class="text-sm text-gray-600">Kelas 10 IPA 1</p>
                            </div>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">6 Apr</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            08:00 - 10:00 WIB
                        </div>
                    </div>

                    <!-- Item Ujian -->
                    <div class="p-3 border border-red-100 rounded-lg bg-red-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-red-800">UTS Fisika</h3>
                                <p class="text-sm text-gray-600">Kelas 10 IPA 1</p>
                            </div>
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">15 Apr</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            13:00 - 15:00 WIB
                        </div>
                    </div>

                    <!-- Item Ujian -->
                    <div class="p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-800">Ujian Bahasa Inggris</h3>
                                <p class="text-sm text-gray-600">Kelas 10 IPA 1</p>
                            </div>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">20 Apr</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            10:00 - 11:30 WIB
                        </div>
                    </div>

                    <!-- Item Ujian -->
                    <div class="p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-800">Ujian Kimia</h3>
                                <p class="text-sm text-gray-600">Kelas 10 IPA 1</p>
                            </div>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">25 Apr</span>
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            08:00 - 09:30 WIB
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t border-gray-200 text-center">
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua Jadwal</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
