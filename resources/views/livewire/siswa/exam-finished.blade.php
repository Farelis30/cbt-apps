<x-layouts.app>
    @section('title', 'Ujian Selesai')
    <div class="max-w-2xl mx-auto my-10 p-8 bg-white rounded-2xl shadow-lg border border-gray-200 text-center">
        <!-- Ilustrasi -->
        <div class="flex justify-center mb-6">
            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Exam Complete" class="h-12 w-12">
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-4">Ujian Selesai!</h1>
        <p class="text-lg text-gray-600 mb-8">Anda telah menyelesaikan Ujian</p>

        <!-- Feedback Message -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8 text-left">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Nilai akhir akan diumumkan setelah semua ujian selesai
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mt-6">
            <a href="{{ route('siswa.home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 text-sm text-gray-500">
            <p>Terima kasih telah mengikuti ujian ini. Hasil resmi akan diberikan oleh guru terkait.</p>
        </div>
    </div>
</x-layouts.app>
