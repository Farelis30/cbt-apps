<x-layouts.guru>
    @section('title', 'Soal Ujian')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Soal Ujian') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('guru.ujian.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali ke Ujian
                </a>
                <a href="{{ route('guru.ujian.soal.create', $ujianId) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Tambah Soal
                </a>
            </div>
        </div>
    </x-slot>

    <div>
        @if (session()->has('message'))
            <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                {{ session('message') }}
            </div>
        @endif

        @livewire('guru.ujian.soal-list', ['ujianId' => $ujianId])
    </div>

    <script>
        window.addEventListener('soal-deleted', event => {
            Swal.fire(
                'Terhapus!',
                event.detail.message,
                'success'
            );
        });
    </script>
</x-layouts.guru>
