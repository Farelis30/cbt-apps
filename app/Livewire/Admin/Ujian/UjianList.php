<?php

namespace App\Livewire\Admin\Ujian;

use App\Models\Ujian;
use Livewire\Component;

class UjianList extends Component
{
    public function delete($id)
    {
        $ujian = Ujian::find($id);
        $ujian->delete();

        $this->dispatch('ujian-deleted', message: 'Ujian berhasil dihapus!');
    }

    public function render()
    {
        $ujians = Ujian::with(['guru', 'kelas', 'mataPelajaran'])->get();

        return view('livewire.admin.ujian.ujian-list', [
            'ujians' => $ujians
        ]);
    }
}
