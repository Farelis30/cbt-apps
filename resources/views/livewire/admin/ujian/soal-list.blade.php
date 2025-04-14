<div>
    <div class="mb-6 p-4 bg-white rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Detail Ujian</h3>
        <div class="mt-2 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-gray-600 text-sm">Nama Ujian</p>
                <p class="font-semibold">{{ $ujian->nama_ujian }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Kelas</p>
                <p class="font-semibold">{{ $ujian->kelas->kelas }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Mata Pelajaran</p>
                <p class="font-semibold">{{ $ujian->mataPelajaran->nama_mapel }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Jumlah Soal</p>
                <p class="font-semibold">{{ $ujian->jumlah_soal }} soal</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Durasi</p>
                <p class="font-semibold">{{ $ujian->duration }} menit</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm">Waktu Pelaksanaan</p>
                <p class="font-semibold">{{ $ujian->waktu_mulai->format('d M Y, H:i') }} - {{ $ujian->waktu_selesai->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pertanyaan
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Jawaban Benar
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Bobot
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($soal as $s)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ Str::limit($s->pertanyaan, 50) }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $s->jawaban_benar }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $s->bobot }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.ujian.soal.edit', ['ujianId' => $ujianId, 'soalId' => $s->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $s->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-4 text-center text-gray-500">
                            Soal ujian belum ada, silahkan tambah soal.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(soalId) {
            Swal.fire({
                title: 'Anda yakin ingin menghapus soal ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', soalId);
                }
            });
        }
    </script>
</div>
