<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SoalImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $ujianId;

    public function __construct($ujianId)
    {
        $this->ujianId = $ujianId;
    }

    public function model(array $row)
    {
        return new Soal([
            'ujian_id' => $this->ujianId,
            'pertanyaan' => $row['pertanyaan'],
            'pilihan_a' => $row['pilihan_a'],
            'pilihan_b' => $row['pilihan_b'],
            'pilihan_c' => $row['pilihan_c'],
            'pilihan_d' => $row['pilihan_d'],
            'jawaban_benar' => $row['jawaban_benar'],
            'bobot' => $row['bobot'],
        ]);
    }

    public function rules(): array
    {
        return [
            'pertanyaan' => ['required'],
            'pilihan_a' => ['required'],
            'pilihan_b' => ['required'],
            'pilihan_c' => ['required'],
            'pilihan_d' => ['required'],
            'jawaban_benar' => ['required'],
            'bobot' => ['required'],
        ];
    }
}
