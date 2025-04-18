<div>
    <form wire:submit.prevent="update">

        <!-- Nama Lengkap -->
        <div class="mb-4">
            <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input wire:model="nama_lengkap" type="text" id="nama_lengkap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="nisn" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input wire:model="nisn" type="text" id="nisn" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('nisn') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Kelas -->
        <div class="mb-4">
            <label for="kelas" class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
            <select wire:model="kelas_id" id="kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Pilih Kelas</option>
                @foreach ($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->kelas }}</option>
                @endforeach
            </select>
            @error('kelas_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Nama Pengguna</label>
            <input wire:model="username" type="text" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input wire:model="email" type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input wire:model="password" :type="showPassword ? 'text' : 'password'" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10">
            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-start">
            <button type="submit" class="cursor-pointer bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Perbarui
            </button>
        </div>

    </form>
</div>

<!-- Password Toggle Script -->
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const button = event.target;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            button.innerText = 'Sembunyikan';
        } else {
            passwordInput.type = 'password';
            button.innerText = 'Lihat';
        }
    }
</script>
