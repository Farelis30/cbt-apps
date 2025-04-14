<?php

namespace App\Livewire\Admin\Ujian;

use App\Models\GuruProfile;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ujian;
use Livewire\Component;

class CreateUjian extends Component
{
    public $nama_ujian;
    public $guru_id;
    public $kelas_id;
    public $mata_pelajaran_id;
    public $waktu_mulai;
    public $waktu_selesai;
    public $jumlah_soal;
    public $duration;

    protected $rules = [
        'nama_ujian' => 'required|string',
        'guru_id' => 'required|exists:guru_profiles,id',
        'kelas_id' => 'required|exists:kelas,id',
        'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
        'waktu_mulai' => 'required|date',
        'waktu_selesai' => 'required|date|after:waktu_mulai',
        'jumlah_soal' => 'required|integer|min:1',
        'duration' => 'required|integer|min:1',
    ];

    public function save()
    {
        $this->validate();

        Ujian::create([
            'nama_ujian' => $this->nama_ujian,
            'guru_id' => $this->guru_id,
            'kelas_id' => $this->kelas_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'jumlah_soal' => $this->jumlah_soal,
            'duration' => $this->duration,
        ]);

        session()->flash('message', 'Ujian berhasil ditambahkan!');
        return redirect(route('admin.ujian.index'));
    }

    public function render()
    {
        $guru = GuruProfile::all();
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();

        return view('livewire.admin.ujian.create-ujian', [
            'guru' => $guru,
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }
}
