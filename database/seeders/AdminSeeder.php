<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'profile_photo' => null,
            'password' => Hash::make('password'),
            'is_approved' => true,
            'role' => 'admin',
        ]);
    }
}