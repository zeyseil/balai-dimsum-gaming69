<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder untuk user admin
        Pengguna::create([
            'username' => 'admin',
            'password' => '123456',
            'role' => 'admin',
        ]);

        // Seeder untuk user manager
        Pengguna::create([
            'username' => 'manager',
            'password' => '123456',
            'role' => 'manager',
        ]);

        // Seeder untuk user karyawan
        Pengguna::create([
            'username' => 'karyawan',
            'password' => '123456',
            'role' => 'karyawan',
        ]);
    }
}
