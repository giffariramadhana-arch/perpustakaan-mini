<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    User::create([
        'name' => 'Admin Demo',
        'email' => 'admin@demo.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'User Demo',
        'email' => 'user@demo.com',
        'password' => Hash::make('password'),
        'role' => 'user',
    ]);
}
}
