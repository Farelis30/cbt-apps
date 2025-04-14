<?php

namespace App\Livewire\Admin\Ujian;

use App\Models\Soal;
use App\Models\Ujian;
use Livewire\Component;

class EditSoal extends Component
{
    public $ujianId;
    public $soalId;
    public $pertanyaan;
    public $pilihan_a;
    public $pilihan_b;
    public $pilihan_c;
    public $pilihan_d;
    public $jawaban_benar;
    public $bobot;
    public $dataSoal;

    protected $rules = [
        'pertanyaan' => 'required|string',
        'pilihan_a' => 'required|string',
        'pilihan_b' => 'required|string',
        'pilihan_c' => 'required|string',
        'pilihan_d' => 'required|string',
        'jawaban_benar' => 'required|in:A,B,C,D',
        'bobot' => 'required|integer|min:1'
    ];

    public function mount($ujianId, $soalId)
    {
        $this->ujianId = $ujianId;
        $this->soalId = $soalId;
        $this->dataSoal = Soal::findOrFail($this->soalId);

        $this->pertanyaan = $this->dataSoal->pertanyaan;
        $this->pilihan_a = $this->dataSoal->pilihan_a;
        $this->pilihan_b = $this->dataSoal->pilihan_b;
        $this->pilihan_c = $this->dataSoal->pilihan_c;
        $this->pilihan_d = $this->dataSoal->pilihan_d;
        $this->jawaban_benar = $this->dataSoal->jawaban_benar;
        $this->bobot = $this->dataSoal->bobot;
    }

    public function update()
    {
        $this->validate();

        $this->dataSoal->update([
            'pertanyaan' => $this->pertanyaan,
            'pilihan_a' => $this->pilihan_a,
            'pilihan_b' => $this->pilihan_b,
            'pilihan_c' => $this->pilihan_c,
            'pilihan_d' => $this->pilihan_d,
            'jawaban_benar' => $this->jawaban_benar,
            'bobot' => $this->bobot
        ]);

        session()->flash('message', 'Soal berhasil diubah!');
        return redirect(route('admin.ujian.soal', $this->ujianId));
    }

    public function render()
    {
        $ujian = Ujian::with(['kelas', 'mataPelajaran'])->findOrFail($this->ujianId);

        return view('livewire.admin.ujian.edit-soal', [
            'ujian' => $ujian
        ]);
    }
}
