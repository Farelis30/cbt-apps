<?php

namespace App\Livewire\Admin\Nilai;

use Livewire\Component;
use App\Models\Nilai;
use App\Models\JawabanSiswa;
use App\Models\Soal;

class JawabanSiswaList extends Component
{
    public $nilaiId;
    public $nilai;
    public $jawabans;
    public $soalFilter = '';
    public $statusFilter = '';

    public function mount($nilaiId)
    {
        $this->nilaiId = $nilaiId;
        $this->nilai = Nilai::with(['siswa', 'ujian', 'ujian.mapel'])->findOrFail($nilaiId);
        $this->loadJawabans();
    }

    public function loadJawabans()
    {
        $query = JawabanSiswa::with(['soal'])
            ->where('siswa_id', $this->nilai->siswa_id)
            ->where('ujian_id', $this->nilai->ujian_id);

        if ($this->soalFilter) {
            $query->where('soal_id', $this->soalFilter);
        }

        if ($this->statusFilter !== '') {
            $query->where('is_correct', $this->statusFilter);
        }

        $this->jawabans = $query->get();
    }

    public function updatedSoalFilter()
    {
        $this->loadJawabans();
    }

    public function updatedStatusFilter()
    {
        $this->loadJawabans();
    }

    public function resetFilters()
    {
        $this->soalFilter = '';
        $this->statusFilter = '';
        $this->loadJawabans();
    }

    public function render()
    {
        $soals = Soal::where('ujian_id', $this->nilai->ujian_id)->get();

        return view('livewire.admin.nilai.jawaban-siswa-list', [
            'soals' => $soals
        ]);
    }
}
