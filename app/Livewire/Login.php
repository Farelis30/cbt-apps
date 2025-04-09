<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;
    public $remember = false;

    protected $rules = [
        'username' => 'required|string',
        'password' => 'required|string|min:6',
    ];

    public function login()
    {
        $this->validate();

        $credentials = [
            'username' => $this->username,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            session()->flash('welcome_message', true);

            $user = Auth::user();
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'guru' => redirect()->route('guru.dashboard'),
                default => redirect()->route('siswa.home'),
            };
        }

        $this->addError('username', 'Username atau password salah');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
