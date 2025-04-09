<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AdminProfile extends Model
{
    protected $table = 'admin_profiles';

    protected $fillable = [
        'nama_lengkap',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
