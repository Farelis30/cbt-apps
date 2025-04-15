<?php

namespace App\Livewire\Guru;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public $nama_lengkap, $kelas, $mata_pelajaran;
    public $guru;

    public function mount()
    {
        $this->user = Auth::user();

        $guru = $this->user->guruProfile;

        $this->guru = $guru;

        $this->nama_lengkap = $guru?->nama_lengkap ?? '-';
        $this->kelas = $guru?->kelas?->kelas ?? '-';
        $this->mata_pelajaran = $guru?->mata_pelajaran?->nama_mapel ?? '-';
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.guru.dashboard');
    }
}
