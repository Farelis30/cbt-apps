<?php

namespace App\Livewire\Admin\Siswa;

use App\Models\Kelas;
use App\Models\SiswaProfile;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditSiswa extends Component
{
    public $siswaId;
    public $nama_lengkap, $nisn, $kelas_id, $username, $email, $password;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'nisn' => 'required',
        'kelas_id' => 'required|exists:kelas,id',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ];

    protected function getUser()
    {
        return SiswaProfile::findOrFail($this->siswaId)->user;
    }

    public function mount($siswaId)
    {
        $siswa = SiswaProfile::findOrFail($siswaId);
        $this->siswaId = $siswa->id;
        $this->nama_lengkap = $siswa->nama_lengkap;
        $this->nisn = $siswa->nisn;
        $this->kelas_id = $siswa->kelas_id;
        $this->username = $siswa->user->username;
        $this->email = $siswa->user->email;
    }

    public function update()
    {
        $this->validate();

        $siswaProfile = SiswaProfile::findOrFail($this->siswaId);
        $user = $siswaProfile->user;

        $user->update([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
            'role' => 'siswa',
        ]);

        $siswaProfile->update([
            'nama_lengkap' => $this->nama_lengkap,
            'nisn' => $this->nisn,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Data siswa berhasil diperbarui!');
        return redirect()->route('admin.siswa.index');
    }

    public function render()
    {
        return view('livewire.admin.siswa.edit-siswa', [
            'kelas' => Kelas::all(),
        ]);
    }
}
