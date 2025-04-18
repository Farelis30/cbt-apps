<x-layouts.admin>
    @section('title', 'Detail Nilai Siswa')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Detail Nilai Siswa') }}
            </h2>
            <a href="{{ route('guru.nilai.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Siswa</h3>
                <table class="w-full">
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Nama Siswa</td>
                        <td class="py-2">: {{ $nilai->siswa->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">NIS</td>
                        <td class="py-2">: {{ $nilai->siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Kelas</td>
                        <td class="py-2">: {{ $nilai->siswa->kelas->kelas }}</td>
                    </tr>
                </table>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Ujian</h3>
                <table class="w-full">
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Judul Ujian</td>
                        <td class="py-2">: {{ $nilai->ujian->nama_ujian }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Mata Pelajaran</td>
                        <td class="py-2">: {{ $nilai->ujian->mataPelajaran->nama_mapel }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Tanggal Ujian</td>
                        <td class="py-2">: {{ $nilai->tanggal_ujian->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Nilai</h3>
            <div class="bg-gray-100 p-6 rounded-lg">
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-6xl font-bold {{ $nilai->nilai >= 80 ? 'text-green-600' : ($nilai->nilai >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $nilai->nilai }}
                        </div>
                        <div class="mt-2 text-gray-600">
                            Dari skala 0-100
                        </div>
                        <div class="mt-4">
                            <span class="px-4 py-2 rounded-full {{ $nilai->nilai >= 80 ? 'bg-green-100 text-green-800' : ($nilai->nilai >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ $nilai->nilai >= 80 ? 'Sangat Baik' : ($nilai->nilai >= 60 ? 'Cukup' : 'Perlu Perbaikan') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-between">
            <a href="{{ route('guru.nilai.jawaban', $nilai->id) }}" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Lihat Jawaban Siswa
            </a>
            <a href="{{ route('guru.nilai.index') }}" class="px-6 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Kembali ke Daftar Nilai
            </a>
        </div>
    </div>
</x-layouts.admin>
