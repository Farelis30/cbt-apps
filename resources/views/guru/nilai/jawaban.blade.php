<x-layouts.admin>
    @section('title', 'Jawaban Siswa')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Jawaban Siswa') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('guru.nilai.detail', $nilaiId) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Detail Nilai
                </a>
                <a href="{{ route('guru.nilai.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div>
        @livewire('guru.nilai.jawaban-siswa-list', ['nilaiId' => $nilaiId])
    </div>
</x-layouts.admin>
