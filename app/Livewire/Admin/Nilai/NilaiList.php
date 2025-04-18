<?php

namespace App\Livewire\Admin\Nilai;

use Livewire\Component;
use App\Models\Nilai;
use App\Models\Ujian;
use App\Models\SiswaProfile;
use App\Models\Kelas;
use Livewire\WithPagination;

class NilaiList extends Component
{
    use WithPagination;

    public $search = '';
    public $ujianFilter = '';
    public $kelasFilter = '';
    public $nilaiMin = '';
    public $nilaiMax = '';
    public $tanggalMulai = '';
    public $tanggalSelesai = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'ujianFilter' => ['except' => ''],
        'kelasFilter' => ['except' => ''],
        'nilaiMin' => ['except' => ''],
        'nilaiMax' => ['except' => ''],
        'tanggalMulai' => ['except' => ''],
        'tanggalSelesai' => ['except' => '']
    ];

    public function resetFilters()
    {
        $this->reset(['search', 'ujianFilter', 'kelasFilter', 'nilaiMin', 'nilaiMax', 'tanggalMulai', 'tanggalSelesai']);
    }

    public function delete($id)
    {
        $nilai = Nilai::find($id);
        $nilai->delete();

        $this->dispatch('nilai-deleted', [
            'message' => 'Data nilai berhasil dihapus!'
        ]);
    }

    public function render()
    {
        $ujians = Ujian::all();
        $kelas = Kelas::all();

        $nilaiQuery = Nilai::query()
            ->with(['siswa', 'siswa.kelas', 'ujian'])
            ->join('siswa_profiles', 'nilais.siswa_id', '=', 'siswa_profiles.id')
            ->join('ujians', 'nilais.ujian_id', '=', 'ujians.id')
            ->select('nilais.*');

        if ($this->search) {
            $nilaiQuery->where(function($query) {
                $query->where('siswa_profiles.nama', 'like', '%' . $this->search . '%')
                    ->orWhere('siswa_profiles.nis', 'like', '%' . $this->search . '%')
                    ->orWhere('ujians.judul', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->ujianFilter) {
            $nilaiQuery->where('nilais.ujian_id', $this->ujianFilter);
        }

        if ($this->kelasFilter) {
            $nilaiQuery->where('siswa_profiles.kelas_id', $this->kelasFilter);
        }

        if ($this->nilaiMin !== '') {
            $nilaiQuery->where('nilais.nilai', '>=', $this->nilaiMin);
        }

        if ($this->nilaiMax !== '') {
            $nilaiQuery->where('nilais.nilai', '<=', $this->nilaiMax);
        }

        if ($this->tanggalMulai) {
            $nilaiQuery->whereDate('nilais.tanggal_ujian', '>=', $this->tanggalMulai);
        }

        if ($this->tanggalSelesai) {
            $nilaiQuery->whereDate('nilais.tanggal_ujian', '<=', $this->tanggalSelesai);
        }

        $nilais = $nilaiQuery->orderBy('nilais.created_at', 'desc')->paginate(10);

        return view('livewire.admin.nilai.nilai-list', [
            'nilais' => $nilais,
            'ujians' => $ujians,
            'kelas' => $kelas
        ]);
    }
}
