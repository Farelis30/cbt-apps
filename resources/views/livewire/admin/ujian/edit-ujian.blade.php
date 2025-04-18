<div>
    <div class="p-4 bg-white rounded-lg shadow-md">
        <form wire:submit.prevent="update">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="nama_ujian" class="block text-gray-700 text-sm font-bold mb-2">Nama Ujian</label>
                    <input wire:model="nama_ujian" type="text" id="nama_ujian" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('nama_ujian') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="guru_id" class="block text-gray-700 text-sm font-bold mb-2">Guru</label>
                    <select wire:model="guru_id" id="guru_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Guru --</option>
                        @foreach($guru as $g)
                            <option value="{{ $g->id }}">{{ $g->nama_lengkap }}</option>
                        @endforeach
                    </select>
                    @error('guru_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="kelas_id" class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
                    <select wire:model="kelas_id" id="kelas_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                        @endforeach
                    </select>
                    @error('kelas_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="mata_pelajaran_id" class="block text-gray-700 text-sm font-bold mb-2">Mata Pelajaran</label>
                    <select wire:model="mata_pelajaran_id" id="mata_pelajaran_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($mapel as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                    @error('mata_pelajaran_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="waktu_mulai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai</label>
                    <input wire:model="waktu_mulai" type="datetime-local" id="waktu_mulai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('waktu_mulai') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="waktu_selesai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Selesai</label>
                    <input wire:model="waktu_selesai" type="datetime-local" id="waktu_selesai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('waktu_selesai') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="jumlah_soal" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Soal</label>
                    <input wire:model="jumlah_soal" type="number" id="jumlah_soal" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('jumlah_soal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="duration" class="block text-gray-700 text-sm font-bold mb-2">Durasi (menit)</label>
                    <input wire:model="duration" type="number" id="duration" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('duration') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
