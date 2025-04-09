<?php

namespace App\Livewire\Admin\Mapel;

use Livewire\Component;
use App\Models\MataPelajaran;

class CreateMapel extends Component
{
    public $nama_mapel;

    protected $rules = [
        'nama_mapel' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        MataPelajaran::create([
            'nama_mapel' => $this->nama_mapel
        ]);

        session()->flash('message', 'Mapel berhasil ditambahkan!');
        return redirect(route('admin.mapel.index'));
    }

    public function render()
    {
        return view('livewire.admin.mapel.create-mapel');
    }
}
