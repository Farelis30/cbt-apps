<div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Lengkap
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Kelas
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Mata Pelajaran
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        username
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gurus as $guru)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $guru->nama_lengkap }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $guru->kelas->kelas }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $guru->mata_pelajaran->nama_mapel }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $guru->user->username }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.kelas.edit', $guru->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs cursor-pointer">
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $guru->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs cursor-pointer">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-3 px-4 text-center text-gray-500">
                            Guru belum ada, silahkan tambah guru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $gurus->links() }}
</div>

<script>
    function confirmDelete(guruId) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus guru ini?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', guruId);
                Swal.fire(
                    'Terhapus!',
                    'Siswa telah dihapus.',
                    'success'
                );
            }
        });
    }
</script>
