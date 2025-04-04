<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaProfile extends Model
{
    use HasFactory;

    protected $table = 'siswa_profiles';

    protected $fillable = [
        'user_id',
        'nisn',
        'nama_lengkap',
        'kelas_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
