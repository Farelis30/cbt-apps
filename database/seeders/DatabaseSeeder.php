<?php

namespace Database\Seeders;

use App\Models\User;
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
