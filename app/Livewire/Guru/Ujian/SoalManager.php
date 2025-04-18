<?php

namespace App\Livewire\Guru\Ujian;

use App\Models\Soal;
use App\Models\Ujian;
use Livewire\Component;

class SoalManager extends Component
{
    public $ujianId;
    public $soalId;
    public $showForm = false;
    public $isEditing = false;

    // Form properties
    public $pertanyaan;
    public $pilihan_a;
    public $pilihan_b;
    public $pilihan_c;
    public $pilihan_d;
    public $jawaban_benar;
    public $bobot = 1;

    protected $rules = [
        'pertanyaan' => 'required|string',
        'pilihan_a' => 'required|string',
        'pilihan_b' => 'required|string',
        'pilihan_c' => 'required|string',
        'pilihan_d' => 'required|string',
        'jawaban_benar' => 'required|in:A,B,C,D',
        'bobot' => 'required|integer|min:1'
    ];

    protected $listeners = ['soalDeleted' => '$refresh'];

    public function mount($ujianId)
    {
        $this->ujianId = $ujianId;
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->reset(['pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar', 'soalId']);
            $this->bobot = 1;
            $this->isEditing = false;
        }
    }

    public function editSoal($soalId)
    {
        $this->isEditing = true;
        $this->soalId = $soalId;
        $soal = Soal::findOrFail($soalId);

        $this->pertanyaan = $soal->pertanyaan;
        $this->pilihan_a = $soal->pilihan_a;
        $this->pilihan_b = $soal->pilihan_b;
        $this->pilihan_c = $soal->pilihan_c;
        $this->pilihan_d = $soal->pilihan_d;
        $this->jawaban_benar = $soal->jawaban_benar;
        $this->bobot = $soal->bobot;

        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $soal = Soal::findOrFail($this->soalId);
            $soal->update([
                'pertanyaan' => $this->pertanyaan,
                'pilihan_a' => $this->pilihan_a,
                'pilihan_b' => $this->pilihan_b,
                'pilihan_c' => $this->pilihan_c,
                'pilihan_d' => $this->pilihan_d,
                'jawaban_benar' => $this->jawaban_benar,
                'bobot' => $this->bobot
            ]);

            $this->dispatch('notify', message: 'Soal berhasil diperbarui!');
        } else {
            Soal::create([
                'ujian_id' => $this->ujianId,
                'pertanyaan' => $this->pertanyaan,
                'pilihan_a' => $this->pilihan_a,
                'pilihan_b' => $this->pilihan_b,
                'pilihan_c' => $this->pilihan_c,
                'pilihan_d' => $this->pilihan_d,
                'jawaban_benar' => $this->jawaban_benar,
                'bobot' => $this->bobot
            ]);

            $this->dispatch('notify', message: 'Soal berhasil ditambahkan!');
        }

        $this->reset(['pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'jawaban_benar', 'soalId']);
        $this->bobot = 1;
        $this->isEditing = false;
        $this->showForm = false;
    }

    public function delete($id)
    {
        $soal = Soal::find($id);
        $soal->delete();

        $this->dispatch('notify', message: 'Soal berhasil dihapus!');
    }

    public function render()
    {
        $ujian = Ujian::with(['kelas', 'mataPelajaran'])->findOrFail($this->ujianId);
        $soal = Soal::where('ujian_id', $this->ujianId)->get();

        return view('livewire.guru.ujian.soal-manager', [
            'ujian' => $ujian,
            'soal' => $soal
        ]);
    }
}
