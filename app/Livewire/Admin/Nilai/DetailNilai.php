<?php

namespace App\Livewire\Admin\Nilai;

use App\Models\Nilai;
use App\Models\SiswaProfile;
use App\Models\Ujian;
use Livewire\Component;

class DetailNilai extends Component
{
    public $ujianId;

    public function mount($ujianId)
    {
        $this->ujianId = $ujianId;
    }

    public function render()
    {
        $ujian = Ujian::with(['kelas', 'mataPelajaran'])->findOrFail($this->ujianId);
        $nilai = Nilai::with('siswa')
                    ->where('ujian_id', $this->ujianId)
                    ->get();

        // Ambil siswa yang belum mengikuti ujian
        $siswaIds = $nilai->pluck('siswa_id')->toArray();
        $belumUjian = SiswaProfile::with('user')
                    ->where('kelas_id', $ujian->kelas_id)
                    ->whereNotIn('id', $siswaIds)
                    ->get();

        return view('livewire.admin.ujian.detail-nilai', [
            'ujian' => $ujian,
            'nilai' => $nilai,
            'belumUjian' => $belumUjian
        ]);
    }
}
