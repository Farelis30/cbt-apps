<x-layouts.guru>
    @section('title', 'Soal Ujian')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Soal Ujian') }}
            </h2>
            <div class="flex space-x-2">
                <!-- Tombol Import Excel -->
                <button
                    onclick="showImportModal()"
                    class="inline-flex cursor-pointer items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    Import Excel
                </button>

                <a href="{{ route('guru.ujian.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Kembali ke Ujian
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

        @if (session()->has('error'))
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">
                @if (is_array(session('error')))
                    <ul class="list-disc pl-5">
                        @foreach (session('error') as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @else
                    {{ session('error') }}
                @endif
            </div>
        @endif

        @livewire('guru.ujian.soal-manager', ['ujianId' => $ujianId])
    </div>

    <div id="importModal" class="fixed inset-0 bg-gray-600/50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-lg font-medium text-gray-900">Import Data Soal</h3>
                    <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('guru.soal.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ujian_id" value="{{ $ujianId }}">
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500 mb-3">
                            Upload file Excel dengan format yang sesuai
                        </p>
                        <input type="file" name="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        <p class="mt-1 text-xs text-gray-500">Format: .xlsx, .xls, .csv</p>
                    </div>
                    <div class="items-center px-4 py-3">
                        <a href="{{ route('guru.soal.template') }}" class="text-xs text-blue-600 hover:underline">Download Template</a>
                        <div class="mt-3 flex justify-end space-x-2">
                            <button onclick="closeImportModal()" type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 text-xs">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showImportModal() {
            document.getElementById('importModal').classList.remove('hidden');
        }

        function closeImportModal() {
            document.getElementById('importModal').classList.add('hidden');
        }
        window.addEventListener('soal-deleted', event => {
            Swal.fire(
                'Terhapus!',
                event.detail.message,
                'success'
            );
        });
    </script>
</x-layouts.guru>
