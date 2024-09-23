<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
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
        User::factory(20)->create();

        // Create two users, one regular and one admin
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('parole123'),
            'is_admin' => false,
            'remember_token' => null,
        ]);

        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('parole123'),
            'is_admin' => true,
            'remember_token' => null,
        ]);

        for ($i = 1; $i <= 100; $i++) {
            Post::create([
                'user_id' => rand(1, 22), // Assuming you have users with IDs 1-10
                'title' => 'Post Title ' . $i,
                'description' => 'This is the description for post ' . $i,
            ]);
        }
    }
}
