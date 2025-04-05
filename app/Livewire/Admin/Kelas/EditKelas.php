<?php

namespace App\Livewire\Admin\Kelas;

use Livewire\Component;
use App\Models\Kelas;

class EditKelas extends Component
{

    public $kelasId;
    public $kelas;
    public $dataKelas;

    protected $rules = [
        'kelas' => 'required|string',
    ];

    public function mount($kelasId)
    {
        $this->kelasId = $kelasId;
        $this->dataKelas = Kelas::findOrFail($this->kelasId);
        $this->kelas = $this->dataKelas->kelas;
    }

    public function update()
    {
        $this->validate();

        $this->dataKelas->update([
            'kelas' => $this->kelas
        ]);

        session()->flash('message', 'Kelas berhasil diubah!');
        return redirect(route('admin.kelas.index'));
    }

    public function render()
    {
        return view('livewire.admin.kelas.edit-kelas');
    }
}
