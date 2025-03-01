<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(9)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Task::factory(50)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'password' => Hash::make('12345678'),
            'isAdmin'=>1
        ]);
    }
}
