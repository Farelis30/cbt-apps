<div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID Siswa
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nama Lengkap
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Kelas
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
                @forelse ($siswas as $siswa)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $siswa->nisn }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $siswa->nama_lengkap }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $siswa->kelas->kelas }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            {{ $siswa->user->username }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs cursor-pointer">
                                    Edit
                                </a>
                                <button onclick="confirmDelete({{ $siswa->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs cursor-pointer">Hapus</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-3 px-4 text-center text-gray-500">
                            Siswa belum ada, silahkan tambah siswa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $siswas->links() }}
</div>

<script>
    function confirmDelete(siswaId) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus siswa ini?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', siswaId);
                Swal.fire(
                    'Terhapus!',
                    'Siswa telah dihapus.',
                    'success'
                );
            }
        });
    }
</script>
