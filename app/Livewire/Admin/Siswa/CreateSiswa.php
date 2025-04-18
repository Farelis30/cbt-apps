<?php

namespace App\Livewire\Admin\Siswa;

use Livewire\Component;
use App\Models\SiswaProfile;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class CreateSiswa extends Component
{
    public $nisn, $nama_lengkap, $kelas_id, $username, $email, $password;

    // Menentukan validasi untuk setiap input
    protected $rules = [
        'nisn' => 'required|unique:siswa_profiles,nisn',
        'nama_lengkap' => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
    ];

    /**
     * Simpan siswa baru dan user terkait.
     */
    public function save()
    {
        $this->validate(); // Validasi input terlebih dahulu

        // Buat user baru untuk siswa
        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'siswa',
        ]);

        // Buat profil siswa
        SiswaProfile::create([
            'user_id' => $user->id,
            'nisn' => $this->nisn,
            'nama_lengkap' => $this->nama_lengkap,
            'kelas_id' => $this->kelas_id,
        ]);

        // Tampilkan pesan sukses
        session()->flash('message', 'Siswa berhasil ditambahkan!');

        // Redirect ke halaman daftar siswa
        return redirect(route('admin.siswa.index'));
    }

    /**
     * Render tampilan create siswa.
     */
    public function render()
    {
        // Ambil data kelas untuk dropdown
        $kelas = Kelas::all();

        return view('livewire.admin.siswa.create-siswa', [
            'kelas' => $kelas,
        ]);
    }
}
