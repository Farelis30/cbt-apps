<x-layouts.admin>
    @section('title', 'Nilai Ujian')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Laporan Nilai Ujian') }}
            </h2>
        </div>
    </x-slot>

    <div>
        @if (session()->has('message'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        @livewire('admin.ujian.nilai-list')
    </div>
</x-layouts.admin>
