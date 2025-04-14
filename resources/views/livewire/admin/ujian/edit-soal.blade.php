<div>
    <!-- Detail Ujian -->
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
        </div>
    </div>

    <!-- Form Edit Soal -->
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form wire:submit.prevent="update">
            <div class="mb-4">
                <label for="pertanyaan" class="block text-gray-700 text-sm font-bold mb-2">Pertanyaan</label>
                <textarea wire:model.defer="pertanyaan" id="pertanyaan" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('pertanyaan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="pilihan_a" class="block text-gray-700 text-sm font-bold mb-2">Pilihan A</label>
                    <input wire:model.defer="pilihan_a" type="text" id="pilihan_a"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_a') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="pilihan_b" class="block text-gray-700 text-sm font-bold mb-2">Pilihan B</label>
                    <input wire:model.defer="pilihan_b" type="text" id="pilihan_b"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_b') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="pilihan_c" class="block text-gray-700 text-sm font-bold mb-2">Pilihan C</label>
                    <input wire:model.defer="pilihan_c" type="text" id="pilihan_c"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_c') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="pilihan_d" class="block text-gray-700 text-sm font-bold mb-2">Pilihan D</label>
                    <input wire:model.defer="pilihan_d" type="text" id="pilihan_d"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('pilihan_d') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="jawaban_benar" class="block text-gray-700 text-sm font-bold mb-2">Jawaban Benar</label>
                    <select wire:model.defer="jawaban_benar" id="jawaban_benar"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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
                    <input wire:model.defer="bobot" type="number" id="bobot"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('bobot') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
