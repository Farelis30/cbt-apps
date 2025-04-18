<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujians';

    protected $fillable = [
        'nama_ujian',
        'guru_id',
        'kelas_id',
        'mata_pelajaran_id',
        'waktu_mulai',
        'waktu_selesai',
        'jumlah_soal',
        'duration',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    /**
     * Relasi dengan model Guru.
     */
    public function guru()
    {
        return $this->belongsTo(GuruProfile::class, 'guru_id');
    }

    /**
     * Relasi dengan model Kelas.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Relasi dengan model MataPelajaran.
     */
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
