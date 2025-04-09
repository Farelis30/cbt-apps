<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class GuruProfile extends Model
{
    protected $table = 'guru_profiles';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'image',
        'kelas_id',
        'mata_pelajaran_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
