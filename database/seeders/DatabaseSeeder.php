<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Domain;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(100)->create();
        Domain::factory(100)->create();

        User::factory()->create([
            'name' => 'test Edu',
            'email' => 'test@test.com',
            'password' => 'test',
        ]);
    }
}