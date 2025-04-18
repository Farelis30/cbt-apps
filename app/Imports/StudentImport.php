<?php

namespace App\Imports;

use App\Models\User;
use App\Models\SiswaProfile;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Str;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Create user account first
        $user = User::create([
            'username' => $row['username'],
            'email' => $row['email'],
            'password' => Hash::make($row['nisn']), // Using NISN as default password
            'role' => 'siswa',
        ]);

        // Then create the student profile
        return new SiswaProfile([
            'user_id' => $user->id,
            'nisn' => $row['nisn'],
            'nama_lengkap' => $row['nama_lengkap'],
            'kelas_id' => $row['kelas_id'],
        ]);
    }

    // Validation rules
    public function rules(): array
    {
        return [
            'username' => ['required', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nisn' => ['required', 'unique:siswa_profiles,nisn'],
            'nama_lengkap' => ['required'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ];
    }
}
