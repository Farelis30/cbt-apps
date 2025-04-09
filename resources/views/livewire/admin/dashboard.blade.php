<div>
    <x-layouts.admin>
        @section('title', 'Dashboard Admin')
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
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
            Dashboard Admin
        </div>
    </x-layouts.admin>
</div>
