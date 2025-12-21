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

 
    }
}