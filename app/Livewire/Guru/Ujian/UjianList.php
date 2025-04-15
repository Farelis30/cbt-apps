<?php

namespace App\Livewire\Guru\Ujian;

use Livewire\Component;
use App\Models\Ujian;
use Illuminate\Support\Facades\Auth;

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
        // ambil data ujian berdasarkan guru yang login
        $ujians = Ujian::with(['guru', 'kelas', 'mataPelajaran'])->where('guru_id', Auth::user()->guruProfile->id)->get();

        return view('livewire.guru.ujian.ujian-list', [
            'ujians' => $ujians
        ]);
    }
}
