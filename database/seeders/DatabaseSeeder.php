<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $likes = [];


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

        // Post seeder
        for ($i = 1; $i <= 100; $i++) {
            Post::create([
                'user_id' => rand(1, 22), // Assuming you have users with IDs 1-10
                'title' => 'Post Title ' . $i,
                'description' => 'This is the description for post ' . $i,
            ]);
        }

        // Likes seeder
        for ($i = 0; $i < 500; $i++) {
            do {
                $user_id = $faker->numberBetween(1, 22);  // Random user_id between 1 and 22
                $post_id = $faker->numberBetween(1, 100); // Random post_id between 1 and 100
                $key = "$user_id-$post_id"; // Create a unique key
            } while (in_array($key, $likes)); // Keep generating until it's unique

            $likes[] = $key; // Store the unique key to avoid duplicates

            DB::table('likes')->insert([
                'user_id' => $user_id,
                'post_id' => $post_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Follower seeder

        // Generate some example user IDs
        $userIds = range(1, 22); // Assuming you have 10 users with IDs from 1 to 10

        foreach ($userIds as $userId) {
            // Randomly choose followers for each user
            $followers = Arr::random($userIds, rand(1, 5)); // Randomly pick 1 to 5 followers

            foreach ($followers as $followerId) {
                if ($userId !== $followerId) { // Ensure a user does not follow themselves
                    DB::table('followers')->insert([
                        'user_id' => $userId,
                        'follower_id' => $followerId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
