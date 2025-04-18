<div>
    <form wire:submit.prevent="save">

        <div class="mb-4">
            <label for="kelas" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
            <input wire:model="kelas" type="text" id="kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('kelas') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-start">
            <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
        </div>
    </form>
</div>
