<x-layouts.app>
    @section('title', 'Ujian Matematika Semester 1')
    <div class="max-w-4xl mx-auto mt-2 p-6 bg-white rounded-xl shadow-md">
        <!-- Header Ujian -->
        <div class="flex justify-between items-center mb-6 p-4 bg-blue-50 rounded-lg">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Ujian Matematika Semester 1</h2>
                <p class="text-sm text-gray-600">40 Soal • 90 Menit</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-blue-600" id="countdown">89:45</div>
                <p class="text-xs text-gray-500">Waktu tersisa</p>
            </div>
        </div>

        <!-- Progress & Navigation -->
        <div class="flex items-center justify-between mb-6">
            <div class="w-full bg-gray-200 rounded-full h-2.5 mr-4">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 25%"></div>
            </div>
            <span class="text-sm font-medium text-gray-700">10/40</span>
        </div>

        <!-- Soal -->
        <div class="mb-8 p-4 border border-gray-200 rounded-lg">
            <div class="flex justify-center">
                <div class="text-lg w-16 h-16 flex items-center justify-center font-medium text-gray-800 mb-4 bg-blue-50 p-3 rounded-full">10</div>
            </div>
            <div class="flex items-start mb-4">
                <div>
                    <p class="text-lg font-medium text-gray-800">Sebuah lingkaran memiliki jari-jari 14 cm. Berapakah luas lingkaran tersebut? (π = 22/7)</p>
                    <img src="https://roboguru-forum-cdn.ruangguru.com/bf8104e6-134c-4322-ab77-340192f8f64b.jpg" class="h-64 w-64" alt="">
                </div>
            </div>

            <!-- Opsi Jawaban -->
            <div class="space-y-3 ml-0">
                <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                    <input type="radio" name="answer" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                    <span class="text-gray-700">154 cm²</span>
                </label>
                <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                    <input type="radio" name="answer" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                    <span class="text-gray-700">308 cm²</span>
                </label>
                <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                    <input type="radio" name="answer" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                    <span class="text-gray-700">616 cm²</span>
                </label>
                <label class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-blue-50 cursor-pointer">
                    <input type="radio" name="answer" class="h-4 w-4 text-blue-600 focus:ring-blue-500">
                    <span class="text-gray-700">1,232 cm²</span>
                </label>
            </div>
        </div>

        <!-- Navigation Button -->
        <div class="flex justify-between">
            <button class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium flex items-center">
                <i class="fas fa-arrow-left"></i>
            </button>
            <div class="space-x-3">
                <button class="px-5 py-2.5 bg-blue-600 rounded-lg text-white hover:bg-blue-700 font-medium flex items-center">
                    Selanjutnya
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Daftar Soal -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Navigasi Soal</h3>
            <div class="grid grid-cols-5 md:grid-cols-10 gap-2">
                <!-- Contoh nomor soal -->
                <button class="w-10 h-10 rounded-full bg-blue-100 text-blue-800 font-medium flex items-center justify-center">1</button>
                <button class="w-10 h-10 rounded-full bg-gray-100 text-gray-800 font-medium flex items-center justify-center">2</button>
                <button class="w-10 h-10 rounded-full bg-gray-100 text-gray-800 font-medium flex items-center justify-center">3</button>
                <button class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-800 font-medium flex items-center justify-center">4</button>
                <button class="w-10 h-10 rounded-full bg-gray-100 text-gray-800 font-medium flex items-center justify-center">5</button>
                <button class="w-10 h-10 rounded-full bg-green-100 text-green-800 font-medium flex items-center justify-center">6</button>
                <button class="w-10 h-10 rounded-full bg-gray-100 text-gray-800 font-medium flex items-center justify-center">7</button>
                <button class="w-10 h-10 rounded-full bg-gray-100 text-gray-800 font-medium flex items-center justify-center">8</button>
                <button class="w-10 h-10 rounded-full bg-gray-100 text-gray-800 font-medium flex items-center justify-center">9</button>
                <button class="w-10 h-10 rounded-full bg-blue-600 text-white font-medium flex items-center justify-center">10</button>
                <!-- ... dan seterusnya sampai 40 -->
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
        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        window.onload = function () {
            const fiveMinutes = 60 * 90; // 90 menit
            const display = document.querySelector('#countdown');
            startTimer(fiveMinutes, display);
        };
    </script>
</x-layouts.app>
