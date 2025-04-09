<?php

namespace App\Livewire\Admin\Mapel;

use Livewire\Component;
use App\Models\MataPelajaran;

class EditMapel extends Component
{
    public $mapelId;
    public $nama_mapel;
    public $mapel;

    protected $rules = [
        'nama_mapel' => 'required|string',
    ];

    public function mount($mapelId)
    {
        $this->mapelId = $mapelId;
        $this->mapel = MataPelajaran::findOrFail($this->mapelId);
        $this->nama_mapel = $this->mapel->nama_mapel;
    }

    public function update()
    {
        $this->validate();

        $this->mapel->update([
            'nama_mapel' => $this->nama_mapel
        ]);

        session()->flash('message', 'Mata Pelajaran berhasil diubah!');
        return redirect(route('admin.mapel.index'));
    }

    public function render()
    {
        return view('livewire.admin.mapel.edit-mapel');
    }
}
