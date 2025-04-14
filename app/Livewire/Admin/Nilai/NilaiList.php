<?php

namespace App\Livewire\Admin\Nilai;

use App\Models\Ujian;
use Livewire\Component;

class NilaiList extends Component
{
    public function render()
    {
        $ujians = Ujian::with(['kelas', 'mataPelajaran'])->get();

        return view('livewire.admin.ujian.nilai-list', [
            'ujians' => $ujians
        ]);
    }
}
