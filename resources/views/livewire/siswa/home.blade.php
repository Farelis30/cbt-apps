<x-layouts.app>
    @section('title', 'Home Siswa')
    <div>
        @if (session()->has('message'))
        <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
            {{ session('message') }}
        </div>
        @endif

    <div class="w-full h-64 relative bg-cover bg-center rounded-lg text-white shadow-xl" style="background-image: url('https://img.freepik.com/free-vector/gradient-blue-background_23-2149350177.jpg?ga=GA1.1.191346357.1743310429&semt=ais_hybrid');">
        <div class="h-full rounded-lg p-4 flex flex-col gap-3 justify-center text-center">
            <h1 class="text-3xl font-bold">Selamat Datang!</h1>
            <p class="text-sm">Semoga harimu menyenangkan dan penuh semangat!</p>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold text-neutral-600 mb-6 mt-10">Ujian</h2>
    </div>

    <!-- Exam Cards Loop with Dummy Data -->
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        <!-- Card 1 -->
        <a href="#" class="bg-white rounded-lg shadow-md p-4 flex border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Matematika</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-2 space-y-2">
                    <p class="text-xl font-semibold text-gray-600">90 menit</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Jam:</span> 08:00 - 09:30</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Jenis:</span> Ujian Tengah Semester</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> Selesai</p>
                </div>
            </div>
        </a>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-4 flex border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-gray-800">Fisika</h3>
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 space-y-2">
                    <p class="text-xl font-semibold text-gray-600">120 menit</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Jam:</span> 10:00 - 12:00</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Jenis:</span> Ujian Akhir Semester</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> Buku catatan diperbolehkan</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-md p-4 flex border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-bold text-gray-800">Bahasa Inggris</h3>
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-3 space-y-2">
                    <p class="text-sm text-gray-600"><span class="font-medium">Waktu:</span> 60 menit</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Jam:</span> 13:00 - 14:00</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Jenis:</span> Ujian Harian</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Keterangan:</span> Listening section included</p>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layouts.app>
