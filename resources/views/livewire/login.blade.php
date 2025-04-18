@section('title', 'Login')
<div class="min-h-[calc(100vh-144px)] md:min-h-screen flex items-center justify-center bg-cover bg-center">
    <div class="w-full max-w-4xl md:border border-gray-100 bg-white md:rounded-xl md:shadow-xl overflow-hidden flex flex-col md:flex-row">
        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <div class="flex items-center justify-center md:hidden mb-4">
                <img
                    src="{{ asset('logo.png') }}"
                    alt="Ilustrasi Sekolah"
                    class="w-30 h-30 max-w-xs md:hidden mb-2"
                >
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-blue-600 mb-2 text-center md:text-left">Login Untuk Mulai</h1>
            <p class="text-gray-500 text-sm md:text-base mb-8 text-center md:text-left">Silakan masuk dengan akun Anda</p>

            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                    <input
                        wire:model="username"
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    >
                    @error('username') <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <div class="relative">
                        <input
                            wire:model="password"
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-10"
                        >
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 px-3 cursor-pointer flex items-center text-gray-500 hover:text-gray-700"
                        >
                            <span id="toggleIcon"><i class="fas fa-eye text-blue-600/60"></i></span>
                        </button>
                    </div>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300"
                >
                    MASUK
                </button>

                <p class="text-center text-gray-500 text-sm">
                    Akun bermasalah? silakan hubungi admin/pengawas terkait
                </p>
            </form>
        </div>

        <!-- Image Section -->
        <div class="hidden md:flex md:w-1/2 bg-blue-100 flex-col justify-center items-center p-8">
            <img
                src="https://img.freepik.com/free-vector/hand-drawn-childish-school-background_23-2149464866.jpg"
                alt="Ilustrasi Sekolah"
                class="w-full max-w-xs rounded-md"
            >
            <h2 class="text-xl font-bold text-blue-900 mt-6">Ujian Online SD</h2>
            <p class="text-gray-600 text-center mt-2">Belajar dan ujian jadi lebih menyenangkan</p>
            {{-- tanda back dengan icon --}}
            <div class="flex items-center mt-4">
                <a href="/" class="hover:text-blue-600 flex items-center">
                    <i class="fas fa-arrow-left"></i>
                    <span class="ml-2">Kembali</span>
                </a>
            </div>
        </div>
    </div>
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
</script>

