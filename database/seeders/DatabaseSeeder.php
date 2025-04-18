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

        $siswa = User::factory()->create([
            'username' => 'Alfarel',
            'email' => 'farelyudistira01@gmail.com',
            'password' => 'password',
        ]);

        DB::table('siswa_profiles')->insert([
            'user_id' => $siswa->id,
            'nisn' => '20210801037',
            'nama_lengkap' => 'Muhammad Alfarel Yudistira',
            'kelas_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory()->create([
            'username' => 'Admin',
            'email' => 'tN8l0@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $guru = User::factory()->create([
            'username' => 'Mega',
            'email' => 'mega@gmail.com',
            'password' => 'password',
            'role' => 'guru',
        ]);

        DB::table('guru_profiles')->insert([
            'user_id' => $guru->id,
            'nama_lengkap' => 'Mega Rosalinda Gultom',
            'kelas_id' => 1,
            'mata_pelajaran_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
