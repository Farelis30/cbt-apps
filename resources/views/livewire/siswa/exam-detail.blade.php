<x-layouts.app>

    @section('title', 'Detail Ujian')

    <div class="max-w-3xl mx-auto mt-4 p-8 bg-white rounded-xl border border-gray-100 shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Detail Ujian</h1>
            <div class="w-16 h-1 bg-blue-500 rounded-full"></div>
        </div>

        <div class="space-y-5">
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-600 font-medium">Nama Ujian:</span>
                <span class="text-gray-800 font-semibold text-lg">Ujian Matematika Semester 1</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-600 font-medium">Mata Pelajaran:</span>
                <span class="text-gray-800">Matematika</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-600 font-medium">Tanggal:</span>
                <span class="text-gray-800">15 April 2025</span>
            </div>
            <div class="flex justify-between items-center py-3 border-b border-gray-100">
                <span class="text-gray-600 font-medium">Durasi:</span>
                <span class="text-gray-800">90 Menit</span>
            </div>
            <div class="flex justify-between items-center py-3">
                <span class="text-gray-600 font-medium">Jumlah Soal:</span>
                <span class="text-gray-800">40 Soal</span>
            </div>
        </div>

        <div class="mt-8 text-center">
            <button class="bg-blue-500 hover:bg-blue-600 cursor-pointer text-white font-medium py-3 px-8 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                Mulai Ujian
            </button>
            <p class="text-sm text-gray-500 mt-3">Pastikan Anda sudah siap sebelum memulai ujian</p>
        </div>
    </div>
</x-layouts.app>
