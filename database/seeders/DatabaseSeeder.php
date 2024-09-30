<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@examwaves.io',
            'role' => 1
        ]);

        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'role' => 0
        ]);

    }
}
