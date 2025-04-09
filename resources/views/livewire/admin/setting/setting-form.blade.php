<div>
    @if (session()->has('message'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif
    <div class="flex items-center mb-6">
        <div class="relative">
            <!-- Profile image with edit icon -->
            @if($tempImage)
                <!-- Show temporary image if uploaded -->
                <img src="{{ $tempImage->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
            @elseif($user->adminProfile && $user->adminProfile->image)
                <!-- Show saved profile image -->
                <img src="{{ asset('storage/' . $user->adminProfile->image) }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
            @else
                <!-- Show dummy image if no profile image -->
                <img src="{{ asset('dummyPic.png') }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
            @endif

            <!-- Edit icon -->
            <label for="image" class="absolute bottom-0 right-0 bg-white rounded-full p-2 w-5 h-5 flex justify-center items-center border border-gray-300 cursor-pointer hover:bg-gray-200">
                <i class="fas fa-pen text-xs text-gray-600"></i>
                <input wire:model="image" type="file" id="image" class="hidden">
            </label>

        </div>

        <div class="ml-4">
            <h2 class="text-xl font-semibold">{{ $user->username }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
        </div>
    </div>

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Nama Pengguna</label>
            <input wire:model="username" type="text" id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input wire:model="email" type="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="nama_lengkap" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input wire:model="nama_lengkap" type="text" id="nama_lengkap" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('nama_lengkap') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <hr class="mb-3">

        <p class="font-bold text-gray-700 mb-3">Ubah Password</p>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <div class="relative">
                <input wire:model="password" type="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 px-3 cursor-pointer flex items-center text-gray-500 hover:text-gray-700"
                >
                    <span id="toggleIcon"><i class="fas fa-eye text-blue-600/60"></i></span>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <div class="relative">
                <input wire:model="password_confirmation" type="password" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                <button
                    type="button"
                    onclick="togglePasswordConfirmation()"
                    class="absolute inset-y-0 right-0 px-3 cursor-pointer flex items-center text-gray-500 hover:text-gray-700"
                >
                    <span id="toggleIconConfirmation"><i class="fas fa-eye text-blue-600/60"></i></span>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-start">
            <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan
            </button>
        </div>

    </form>
</div>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.innerHTML = '<i class="fas fa-eye-slash text-blue-600/60"></i>';
        } else {
            passwordInput.type = 'password';
            toggleIcon.innerHTML = '<i class="fas fa-eye text-blue-600/60"></i>';
        }
    }

    function togglePasswordConfirmation() {
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const toggleIcon = document.getElementById('toggleIconConfirmation');

        if (passwordConfirmationInput.type === 'password') {
            passwordConfirmationInput.type = 'text';
            toggleIcon.innerHTML = '<i class="fas fa-eye-slash text-blue-600/60"></i>';
        } else {
            passwordConfirmationInput.type = 'password';
            toggleIcon.innerHTML = '<i class="fas fa-eye text-blue-600/60"></i>';
        }
    }
</script>
