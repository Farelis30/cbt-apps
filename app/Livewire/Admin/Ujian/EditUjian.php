<?php

namespace App\Livewire\Admin\Ujian;

use App\Models\GuruProfile;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Ujian;
use Livewire\Component;

class EditUjian extends Component
{
    public $ujianId;
    public $nama_ujian;
    public $guru_id;
    public $kelas_id;
    public $mata_pelajaran_id;
    public $waktu_mulai;
    public $waktu_selesai;
    public $jumlah_soal;
    public $duration;
    public $dataUjian;

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

    public function mount($ujianId)
    {
        $this->ujianId = $ujianId;
        $this->dataUjian = Ujian::findOrFail($this->ujianId);
        $this->nama_ujian = $this->dataUjian->nama_ujian;
        $this->guru_id = $this->dataUjian->guru_id;
        $this->kelas_id = $this->dataUjian->kelas_id;
        $this->mata_pelajaran_id = $this->dataUjian->mata_pelajaran_id;
        $this->waktu_mulai = $this->dataUjian->waktu_mulai->format('Y-m-d\TH:i');
        $this->waktu_selesai = $this->dataUjian->waktu_selesai->format('Y-m-d\TH:i');
        $this->jumlah_soal = $this->dataUjian->jumlah_soal;
        $this->duration = $this->dataUjian->duration;
    }

    public function update()
    {
        $this->validate();

        $this->dataUjian->update([
            'nama_ujian' => $this->nama_ujian,
            'guru_id' => $this->guru_id,
            'kelas_id' => $this->kelas_id,
            'mata_pelajaran_id' => $this->mata_pelajaran_id,
            'waktu_mulai' => $this->waktu_mulai,
            'waktu_selesai' => $this->waktu_selesai,
            'jumlah_soal' => $this->jumlah_soal,
            'duration' => $this->duration,
        ]);

        session()->flash('message', 'Ujian berhasil diubah!');
        return redirect(route('admin.ujian.index'));
    }

    public function render()
    {
        $guru = GuruProfile::all();
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();

        return view('livewire.admin.ujian.edit-ujian', [
            'guru' => $guru,
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }
}
