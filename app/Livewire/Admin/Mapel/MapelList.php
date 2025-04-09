<?php

namespace App\Livewire\Admin\Mapel;

use Livewire\Component;
use App\Models\MataPelajaran;

class MapelList extends Component
{
    public function delete($id)
    {
        $mapel = MataPelajaran::find($id);
        $mapel->delete();
    }

    public function render()
    {
        $mapel = MataPelajaran::all();
        return view('livewire.admin.mapel.mapel-list', [
            'mapel' => $mapel
        ]);
    }
}
