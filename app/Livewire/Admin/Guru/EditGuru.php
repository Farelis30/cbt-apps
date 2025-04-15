<?php

namespace App\Livewire\Admin\Guru;

use App\Models\GuruProfile;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EditGuru extends Component
{
    public $guruId;
    public $nama_lengkap, $kelas_id, $mata_pelajaran_id, $username, $email, $password;

    protected $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'kelas_id' => 'required|exists:kelas,id',
        'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ];

    protected function getUser()
    {
        return GuruProfile::findOrFail($this->guruId)->user;
    }

    public function mount($guruId)
    {
        $guru = GuruProfile::findOrFail($guruId);
        $this->guruId = $guru->id;
        $this->nama_lengkap = $guru->nama_lengkap;
        $this->kelas_id = $guru->kelas_id;
        $this->mata_pelajaran_id = $guru->mata_pelajaran_id;
        $this->username = $guru->user->username;
        $this->email = $guru->user->email;
    }

    public function update()
    {
        $this->validate();

        $guruProfile = GuruProfile::findOrFail($this->guruId);
        $user = $guruProfile->user;

        // Update data user
        $user->update([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
            'role' => 'guru',
        ]);

        // Update profil guru
        $guruProfile->update([
            'nama_lengkap' => $this->nama_lengkap,
            'kelas_id' => $this->kelas_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
        ]);

        session()->flash('message', 'Data guru berhasil diperbarui!');
        return redirect()->route('admin.guru.index');
    }

    public function render()
    {
        return view('livewire.admin.guru.edit-guru', [
            'kelas' => Kelas::all(),
            'mata_pelajaran' => MataPelajaran::all(),
        ]);
    }
}
