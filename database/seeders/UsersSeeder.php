<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin user',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Vorges@987'),
            'role' => 'admin'
        ]);
        User::factory()->create([
            'name' => 'Gestor User',
            'email' => 'gestor@gmail.com',
            'password' => bcrypt('Vorges@987'),
            'role' => 'gestor'
        ]);
        User::factory()->create([
            'name' => 'Common User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('Vorges@987'),
            'role' => 'user'
        ]);
    }
}
