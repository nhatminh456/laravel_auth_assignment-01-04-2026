<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Account',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Account',
                'password' => 'password',
                'role' => 'user',
            ]
        );
    }
}
