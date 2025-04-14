<x-layouts.admin>
    @section('title', 'Manajemen Ujian')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manajemen Ujian') }}
            </h2>
            <a href="{{ route('admin.ujian.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Tambah Ujian
            </a>
        </div>
    </x-slot>

    <div>
        @if (session()->has('message'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        @livewire('admin.ujian.ujian-list')
    </div>

    <script>
        window.addEventListener('ujian-deleted', event => {
            Swal.fire(
                'Terhapus!',
                event.detail.message,
                'success'
            );
        });
    </script>
</x-layouts.admin>
