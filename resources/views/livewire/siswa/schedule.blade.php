<x-layouts.app>
    @section('title', 'Jadwal Ujian')
    <div class="max-w-6xl mx-auto py-2">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Jadwal Ujian</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kalender Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden lg:col-span-2">
                <div class="p-4 bg-blue-600 text-white">
                    <div class="flex justify-between items-center">
                        <button class="p-1 rounded-full hover:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <h2 class="text-xl font-semibold">{{ \Carbon\Carbon::now()->format('F Y') }}</h2>
                        <button class="p-1 rounded-full hover:bg-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4">
                    <!-- Hari dalam minggu -->
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <div class="text-center text-sm font-medium text-gray-500">Min</div>
                        <div class="text-center text-sm font-medium text-gray-500">Sen</div>
                        <div class="text-center text-sm font-medium text-gray-500">Sel</div>
                        <div class="text-center text-sm font-medium text-gray-500">Rab</div>
                        <div class="text-center text-sm font-medium text-gray-500">Kam</div>
                        <div class="text-center text-sm font-medium text-gray-500">Jum</div>
                        <div class="text-center text-sm font-medium text-gray-500">Sab</div>
                    </div>

                    <!-- Tanggal-tanggal -->
                    <div class="grid grid-cols-7 gap-1">
                        @php
                            $today = \Carbon\Carbon::now();
                            $firstDayOfMonth = \Carbon\Carbon::create($today->year, $today->month, 1);
                            $lastDayOfMonth = \Carbon\Carbon::create($today->year, $today->month, $firstDayOfMonth->daysInMonth);

                            // Hari dalam minggu dari hari pertama bulan (0 = Minggu, 6 = Sabtu)
                            $firstDayOfWeek = $firstDayOfMonth->dayOfWeek;

                            // Tanggal-tanggal ujian dalam bulan ini (contoh data)
                            $examDates = collect($ujians)->map(function($ujian) {
                                return [
                                    'date' => \Carbon\Carbon::parse($ujian->waktu_mulai)->day,
                                    'type' => $ujian->mataPelajaran->nama_mapel == 'Matematika' ? 'blue' :
                                              ($ujian->nama_ujian == 'UTS' ? 'red' : 'gray'),
                                    'id' => $ujian->id
                                ];
                            })->toArray();
                        @endphp

                        <!-- Hari-hari dari bulan sebelumnya -->
                        @for ($i = 0; $i < $firstDayOfWeek; $i++)
                            @php
                                $prevMonthDay = \Carbon\Carbon::create($firstDayOfMonth)->subDays($firstDayOfWeek - $i)->day;
                            @endphp
                            <div class="h-12 text-center text-gray-400">{{ $prevMonthDay }}</div>
                        @endfor

                        <!-- Hari-hari dalam bulan ini -->
                        @for ($day = 1; $day <= $lastDayOfMonth->day; $day++)
                            @php
                                $hasExam = false;
                                $examType = 'gray';
                                $examId = null;

                                foreach ($examDates as $exam) {
                                    if ($exam['date'] == $day) {
                                        $hasExam = true;
                                        $examType = $exam['type'];
                                        $examId = $exam['id'];
                                        break;
                                    }
                                }

                                $isToday = $day == $today->day;
                            @endphp

                            <div class="h-12 p-1">
                                @if ($hasExam)
                                    <a href="{{ route('siswa.detail-ujian', $examId) }}" class="block h-full">
                                        <div class="h-full flex flex-col items-center justify-center rounded-lg bg-{{ $examType }}-50 border border-{{ $examType }}-200 cursor-pointer">
                                            <span class="text-sm font-medium text-{{ $examType }}-600">{{ $day }}</span>
                                            <div class="w-2 h-2 rounded-full bg-{{ $examType }}-500 mt-1"></div>
                                        </div>
                                    </a>
                                @else
                                    <div class="h-full flex flex-col items-center justify-center rounded-lg {{ $isToday ? 'bg-gray-100 border border-gray-300' : 'hover:bg-gray-100' }} cursor-pointer">
                                        <span class="text-sm {{ $isToday ? 'font-medium' : '' }}">{{ $day }}</span>
                                    </div>
                                @endif
                            </div>
                        @endfor

                        <!-- Hari-hari dari bulan berikutnya -->
                        @php
                            $daysShown = $firstDayOfWeek + $lastDayOfMonth->day;
                            $remainingDays = 42 - $daysShown; // 6 minggu x 7 hari = 42 total sel
                        @endphp

                        @for ($i = 1; $i <= $remainingDays; $i++)
                            <div class="h-12 text-center text-gray-400">{{ $i }}</div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Daftar Ujian Mendatang -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-4 bg-blue-600 text-white">
                    <h2 class="text-xl font-semibold">Ujian Mendatang</h2>
                </div>

                <div class="p-4 space-y-4">
                    @forelse ($ujians->where('waktu_mulai', '>=', \Carbon\Carbon::now())->sortBy('waktu_mulai')->take(5) as $ujian)
                        @php
                            $today = \Carbon\Carbon::now();
                            $examDate = \Carbon\Carbon::parse($ujian->waktu_mulai);
                            $daysUntil = $today->diffInDays($examDate, false);

                            // Style berdasarkan kedekatan waktu ujian
                            $styleClass = $daysUntil <= 3 ? 'red' : ($daysUntil <= 7 ? 'blue' : 'gray');
                        @endphp

                        <a href="{{ route('siswa.detail-ujian', $ujian->id) }}" class="block">
                            <div class="p-3 border border-{{ $styleClass }}-100 rounded-lg bg-{{ $styleClass }}-50 hover:shadow-md transition-shadow duration-200">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-{{ $styleClass }}-800">{{ $ujian->nama_ujian }}</h3>
                                        <p class="text-sm text-gray-600">{{ $ujian->mataPelajaran->nama_mapel }} - {{ $ujian->kelas->nama_kelas }}</p>
                                    </div>
                                    <span class="px-2 py-1 bg-{{ $styleClass }}-100 text-{{ $styleClass }}-800 text-xs rounded-full">
                                        {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('d M') }}
                                    </span>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($ujian->waktu_selesai)->format('H:i') }} WIB
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            <p>Tidak ada ujian yang akan datang</p>
                        </div>
                    @endforelse
                </div>

                @if ($ujians->where('waktu_mulai', '>=', \Carbon\Carbon::now())->count() > 5)
                    <div class="p-4 border-t border-gray-200 text-center">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua Jadwal</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
