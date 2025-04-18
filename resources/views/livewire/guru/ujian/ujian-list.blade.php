<div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Ujian
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Kelas
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Mata Pelajaran
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Waktu Mulai
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ujians as $ujian)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $ujian->nama_ujian }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $ujian->kelas->kelas }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $ujian->mataPelajaran->nama_mapel }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $ujian->waktu_mulai->format('d M Y, H:i') }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('guru.ujian.soal', $ujian->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-xs">
                                    Soal
                                </a>
                                <a href="{{ route('guru.ujian.edit', $ujian->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $ujian->id }})" class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-3 px-4 text-center text-gray-500">
                            Belum ada ujian, silahkan tambah ujian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete(ujianId) {
            Swal.fire({
                title: 'Anda yakin ingin menghapus ujian ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('delete', ujianId);
                }
            });
        }
    </script>
</div>
