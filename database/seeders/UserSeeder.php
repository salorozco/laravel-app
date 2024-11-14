<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sal Orozco',
            'email' => 'sal@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Kobe Bryant',
            'email' => 'kobe@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
