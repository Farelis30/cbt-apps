<?php

namespace App\Imports;

use App\Models\User;
use App\Models\GuruProfile;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class TeacherImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Create user account first
        $user = User::create([
            'username' => $row['username'],
            'email' => $row['email'],
            'password' => Hash::make($row['username']), // Using username as default password
            'role' => 'guru',
        ]);

        // Then create the teacher profile
        return new GuruProfile([
            'user_id' => $user->id,
            'nama_lengkap' => $row['nama_lengkap'],
            'kelas_id' => $row['kelas_id'],
            'mata_pelajaran_id' => $row['mata_pelajaran_id'],
        ]);
    }

    // Validation rules
    public function rules(): array
    {
        return [
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nama_lengkap' => ['required'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
        ];
    }
}
