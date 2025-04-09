<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiswaProfile;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'kelas',
    ];

    public function siswaProfile()
    {
        return $this->hasMany(SiswaProfile::class);
    }
}
