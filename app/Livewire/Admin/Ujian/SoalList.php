<?php

namespace App\Livewire\Admin\Ujian;

use App\Models\Soal;
use App\Models\Ujian;
use Livewire\Component;

class SoalList extends Component
{
    public $ujianId;

    public function mount($ujianId)
    {
        $this->ujianId = $ujianId;
    }

    public function delete($id)
    {
        $soal = Soal::find($id);
        $soal->delete();

        $this->dispatch('soal-deleted', message: 'Soal berhasil dihapus!');
    }

    public function render()
    {
        $ujian = Ujian::with(['kelas', 'mataPelajaran'])->findOrFail($this->ujianId);
        $soal = Soal::where('ujian_id', $this->ujianId)->get();

        return view('livewire.admin.ujian.soal-list', [
            'ujian' => $ujian,
            'soal' => $soal
        ]);
    }
}
