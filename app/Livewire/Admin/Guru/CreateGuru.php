<?php

namespace App\Livewire\Admin\Guru;

use Livewire\Component;
use App\Models\GuruProfile;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class CreateGuru extends Component
{
    public $nama_lengkap, $kelas_id, $username, $email, $password;

    // Menentukan validasi untuk setiap input
    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ];

    /**
     * Simpan guru baru dan user terkait.
     */
    public function save()
    {
        $this->validate(); // Validasi input terlebih dahulu

        // Buat user baru untuk guru
        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'guru',
        ]);

        // Buat profil guru
        GuruProfile::create([
            'user_id' => $user->id,
            'nama_lengkap' => $this->nama_lengkap,
            'kelas_id' => $this->kelas_id,
        ]);

        // Tampilkan pesan sukses
        session()->flash('message', 'Guru berhasil ditambahkan!');

        // Redirect ke halaman daftar guru
        return redirect(route('admin.guru.index'));
    }

    /**
     * Render tampilan create guru.
     */
    public function render()
    {
        // Ambil data kelas untuk dropdown
        $kelas = Kelas::all();

        return view('livewire.admin.guru.create-guru', [
            'kelas' => $kelas,
        ]);
    }
}
