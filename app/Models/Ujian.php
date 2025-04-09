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

    // Menentukan nama tabel (opsional jika nama tabel sesuai konvensi)
    protected $table = 'ujians';

    // Menentukan kolom yang dapat diisi (mass assignment)
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

    /**
     * Relasi dengan model Guru.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
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
}
