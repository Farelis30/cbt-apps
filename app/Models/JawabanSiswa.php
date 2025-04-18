<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'ujian_id',
        'soal_id',
        'jawaban',
        'is_correct',
        'skor'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaProfile::class, 'siswa_id');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
