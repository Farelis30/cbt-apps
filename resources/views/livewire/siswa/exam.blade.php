<x-layouts.app>
    @section('title', $ujian->nama_ujian)
    <div class="max-w-4xl mx-auto mt-2 p-6 bg-white rounded-xl shadow-md">
        <!-- Header Ujian -->
        <div class="flex justify-between items-center mb-6 p-4 bg-blue-50 rounded-lg">
            <div>
                <h2 class="text-xl font-bold text-gray-800">{{ $ujian->nama_ujian }}</h2>
                <p class="text-sm text-gray-600">{{ $ujian->jumlah_soal }} Soal • {{ $ujian->duration }} Menit</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-blue-600" id="countdown">{{ sprintf('%02d:%02d', $menit, $detik) }}</div>
                <p class="text-xs text-gray-500">Waktu tersisa</p>
            </div>
        </div>

        <!-- Progress & Navigation -->
        <div class="flex items-center justify-between mb-6">
            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-4">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($currentIndex / $totalSoal) * 100 }}%"></div>
            </div>
            <span class="text-sm font-medium text-gray-700">{{ $currentIndex }}/{{ $totalSoal }}</span>
        </div>

        <!-- Form untuk mengirim jawaban -->
        <form action="{{ route('siswa.simpan-jawaban') }}" method="POST">
            @csrf
            <input type="hidden" name="soal_id" value="{{ $soal->id }}">

            <!-- Soal -->
            <div class="mb-8 p-4 border border-gray-200 rounded-lg">
                <div class="flex justify-center">
                    <div class="text-lg w-16 h-16 flex items-center justify-center font-medium text-gray-800 mb-4 bg-blue-50 p-3 rounded-full">{{ $currentIndex }}</div>
                </div>
                <div class="flex items-start mb-4">
                    <div>
                        <p class="text-lg font-medium text-gray-800">{{ $soal->pertanyaan }}</p>
                        @if(strpos($soal->pertanyaan, '<img') !== false)
                            {!! $soal->pertanyaan !!}
                        @endif
                    </div>
                </div>

                <!-- Opsi Jawaban -->
                <div class="space-y-3 ml-0">
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                        <input type="radio" name="jawaban" value="a" class="h-4 w-4 text-blue-600 focus:ring-blue-500" {{ $jawabanSoal == 'pilihan_a' ? 'checked' : '' }}>
                        <span class="text-gray-700">{{ $soal->pilihan_a }}</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                        <input type="radio" name="jawaban" value="b" class="h-4 w-4 text-blue-600 focus:ring-blue-500" {{ $jawabanSoal == 'pilihan_b' ? 'checked' : '' }}>
                        <span class="text-gray-700">{{ $soal->pilihan_b }}</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                        <input type="radio" name="jawaban" value="c" class="h-4 w-4 text-blue-600 focus:ring-blue-500" {{ $jawabanSoal == 'pilihan_c' ? 'checked' : '' }}>
                        <span class="text-gray-700">{{ $soal->pilihan_c }}</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                        <input type="radio" name="jawaban" value="d" class="h-4 w-4 text-blue-600 focus:ring-blue-500" {{ $jawabanSoal == 'pilihan_d' ? 'checked' : '' }}>
                        <span class="text-gray-700">{{ $soal->pilihan_d }}</span>
                    </label>
                </div>
            </div>

            <!-- Navigation Button -->
            <div class="flex justify-between">
                @if($currentIndex > 1)
                <button type="submit" name="action" value="prev" class="cursor-pointer px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Sebelumnya
                </button>
                @else
                <div></div>
                @endif

                <div class="space-x-3">
                    @if($currentIndex < $totalSoal)
                    <button type="submit" name="action" value="next" class="cursor-pointer px-5 py-2.5 bg-blue-600 rounded-lg text-white hover:bg-blue-700 font-medium flex items-center">
                        Selanjutnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    @else
                    <button type="submit" name="action" value="finish" class="cursor-pointer px-5 py-2.5 bg-green-600 rounded-lg text-white hover:bg-green-700 font-medium flex items-center">
                        Selesai
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                    @endif
                </div>
            </div>
        </form>

        <!-- Daftar Soal -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Navigasi Soal</h3>
            <div class="grid grid-cols-5 md:grid-cols-10 gap-2">
                @foreach($soals as $index => $s)
                <form action="{{ route('siswa.simpan-jawaban') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                    <input type="hidden" name="action" value="goto">
                    <input type="hidden" name="goto_index" value="{{ $index }}">
                    <button type="submit" class="w-10 h-10 rounded-full
                        @if($index == $currentIndex - 1)
                            bg-blue-600 text-white
                        @elseif(isset($jawaban[$s->id]))
                            bg-green-100 text-green-800
                        @else
                            bg-gray-100 text-gray-800
                        @endif
                        font-medium flex items-center justify-center">
                        {{ $index + 1 }}
                    </button>
                </form>
                @endforeach
            </div>
            <div class="mt-4 flex items-center space-x-4 text-sm">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-blue-600 mr-2"></div>
                    <span>Sedang dikerjakan</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-green-100 mr-2"></div>
                    <span>Sudah dijawab</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Countdown timer
        function startTimer(durationInSeconds, display) {
            let timer = durationInSeconds;
            const interval = setInterval(function () {
                const minutes = parseInt(timer / 60, 10);
                const seconds = parseInt(timer % 60, 10);

                const formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
                const formattedSeconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = formattedMinutes + ":" + formattedSeconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    window.location.href = "{{ route('siswa.selesai-ujian') }}";
                }
            }, 1000);
        }

        window.onload = function () {
            const minutes = {{ $menit }};
            const seconds = {{ $detik }};
            const totalSeconds = (minutes * 60) + seconds;
            const display = document.querySelector('#countdown');
            startTimer(totalSeconds, display);
        };
    </script>
</x-layouts.app>
```
