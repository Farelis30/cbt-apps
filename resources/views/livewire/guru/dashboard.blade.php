<div>
    <x-layouts.guru>
        @section('title', 'Dashboard Guru')
        <x-slot name="header">
        </x-slot>

        <div class="p-4 space-y-2">
            <div class="absolute -top-4 left-10 rounded w-20 h-10 flex items-center justify-center bg-amber-400">
                <i class="fas fa-user text-2xl text-white"></i>
            </div>
            <h1 class="text-xl font-semibold">{{ $nama_lengkap }}</h1>
            <div class="md:flex space-x-4 gap-2.5">
                <table class="border border-gray-200 min-w-2xs text-center">
                    <tr>
                        <td class="py-2 font-semibold bg-blue-500 text-white">Kelas</td>
                    </tr>
                    <tr>
                        <td class="py-2">{{ $kelas }}</td>
                    </tr>
                </table>
                <table class="border border-gray-200 min-w-2xs text-center">
                    <tr>
                        <td class="py-2 font-semibold bg-blue-500 text-white">Mata Pelajaran</td>
                    </tr>
                    <tr>
                        <td class="py-2">{{ $mata_pelajaran }}</td>
                    </tr>
                </table>
            </div>
            <p>data ini diatur oleh administrator, jika ada perubahan silahkan hubungi admin</p>
        </div>
    </x-layouts.guru>
</div>
