<?php

namespace App\Livewire\Siswa;

use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        $ujian = "ujian";
        return view('livewire.siswa.home',
            [
                'ujian' => $ujian
            ]);
    }
}
