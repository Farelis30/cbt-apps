<?php

namespace App\Livewire\Admin\Kelas;

use Livewire\Component;
use App\Models\Kelas;

class CreateKelas extends Component
{
    public $kelas;

    protected $rules = [
        'kelas' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        Kelas::create([
            'kelas' => $this->kelas
        ]);

        session()->flash('message', 'Kelas berhasil ditambahkan!');
        return redirect(route('admin.kelas.index'));
    }

    public function render()
    {
        return view('livewire.admin.kelas.create-kelas');
    }
}
