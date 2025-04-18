<div>
    <div class="mb-6 bg-white p-4 rounded-md shadow">
        <h3 class="font-semibold text-lg mb-4">Filter Nilai</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Pencarian (Nama/NIS/Ujian)</label>
                <input wire:model.live="search" type="text" id="search" placeholder="Cari..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>

            <div>
                <label for="ujianFilter" class="block text-sm font-medium text-gray-700">Filter Ujian</label>
                <select wire:model.live="ujianFilter" id="ujianFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">Semua Ujian</option>
                    @foreach($ujians as $ujian)
                        <option value="{{ $ujian->id }}">{{ $ujian->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kelasFilter" class="block text-sm font-medium text-gray-700">Filter Kelas</label>
                <select wire:model.live="kelasFilter" id="kelasFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">Semua Kelas</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="nilaiMin" class="block text-sm font-medium text-gray-700">Nilai Minimum</label>
                <input wire:model.live="nilaiMin" type="number" min="0" max="100" id="nilaiMin" placeholder="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>

            <div>
                <label for="nilaiMax" class="block text-sm font-medium text-gray-700">Nilai Maksimum</label>
                <input wire:model.live="nilaiMax" type="number" min="0" max="100" id="nilaiMax" placeholder="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>

            <div>
                <label for="tanggalMulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input wire:model.live="tanggalMulai" type="date" id="tanggalMulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>

            <div>
                <label for="tanggalSelesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input wire:model.live="tanggalSelesai" type="date" id="tanggalSelesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
            </div>

            <div class="flex items-end">
                <button wire:click="resetFilters" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Reset Filter
                </button>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Nama Siswa</th>
                    <th class="py-3 px-4 text-left">NIS</th>
                    <th class="py-3 px-4 text-left">Kelas</th>
                    <th class="py-3 px-4 text-left">Ujian</th>
                    <th class="py-3 px-4 text-left">Nilai</th>
                    <th class="py-3 px-4 text-left">Tanggal Ujian</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($nilais as $index => $nilai)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $nilais->firstItem() + $index }}</td>
                        <td class="py-3 px-4">{{ $nilai->siswa->nama_lengkap }}</td>
                        <td class="py-3 px-4">{{ $nilai->siswa->nisn }}</td>
                        <td class="py-3 px-4">{{ $nilai->siswa->kelas->kelas }}</td>
                        <td class="py-3 px-4">{{ $nilai->ujian->nama_ujian }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-full
                                {{ $nilai->nilai >= 80 ? 'bg-green-100 text-green-800' :
                                   ($nilai->nilai >= 60 ? 'bg-yellow-100 text-yellow-800' :
                                   'bg-red-100 text-red-800') }}">
                                {{ $nilai->nilai }}
                            </span>
                        </td>
                        <td class="py-3 px-4">{{ $nilai->tanggal_ujian->format('d M Y') }}</td>
                        <td class="py-3 px-4 flex space-x-2">
                            <a href="{{ route('admin.nilai.detail', $nilai->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Detail
                            </a>
                            <a href="{{ route('admin.nilai.jawaban', $nilai->id) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Jawaban
                            </a>
                            <button wire:click="delete({{ $nilai->id }})" wire:confirm="Apakah Anda yakin ingin menghapus data nilai ini?" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="py-3 px-4 text-center text-gray-500">
                            Tidak ada data nilai yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $nilais->links() }}
    </div>
</div>
