<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
<<<<<<< HEAD
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Buat Akun Guru 1
        User::create([
            'nama' => 'Pak Budi (Guru Matematika)',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);

        // Buat Akun Guru 2
        User::create([
            'nama' => 'Ibu Siti (Guru IPA)',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);
=======
        'nama'     => 'Akun Admin',
        'email'    => 'admin@gmail.com',
        'password' => Hash::make('password123'),
        'role'     => 'admin',
    ]);

    // Buat Akun Guru
    User::create([
        'nama'     => 'Akun Guru',
        'email'    => 'guru@gmail.com',
        'password' => Hash::make('password123'),
        'role'     => 'guru',
    ]);

 
>>>>>>> origin/main
    }
}