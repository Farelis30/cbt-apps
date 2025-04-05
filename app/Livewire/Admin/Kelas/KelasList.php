<?php

namespace App\Livewire\Admin\Kelas;

use Livewire\Component;
use App\Models\Kelas;

class KelasList extends Component
{

    public function delete($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
    }

    public function render()
    {
        $kelas = Kelas::all();

        return view('livewire.admin.kelas.kelas-list', [
            'kelas' => $kelas
        ]);
    }
}
