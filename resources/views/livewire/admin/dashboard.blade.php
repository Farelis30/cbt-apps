<div>
    <x-layouts.admin>
        @section('title', 'Dashboard Admin')
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class=" text-3xl text-gray-800 leading-tight">
                    {{ __('Dashboard Admin') }}
                </h2>
            </div>
        </x-slot>

        @if ($showWelcomeMessage)
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 5000)"
                 class="p-4 mb-4 bg-green-500 text-white rounded-md shadow-lg">
                <span>Selamat datang {{ Auth::user()->username }}, Anda login pada {{ now()->format('d-m-Y H:i:s') }} sebagai {{ Auth::user()->role }}</span>
            </div>
        @endif

        <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $dashboardItems = [
                        ['route' => 'dashboard', 'color' => 'blue', 'label' => 'Admin', 'icon' => 'user-shield', 'count' => \App\Models\User::where('role', 'admin')->count()],
                        ['route' => 'siswa', 'color' => 'blue', 'label' => 'Siswa', 'icon' => 'user-graduate', 'count' => \App\Models\SiswaProfile::count()],
                        ['route' => 'guru', 'color' => 'blue', 'label' => 'Guru', 'icon' => 'chalkboard-teacher', 'count' => \App\Models\GuruProfile::count()],
                        ['route' => 'kelas', 'color' => 'blue', 'label' => 'Kelas', 'icon' => 'building', 'count' => \App\Models\Kelas::count()],
                        ['route' => 'ujian', 'color' => 'blue', 'label' => 'Ujian', 'icon' => 'file-alt', 'count' => \App\Models\Ujian::count()],
                        ['route' => 'mapel', 'color' => 'blue', 'label' => 'Mata Pelajaran', 'icon' => 'book', 'count' => \App\Models\MataPelajaran::count()],
                    ];
                @endphp

                @foreach ($dashboardItems as $item)
                    <a href="/admin/{{ $item['route'] }}" wire:navigate class="w-full px-2 mb-4 hover:scale-105 hover:-translate-y-1 transition-all">
                        <div class="bg-white hover:bg-gray-100 border-l-4 border-{{ $item['color'] }}-500 shadow-md rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-{{ $item['color'] }}-600 uppercase mb-1">
                                        {{ $item['label'] }}
                                    </div>
                                    <div class="text-xl font-bold text-gray-800">
                                        {{ $item['count'] }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <i class="fas fa-{{ $item['icon'] }} fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </x-layouts.admin>
</div>
