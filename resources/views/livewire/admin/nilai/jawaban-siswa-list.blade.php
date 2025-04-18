<div>
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Siswa</h3>
                <table class="w-full">
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Nama Siswa</td>
                        <td class="py-2">: {{ $nilai->siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">NIS</td>
                        <td class="py-2">: {{ $nilai->siswa->nis }}</td>
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
                        <td class="py-2">: {{ $nilai->ujian->judul }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Mata Pelajaran</td>
                        <td class="py-2">: {{ $nilai->ujian->mapel->nama_mapel }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 text-gray-600 font-medium">Nilai</td>
                        <td class="py-2">: <span class="{{ $nilai->nilai >= 80 ? 'text-green-600' : ($nilai->nilai >= 60 ? 'text-yellow-600' : 'text-red-600') }} font-bold">{{ $nilai->nilai }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Jawaban</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="soalFilter" class="block text-sm font-medium text-gray-700">Filter Soal</label>
                <select wire:model.live="soalFilter" id="soalFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">Semua Soal</option>
                    @foreach($soals as $soal)
                        <option value="{{ $soal->id }}">Soal #{{ $soal->nomor_soal }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="statusFilter" class="block text-sm font-medium text-gray-700">Status Jawaban</label>
                <select wire:model.live="statusFilter" id="statusFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">Semua Status</option>
                    <option value="1">Benar</option>
                    <option value="0">Salah</option>
                </select>
            </div>

            <div class="flex items-end">
                <button wire:click="resetFilters" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">Daftar Jawaban Siswa</h3>
        </div>

        @if($jawabans->count() > 0)
            <div class="space-y-6 p-6">
                @foreach($jawabans as $jawaban)
                    <div class="p-4 border rounded-lg {{ $jawaban->is_correct ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }}">
                        <div class="flex justify-between mb-2">
                            <div class="font-semibold">Soal #{{ $jawaban->soal->nomor_soal }}</div>
                            <div>
                                <span class="px-3 py-1 rounded-full text-xs {{ $jawaban->is_correct ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $jawaban->is_correct ? 'Benar' : 'Salah' }}
                                </span>
                                <span class="ml-2 px-3 py-1 rounded-full text-xs bg-blue-200 text-blue-800">
                                    Skor: {{ $jawaban->skor }}
                                </span>
                                <span class="ml-2 px-3 py-1 rounded-full text-xs bg-gray-200 text-gray-800">
                                    Bobot: {{ $jawaban->soal->bobot ?? 1 }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-3 bg-white p-3 rounded border">
                            <div class="mb-2">
                                <strong>Pertanyaan:</strong>
                                <div class="mt-1">{{ $jawaban->soal->pertanyaan }}</div>
                            </div>

                            @if($jawaban->soal->jenis_soal == 'pilihan_ganda')
                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <div class="mb-2">
                                        <strong>Pilihan:</strong>
                                        <ul class="mt-1 space-y-1">
                                            <li class="{{ $jawaban->soal->jawaban_benar == 'A' ? 'text-green-600 font-semibold' : '' }}">
                                                A. {{ $jawaban->soal->pilihan_a }}
                                            </li>
                                            <li class="{{ $jawaban->soal->jawaban_benar == 'B' ? 'text-green-600 font-semibold' : '' }}">
                                                B. {{ $jawaban->soal->pilihan_b }}
                                            </li>
                                            <li class="{{ $jawaban->soal->jawaban_benar == 'C' ? 'text-green-600 font-semibold' : '' }}">
                                                C. {{ $jawaban->soal->pilihan_c }}
                                            </li>
                                            <li class="{{ $jawaban->soal->jawaban_benar == 'D' ? 'text-green-600 font-semibold' : '' }}">
                                                D. {{ $jawaban->soal->pilihan_d }}
                                            </li>
                                            @if($jawaban->soal->pilihan_e)
                                            <li class="{{ $jawaban->soal->jawaban_benar == 'E' ? 'text-green-600 font-semibold' : '' }}">
                                                E. {{ $jawaban->soal->pilihan_e }}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div>
                                        <div class="mb-2">
                                            <strong>Jawaban Benar:</strong>
                                            <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 rounded">
                                                {{ $jawaban->soal->jawaban_benar }}
                                            </span>
                                        </div>

                                        <div>
                                            <strong>Jawaban Siswa:</strong>
                                            <span class="ml-2 px-2 py-1 {{ $jawaban->is_correct ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded">
                                                {{ $jawaban->jawaban }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mt-3">
                                    <div class="mb-2">
                                        <strong>Jawaban Benar:</strong>
                                        <div class="mt-1 p-2 bg-green-50 border border-green-200 rounded">
                                            {{ $jawaban->soal->jawaban_benar }}
                                        </div>
                                    </div>

                                    <div>
                                        <strong>Jawaban Siswa:</strong>
                                        <div class="mt-1 p-2 {{ $jawaban->is_correct ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} border rounded">
                                            {{ $jawaban->jawaban }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 text-center text-gray-500">
                Tidak ada data jawaban yang ditemukan.
            </div>
        @endif
    </div>
</div>
