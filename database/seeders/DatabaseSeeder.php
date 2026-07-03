<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        // Create sample mahasiswa - 1 per jurusan
        \App\Models\Mahasiswa::create([
            'nim' => '11524001',
            'nama' => 'Tiara',
            'email' => 'tiara@student.ac.id',
            'program_studi' => 'sistem informasi',
            'semester' => 5,
        ]);

        \App\Models\Mahasiswa::create([
            'nim' => '11524002',
            'nama' => 'Imam',
            'email' => 'imam@student.ac.id',
            'program_studi' => 'teknologi informasi',
            'semester' => 3,
        ]);

        \App\Models\Mahasiswa::create([
            'nim' => '11524003',
            'nama' => 'Mulki',
            'email' => 'mulki@student.ac.id',
            'program_studi' => 'teknik informatika',
            'semester' => 7,
        ]);
    }
}
