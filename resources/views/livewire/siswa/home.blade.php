<x-layouts.app>
    @section('title', 'Home Siswa')
    <div>
        @if (session()->has('message'))
            <div class="bg-green-500 text-white font-bold rounded px-4 py-2 mb-4">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-amber-400 text-white rounded px-4 py-2 mb-4">
                {{ session('error') }}
            </div>
        @endif


        <div class="w-full h-64 relative bg-cover bg-center rounded-lg text-white shadow-xl" style="background-image: url('https://img.freepik.com/free-vector/gradient-blue-background_23-2149350177.jpg?ga=GA1.1.191346357.1743310429&semt=ais_hybrid');">
            <div class="h-full rounded-lg p-4 flex flex-col gap-3 justify-center text-center">
                <h1 class="text-3xl font-bold">Selamat Datang!</h1>
                <p class="text-sm">Semoga harimu menyenangkan dan penuh semangat!</p>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-neutral-600 mb-6 mt-10">Ujian</h2>
        </div>

        @if ($ujians->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-4 flex max-w-md">
                <div class="flex-1">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg text-gray-800">Ujian Belum Ada</h3>
                    </div>
                </div>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($ujians as $ujian)
                    @php
                        // Menentukan status ujian
                        $now = \Carbon\Carbon::now();
                        $startTime = \Carbon\Carbon::parse($ujian->waktu_mulai);
                        $endTime = \Carbon\Carbon::parse($ujian->waktu_selesai);

                        // Cek apakah siswa sudah mengerjakan ujian ini (nilai sudah ada)
                        $siswaProfile = \App\Models\SiswaProfile::where('user_id', Auth::id())->first();
                        $nilaiExists = \App\Models\Nilai::where('siswa_id', $siswaProfile->id)
                                        ->where('ujian_id', $ujian->id)
                                        ->exists();

                        // Menentukan status dan warna berdasarkan kondisi
                        if ($nilaiExists) {
                            $status = 'Selesai';
                            $statusClass = 'bg-green-100 text-green-800';
                            $borderClass = 'border-green-500';
                        } elseif ($now->lt($startTime)) {
                            $status = 'Belum Dibuka';
                            $statusClass = 'bg-gray-100 text-gray-800';
                            $borderClass = 'border-gray-500';
                        } elseif ($now->gt($endTime)) {
                            $status = 'Ditutup';
                            $statusClass = 'bg-red-100 text-red-800';
                            $borderClass = 'border-red-500';
                        } else {
                            $status = 'Sedang Berlangsung';
                            $statusClass = 'bg-blue-100 text-blue-800';
                            $borderClass = 'border-blue-500';
                        }
                    @endphp

                    <a href="{{ route('siswa.detail-ujian', ['id' => $ujian->id]) }}" class="bg-white rounded-lg shadow-md p-4 flex border-l-4 {{ $borderClass }} hover:shadow-lg transition-shadow">
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-gray-800">{{ $ujian->nama_ujian }}</h3>
                                <div class="w-10 h-10 rounded-full {{ str_replace('text', 'bg', str_replace('800', '500', $statusClass)) }} flex items-center justify-center">
                                    @if ($status == 'Selesai')
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @elseif ($status == 'Sedang Berlangsung')
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif ($status == 'Ditutup')
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m9-6h.01M19 19H5V5h14v14z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2 space-y-2">
                                <p class="text-xl font-semibold text-gray-600">{{ $ujian->duration }} menit</p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Jam:</span>
                                    {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($ujian->waktu_selesai)->format('H:i') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Tanggal:</span>
                                    {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('d M Y') }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium text-gray-600">Keterangan:</span>
                                    <span class="px-2 py-1 rounded-full text-xs {{ $statusClass }}">{{ $status }}</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
