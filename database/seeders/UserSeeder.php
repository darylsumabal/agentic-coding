<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'type' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'type' => 'manager',
        ]);

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'type' => 'user',
        ]);
    }
}
