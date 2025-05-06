<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Owner
        User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Pegawai
        User::create([
            'name' => 'Pegawai',
            'email' => 'pegawai@example.com',
            'password' => Hash::make('password'),
            'role' => 'pegawai',
        ]);

        // User
        User::create([
            'name' => 'Petani',
            'email' => 'petani@example.com',
            'password' => Hash::make('password'),
            'role' => 'petani',
        ]);
    }
} 