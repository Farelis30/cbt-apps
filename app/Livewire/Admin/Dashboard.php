<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    public $showWelcomeMessage = false;

    public function mount()
    {
        // Cek jika ada session flash welcome_message
        if (session('welcome_message')) {
            $this->showWelcomeMessage = true;
            // Hapus session setelah digunakan
            session()->forget('welcome_message');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
