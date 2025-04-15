<div>
    <x-layouts.guru>
        @section('title', 'Dashboard Guru')
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </x-slot>

        <div class="p-4 space-y-2">
            <h1 class="text-xl font-bold">Nama Lengkap: {{ $nama_lengkap }}</h1>
            <h2 class="text-lg">Kelas: {{ $kelas }}</h2>
            <h2 class="text-lg">Mata Pelajaran: {{ $mata_pelajaran }}</h2>
        </div>
    </x-layouts.guru>
</div>
