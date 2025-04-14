<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'ujian_id',
        'nilai',
        'tanggal_ujian',
        'status'
    ];

    protected $casts = [
        'tanggal_ujian' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaProfile::class, 'siswa_id');
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
