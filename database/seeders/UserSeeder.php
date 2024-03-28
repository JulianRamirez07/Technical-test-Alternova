<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'example@example.com',
            'password' => Hash::make('N0meacuerd0'),
            'role_id' => 1
        ]);

        User::create([
            'id' => 2,
            'name' => 'Jane Smith',
            'email' => 'example2@example.com',
            'password' => Hash::make('123456789'),
            'role_id' => 2
        ]);
    }
}
