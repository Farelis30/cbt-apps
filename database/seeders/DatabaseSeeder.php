<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $romawi = ['I', 'II', 'III', 'IV', 'V', 'VI'];

        // Menambahkan data ke tabel kelas
        foreach ($romawi as $kelas) {
            DB::table('kelas')->insert([
                'kelas' => $kelas,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $mapel = [
            'Agama Islam',
            'PKN',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Matematika',
            'IPA',
            'IPS',
            'Seni Budaya',
            'PJOK',
        ];

        // Menambahkan data ke tabel mapel
        foreach ($mapel as $m) {
            DB::table('mata_pelajarans')->insert([
                'nama_mapel' => $m,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        User::factory()->create([
            'username' => 'User',
            'email' => 'xG7H5@example.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'username' => 'Admin',
            'email' => 'tN8l0@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'username' => 'Guru',
            'email' => 'lTt8l@example.com',
            'password' => 'password',
            'role' => 'guru',
        ]);
    }
}
