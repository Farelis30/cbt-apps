<div>
    <!-- Notifications -->
    <div x-data="{ show: false, message: '' }"
         x-on:notify.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="fixed top-4 right-4 bg-green-500 text-white p-3 rounded shadow-lg z-50"
         style="display: none;">
        <p x-text="message"></p>
    </div>

    <!-- Detail Ujian Section -->
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
                <p class="font-semibold">{{ $soal->count() }} soal</p>
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

    <!-- Question List -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full">
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
                                <button wire:click="editSoal({{ $s->id }})" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-xs">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $s->id }})" class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-xs">Hapus</button>
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

    <!-- Question Form (Add/Edit) -->
    @if($showForm)
    <div class="p-4 bg-white rounded-lg shadow-md mt-4">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">{{ $isEditing ? 'Edit Soal' : 'Tambah Soal' }}</h4>

        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label for="pertanyaan" class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                <textarea wire:model="pertanyaan" id="pertanyaan" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('pertanyaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="pilihan_a" class="block text-gray-700 text-sm font-bold mb-2">Pilihan A</label>
                    <input wire:model="pilihan_a" type="text" id="pilihan_a" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_a') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="pilihan_b" class="block text-gray-700 text-sm font-bold mb-2">Pilihan B</label>
                    <input wire:model="pilihan_b" type="text" id="pilihan_b" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_b') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="pilihan_c" class="block text-gray-700 text-sm font-bold mb-2">Pilihan C</label>
                    <input wire:model="pilihan_c" type="text" id="pilihan_c" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_c') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="pilihan_d" class="block text-gray-700 text-sm font-bold mb-2">Pilihan D</label>
                    <input wire:model="pilihan_d" type="text" id="pilihan_d" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_d') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="jawaban_benar" class="block text-gray-700 text-sm font-bold mb-2">Jawaban Benar</label>
                    <select wire:model="jawaban_benar" id="jawaban_benar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Jawaban Benar --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                    @error('jawaban_benar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="bobot" class="block text-gray-700 text-sm font-bold mb-2">Bobot</label>
                    <input wire:model="bobot" type="number" id="bobot" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('bobot') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" wire:click="toggleForm" class="cursor-pointer mr-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Batal
                </button>
                <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ $isEditing ? 'Perbarui' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Add Question Button -->
    @if (!$showForm)
    <div class="mt-4 flex justify-end">
        <button wire:click="toggleForm" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <i class="fas fa-plus"></i>
            </button>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
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
