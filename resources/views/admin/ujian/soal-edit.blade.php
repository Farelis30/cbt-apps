<x-layouts.admin>
    @section('title', 'Edit Soal')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Soal Ujian') }}
            </h2>
            <a href="{{ route('admin.ujian.soal', $ujianId) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Kembali
            </a>
        </div>
    </x-slot>

    @livewire('admin.ujian.edit-soal', ['ujianId' => $ujianId, 'soalId' => $soalId])

</x-layouts.admin>
